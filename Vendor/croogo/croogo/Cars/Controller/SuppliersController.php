<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class SuppliersController extends CarsAppController {
	public $uses = array('Cars.Supplier');	
		public function beforeFilter(){
		parent::beforeFilter();
		$this->request->query['status'] =isset($this->request->query['status'])?$this->request->query['status']:'any';
		$this->request->query['name'] =isset($this->request->query['name'])?$this->request->query['name']:'';
	}
	public function index() {
	}
	public function admin_index() {
	
		$this->set('title_for_layout', __d('croogo', 'Suppliers'));
		$this->set('modelClass', __d('croogo', 'Supplier'));
		$this->modelClass= 'Supplier';
		
		$conditions =array();
		/*if($searchname= $this->request->query['name']){
			$searchname =trim($searchname);
			$conditions['Supplier.supplier_name LIKE']="%".$searchname."%";
		}/*/
		if($search_status= $this->request->query['status']){
			if($search_status =='active'){
				$conditions['Supplier.status']=1;
			}else if($search_status =='inactive'){
				$conditions['Supplier.status']=0;
			}else{
				//Noting with
			}
		
		
		}
		
		$this->paginate['Supplier']['conditions'] =$conditions;
		$this->paginate['Supplier']['limit']=10;
		$this->Supplier->recursive = 0;
		$this->paginate['Supplier']['order'] = 'Supplier.create_date ASC';
		$this->set('car_suppliers', $this->paginate());
		//$this->set('displayFields', $this->Make->displayFields());
		
	}
	
	public function admin_supplier_add(){
		$this->set('title_for_layout', __d('croogo', 'Add Supplier'));
	
		if (!empty($this->request->data)) {
			$this->Supplier->create();
			if ($this->Supplier->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Supplier has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Supplier could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		
	}
	public function admin_supplier_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit supplier'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid supplier'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Supplier->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The supplier has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The supplier could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Supplier->read(null, $id);
		}
	}
	
	public function admin_supplier_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid Supplier Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'model'));
		}
		if ($this->Supplier->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'Supplier deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'model'));
		}
	}
	
  public function admin_supplier_proccess(){
	  
	  }	
}
