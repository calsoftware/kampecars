<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class CommonController extends CarsAppController {
	public function beforeFilter(){
	//$this->Auth->allow('index');
	}
	public function index() {
		$this->layout=false;//'ajax';
		$this->ajax=true;
		return false;
	}
}
