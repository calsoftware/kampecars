<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class InventoryController extends CarsAppController {
	public function beforeFilter(){
		$this->Auth->allow('index','display');
		parent::beforeFilter();
	}
	public function index() {
		
	}
	public function display($slug=NULL){
		if(!$slug){
		$this->Session->setFlash(__d('croogo', 'The inventory was not found in the system'), 'flash', array('class' => 'error'));
		$this->Croogo->redirect(array('action' => 'inventory'));
		}
	}
	
}
