<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class CarsController extends CarsAppController {

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Cars.Make','Cars.MakeModel','Cars.Extra','Cars.FeatureType','Cars.Feature');	
	public $name = 'Cars';
	public function index() {
	}
	public function clist() {
	}
	public function admin_index() {
	}
	
	public function admin_inventory() {
	}
	public function admin_make() {
	 	$this->set('title_for_layout', __d('croogo', 'Car Makes'));
		$this->set('modelClass', __d('croogo', 'Make'));
		$this->modelClass= 'Make';
		
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
		$this->paginate['MakeModel']['limit']=10;
		$this->set('make_models', $this->paginate());
		$this->set('displayFields', $this->MakeModel->displayFields());
	
		
	}
	
	public function admin_model_add(){
		$this->set('title_for_layout', __d('croogo', 'Add Car Model'));
	
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
			return $this->redirect(array('action' => 'model'));
		}
	}
	
	public function admin_model_toggle($id = null, $status = null) {
		$this->Croogo->fieldToggle($this->MakeModel, $id, $status);
	}
	
	public function admin_make_toggle($id = null, $status = null) {
		$this->Croogo->fieldToggle($this->Make, $id, $status);
	}	
	
	public function admin_extras() {
		$this->set('title_for_layout', __d('croogo', 'Car Extras'));
		$this->set('modelClass', __d('croogo', 'Extra'));
		$this->modelClass= 'Extra';
		
	    $this->Extra->recursive = 0;
		$this->paginate['Extra']['order'] = 'Extra.created ASC';
		$this->set('Extras', $this->paginate());
		$this->set('displayFields', $this->Extra->displayFields());
	}
	
	public function admin_extras_add(){
		$this->set('title_for_layout', __d('croogo', 'Add Car Extra'));
	
		if (!empty($this->request->data)) {
			$this->Extra->create();
			if ($this->Extra->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Extra has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'extras'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Extra could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
	}
	
	public function admin_extras_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit Car Extras'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid Extra'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'extras'));
		}
		if (!empty($this->request->data)) {
			if ($this->Extra->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Extra has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'extras'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Extra could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Extra->read(null, $id);
		}
	}
	
	public function admin_extras_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid Extra Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'extras'));
		}
		if ($this->Extra->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'Extra deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'extras'));
		}
	}
	
	public function admin_featureTypes() {
		$this->set('title_for_layout', __d('croogo', 'Car Feature Types'));
		$this->set('modelClass', __d('croogo', 'FeatureType'));
		$this->modelClass= 'FeatureType';
		$searchFields = array('role_id', 'name');
	    $this->FeatureType->recursive = 0;
		$this->paginate['FeatureType']['order'] = 'FeatureType.created ASC';
		$this->paginate['FeatureType']['limit']=10;
		$this->set('FeatureTypes', $this->paginate());
		$this->set('displayFields', $this->FeatureType->displayFields());
	}
	
	public function admin_featureTypes_add(){
		$this->set('title_for_layout', __d('croogo', 'Add Car Feature Types'));
	
		if (!empty($this->request->data)) {
			$this->FeatureType->create();
			if ($this->FeatureType->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Feature Type has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'featuretypes'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Feature Type could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
	}
	
	public function admin_featureTypes_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit Feature Type'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid Feature Type'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'featuretypes'));
		}
		if (!empty($this->request->data)) {
			if ($this->FeatureType->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Feature Type has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'featuretypes'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Feature Type could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->FeatureType->read(null, $id);
		}
	}
	
	public function admin_featureTypes_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid Feature Type Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'featuretypes'));
		}
		if ($this->FeatureType->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'Feature Type deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'featuretypes'));
		}
	}
	
	public function admin_features() {
		$this->set('title_for_layout', __d('croogo', 'Car Features'));
		$this->set('modelClass', __d('croogo', 'Feature'));
		$this->modelClass= 'Feature';
		
	    $this->Feature->recursive = 0;
		$this->paginate['Feature']['order'] = 'Feature.created ASC';
		$this->set('Features', $this->paginate());
		$this->set('displayFields', $this->Feature->displayFields());
		
	}
	
	public function admin_features_add(){
		$this->set('title_for_layout', __d('croogo', 'Add Car Feature'));
	
		if (!empty($this->request->data)) {
			$this->Feature->create();
			if ($this->Feature->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Feature has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'features'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Feature could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		$featuretypes = $this->FeatureType->find('list');
		$this->set('featuretypes',$featuretypes );
	}
	
	public function admin_features_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit Feature'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid Feature'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'features'));
		}
		if (!empty($this->request->data)) {
			if ($this->Feature->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The Feature has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'features'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The Extra could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Feature->read(null, $id);
		}
		$featuretypes = $this->FeatureType->find('list');
		$this->set(compact('featuretypes'));
	}
	
	public function admin_features_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid Feature Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'features'));
		}
		if ($this->Feature->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'Feature deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'features'));
		}
	}
	public function admin_proccess($action = null) {
	
		if (!$action) {
			$this->Session->setFlash(__d('croogo', 'Invalid operation'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($action =='feature') {
			$this->Session->setFlash(__d('croogo', 'Feature deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'features'));
		}
		
		if ($action =='make') {
			$this->Session->setFlash(__d('croogo', 'Feature deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'make'));
		}
		if ($action =='extra') {
			$this->Session->setFlash(__d('croogo', 'Items Process'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'extras'));
		}
		if ($action =='featuretypes') {
			$this->Session->setFlash(__d('croogo', 'Items Process'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'featuretypes'));
		}
		
		if ($action =='model') {
			$this->Session->setFlash(__d('croogo', 'Items Process'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'model'));
		}
		
		$this->Session->setFlash(__d('croogo', 'Invalid access.'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'index'));
	}	
}
