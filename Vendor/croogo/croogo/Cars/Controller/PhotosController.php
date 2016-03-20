<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class PhotosController extends CarsAppController {
	public function beforeFilter(){
		
	
		$this->Security->unlockedActions[] = 'admin_ajaxFrontCardUpload';
		$this->Security->unlockedActions[] = 'admin_upload';
		//$this->Security->unlockedActions[] = 'admin_index';
     	//$this->Security->enabled = false;
     	//$this->Security->validatePost = false;
		$this->Security->csrfCheck = false;
		$this->Auth->allow('admin_upload');
	//	parent::beforeFilter();
	}
	public $uploadsDir = 'uploads';
	public function admin_index() {
		
	}
	public function admin_upload() {

		$json = array();
			// Make sure we have the correct directory

			$directory =  'uploads';
	
		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = 'Directory Not found';
		}
		
		if (!$json) {
	        if (!empty($this->request->form['file']['name']) && !empty($this->request->form['file']['tmp_name'])) {
				$errorfiles = array();
				$uploadlist=array();
				foreach ($this->request->form['file']['name'] as $key => $value) {
					// Sanitize the filename
					$error='';
					$filename = basename(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
					
					// Validate the filename length
					if ((strlen($filename) < 3) || (strlen($filename) > 255)) {
						$error='Invalid file';
					}
	
					// Allowed file extension types
					$allowed = array(
							'jpg',
							'jpeg',
							'gif',
							'png'
					);
	
					if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
						$error = 'Invalid file type';
					}
					
					// Allowed file mime types
					$allowed = array(
							'image/jpeg',
							'image/pjpeg',
							'image/png',
							'image/x-png',
							'image/gif'
					);
	
					if (!in_array($this->request->form['file']['type'][$key], $allowed)) {
						$error = 'Invalid file type';
					}
					
					// Check to see if any PHP files are trying to be uploaded
					$content = file_get_contents($this->request->form['file']['tmp_name'][$key]);
	
					if (preg_match('/\<\?php/i', $content)) {
						$error = 'Invalid file type';
					}
	
					// Return any upload error
					if ($this->request->form['file']['error'][$key] != UPLOAD_ERR_OK) {
						$error = 'unable to upload';
					}
	
					  if(!$error){
					    $file['name']=$value;
						$file['type'] = $this->request->form['file']['type'][$key];
						$destination = WWW_ROOT . $this->uploadsDir . DS . $file['name'];
						if (file_exists($destination)) {
							$newFileName = String::uuid() . '-' . $file['name'];
							$destination = WWW_ROOT . $this->uploadsDir . DS . $newFileName;
						} else {
							$newFileName = $file['name'];
						}
							
						// remove the extension for title
						if (explode('.', $file['name']) > 0) {
							$fileTitleE = explode('.', $file['name']);
							array_pop($fileTitleE);
							$fileTitle = implode('.', $fileTitleE);
						} else {
							$fileTitle = $file['name'];
						}
						if(move_uploaded_file($this->request->form['file']['tmp_name'][$key],$destination)){
							$data=array();
							
							$data['Photo']=array('id'=>'','car_inventory_id'=>1,'title'=>$fileTitle,'slug'=>$newFileName,'status'=>'0');//TEMP upload
							$data['Photo']['path'] = '/' . $this->uploadsDir . '/' . $newFileName;
							$data['Photo']['mime_type'] = $file['type'];
							$uploadlist[] = $this->Photo->saveAjaxUpload($data);
						}
					  }else{
					  	$data=array('file'=>$filename,'error'=>$error);
					  	$errorfiles[]=$data;
					  }
				}
				
				if (!$json) {
	
					$json['uploadlist']='';
					$json['success'] = 'Photos Uploaded success';
					if(!empty($uploadlist)){
						foreach ($uploadlist as $ul){
						$photo =$ul['Photo'];
						$thumbnail ='<div class="photo-single">';
						$thumbnail .= '<a href="#" class="removephoto" title="Remove '.$photo['title'].'"></a>';
						$thumbnail .= '<img class="img-polaroid" width="75" height="75" src="'.SITE_URL.$photo['path'].'" alt="'.$photo['title'].'">';
						$thumbnail .='<input type="hidden" name="photos_ids[]" value="'.$photo['id'].'" />';
						$thumbnail .='</div>';
						$json['uploadlist'][]=$thumbnail;
						}
						$json['uploadlist']=implode('', $json['uploadlist']);
					}	
					
					$json['errorfiles']=$errorfiles;
				}
				
			} else {
				$json['error'] = 'Error on uploading files';
			}
		}

		//$this->set('json',$json);
		//$this->layout='ajax';
		echo json_encode($json);
		exit;
		
	}
	public function admin_ajaxFrontCardUpload() {
		$this->layout = 'ajax';
	
		$tmp_name = $this->data['Photos']['uploadFront']['tmp_name'];
		$tmp_name = $this->data['Card']['uploadFront']['tmp_name'].'/'.$this->data['Card']['uploadFront']['name'];
		$json_response['tmp_path'] = '/img/cards/temp/'.time().'.png';
		if(move_uploaded_file($tmp_name, $json_response['tmp_path'])){
			$json_response['response'] = 'true';
		}else{
			$json_response['response'] = 'false';
		}
		$this->set(compact('json_response'));
	}	
}
