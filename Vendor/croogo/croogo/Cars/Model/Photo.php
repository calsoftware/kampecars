<?php
App::uses ( 'CarsAppModel', 'Cars.MakeModel' );

/**
 * Cars
 *
 * @category Feature
 */
class Photo extends AppModel {
//ALTER TABLE `crb5_car_photos` CHANGE `name` `title` VARCHAR( 256 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL 	
	/**
	 * Feature name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'Photo';
	public $useTable = 'car_photos';
	public $alias = 'Photo';
	/**
	 * Validation
	 *
	 * @var array
	 * @access public
	 */
	public $validate = array (
			'name' => array (
					'rule' => array (
							'minLength',
							2 
					),
					'message' => 'Make name cannot be empty.' 
			) 
	);
	
	public $uploadsDir = 'uploads';

/**
 * Save uploaded file
 *
 * @param array $data data as POSTed from form
 * @return array|boolean false for errors or array containing fields to save
 */
	protected function _saveUploadedFile($data) {
		$file = $data[$this->alias]['file'];
		unset($data[$this->alias]['file']);

		// check if file with same path exists
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

		$data[$this->alias]['car_inventory_id'] = isset($data['Inventory']['id'])?$data['Inventory']['id']:0;
		$data[$this->alias]['name'] = $fileTitle;
		$data[$this->alias]['slug'] = $newFileName;
		$data[$this->alias]['mime_type'] = $file['type'];
		$data[$this->alias]['path'] = '/' . $this->uploadsDir . '/' . $newFileName;
		// move the file
		$moved = move_uploaded_file($file['tmp_name'], $destination);
		if ($moved) {
			return $data;
		}

		return false;
	}

/**
 * Saves model data
 *
 * @see Model::save()
 */
	public function save($data = null, $validate = true, $fieldList = array()) { 
		if (isset($data[$this->alias]['file']['tmp_name'])) {
			$data = $this->_saveUploadedFile($data);
		}
		if (!$data) {
			return $this->invalidate('file', __d('croogo', 'Error during file upload'));
		}
		return parent::save($data, $validate, $fieldList);
	}
	public function saveAll($data = null, $validate = true, $fieldList = array()) {
         $tempData= $data;
        if(isset($tempData['photos_ids'])){
         $carId	=isset($data['Inventory']['id'])?$data['Inventory']['id']:0;
         return $this->updateData($carId,$tempData['photos_ids']);
        }
		 if (isset($tempData[$this->alias]['file'][0]['tmp_name'])) {
		 	$list_upload =array();
			$filesList = $tempData[$this->alias]['file'];
			foreach($filesList as $fdata){
				
				$fdata1[$this->alias]['file'] =$fdata;
				$fdata1['Inventory']['id'] =$data['Inventory']['id'];
				$this->create($fdata1);
				$succesData=  $this->save($fdata1);
				
			}
		
			
		}
		
	}
	
	public function updateData($carId,$updateIds){
		//ALTER TABLE `crb5_car_photos` ADD `order` INT( 2 ) NOT NULL DEFAULT '0' AFTER `updated` 

		foreach($updateIds as $k=>$v){
			$this->updateAll(array('car_inventory_id'=>$carId,'status'=>'1','order'=>$k),array('id'=>$v));
		}
		$updateIds=$updateIds?$updateIds:array(0);
		if($carId){
			$conditions=array('car_inventory_id'=>$carId,'id NOT IN'=>$updateIds);
			$this->deleteAll($conditions);
		}

	
	}
	public function saveAjaxUpload($data){
		return parent::save($data);
	}
/**
 * Removes record for given ID.
 *
 * @see Model::delete()
 */
	public function delete($id = null, $cascade = true) {
		$attachment = $this->find('first', array(
			'conditions' => array(
				$this->alias . '.id' => $id,
			),
		));

		$filename = $attachment[$this->alias]['slug'];
		$uploadsDir = WWW_ROOT . $this->uploadsDir . DS;
		$fullpath = $uploadsDir . DS . $filename;
		if (file_exists($fullpath)) {
			$result = unlink($fullpath);
			if ($result) {
				$info = pathinfo($filename);
				array_map('unlink', glob(
					$uploadsDir . DS . 'resized' . DS . $info['filename'] . '.resized-*.' . $info['extension']
				));
				return parent::delete($id, $cascade);
			} else {
				return false;
			}
		} else {
			return parent::delete($id, $cascade);
		}
	}
	
}
