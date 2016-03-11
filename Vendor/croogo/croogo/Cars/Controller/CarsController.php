<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class CarsController extends CarsAppController {

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Cars.Make','Cars.MakeModel');	
	public $name = 'Cars';
	public function index() {
	}
	public function clist() {
	}
	public function admin_index() {
	}
	public function admin_features_setup() {
	}
	public function admin_inventory() {
	}
	public function admin_make() {
	   
		
		$this->set('title_for_layout', __d('croogo', 'Car Makes'));
		$this->set('modelClass', __d('croogo', 'Make'));
		
		
	  $this->Make->recursive = 0;
		$this->paginate['Make']['order'] = 'Make.created ASC';
		$this->set('car_makes', $this->paginate());
		$this->set('displayFields', $this->Make->displayFields());
	}
	
	public function admin_make_add(){
		$this->set('title_for_layout', __d('croogo', 'Car Make- Add'));
		
		if (!empty($this->request->data)) {
			$this->Make->create();
			if ($this->Make->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Make has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'make'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Make could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
	}
	
	public function admin_make_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit Make'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid Make'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'make'));
		}
		if (!empty($this->request->data)) {
			if ($this->Make->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Make has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'make'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Make could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Make->read(null, $id);
		}
	}

	public function admin_make_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid Make Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'make'));
		}
		if ($this->Make->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'Make deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'make'));
		}
	}	
	
	public function admin_model() {
		$this->set('title_for_layout', __d('croogo', 'Car Models'));
		$this->set('modelClass', __d('croogo', 'MakeModel'));
		$this->modelClass= 'MakeModel';
		
		//$this->MakeModel->recursive = 0;
		$this->paginate['MakeModel']['conditions'] = array();
		$this->paginate['MakeModel']['order'] = 'MakeModel.created ASC';
		$this->set('make_models', $this->paginate());
		$this->set('displayFields', $this->MakeModel->displayFields());
	
		
	}
	
	public function admin_model_add(){
		$this->set('title_for_layout', __d('croogo', 'Car Model- Add'));
	
		if (!empty($this->request->data)) {
			$this->MakeModel->create();
			if ($this->MakeModel->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Model has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'model'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Model could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		$makes = $this->Make->find('list');
		$this->set(compact('makes'));
	}
	
	public function admin_model_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit Model'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid Model'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'make'));
		}
		if (!empty($this->request->data)) {
			if ($this->MakeModel->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Model has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'model'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Model could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->MakeModel->read(null, $id);
		}
		$makes = $this->Make->find('list');
		$this->set(compact('makes'));
	}
	public function admin_model_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid Model Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'model'));
		}
		if ($this->MakeModel->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'Model deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'make'));
		}
	}
	
	public function admin_extras() {
	}
}
