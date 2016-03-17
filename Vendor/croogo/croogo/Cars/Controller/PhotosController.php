<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class PhotosController extends CarsAppController {
	public function beforeFilter(){
		parent::beforeFilter();
	
		$this->Security->unlockedActions[] = 'admin_ajaxFrontCardUpload';
		$this->Security->unlockedActions[] = 'admin_index';
	}
	
	public function admin_index() {print_r($this->request);
	}
	public function admin_add() {
	}
	public function admin_ajaxFrontCardUpload() {
		$this->layout = 'ajax';
		print_r($_FILES);die;
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
