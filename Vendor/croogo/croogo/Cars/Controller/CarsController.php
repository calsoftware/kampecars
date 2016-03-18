<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class CarsController extends CarsAppController {

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $components = array('Security');
	public $uses = array('Cars.Make','Cars.MakeModel','Cars.Extra','Cars.FeatureType','Cars.Feature','Cars.Inventory','Cars.Supplier','Cars.CarExtra','Cars.Photo');	
	public $name = 'Cars';
	public function beforeFilter(){
		$this->Security->unlockedActions = array('admin_loadoptions','admin_inventory_add','admin_inventory_edit');
		parent::beforeFilter();
	}
	public function index() {
	}
	public function clist() {
	}
	public function admin_index() {	
	}
	
	public function admin_inventory() {

		$this->set('title_for_layout', __d('croogo', 'Car Inventory'));
		$this->set('modelClass', __d('croogo', 'Inventory'));
		$this->modelClass= 'Inventory';
		
		$conditions =array();
		if(isset( $this->request->query['name'])&&$searchname= $this->request->query['name']){
			$searchname =trim($searchname);
			$conditions['Inventory.title LIKE']="%".$searchname."%";
		}
		if(isset( $this->request->query['status'])&& $search_status= $this->request->query['status']){
			if($search_status =='active'){
				$conditions['Inventory.status']=1;
			}else if($search_status =='inactive'){
				$conditions['Inventory.status']=0;
			}else{
				//Noting with
			}
		
		
		}
		
		$this->paginate['Inventory']['conditions'] =$conditions;
		$this->paginate['Inventory']['limit']=10;
		$this->Inventory->recursive = 3;
		$this->paginate['Inventory']['order'] = 'Inventory.created ASC';
		$this->set('car_inventories', $this->paginate());
		$this->set('displayFields', $this->Make->displayFields());
	}

	public function admin_inventory_add(){
		//ALTER TABLE `crb5_car_inventories` CHANGE `price` `price` DECIMAL( 15, 4 ) NOT NULL DEFAULT '0'
		$this->set('title_for_layout', __d('croogo', 'Car inventory- Add'));
		
		if (!empty($this->request->data)) {
			$this->Inventory->create();
			if ($this->Inventory->save($this->request->data)) {
				$car_id = $this->Inventory->Id;
				$this->CarExtra->saveCarExtra($car_id ,$this->request->data);
				$this->Photo->saveAll($this->request->data);
				$this->Session->setFlash(__d('croogo', 'The inventory has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'inventory'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The inventory could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		
		$make_options = $this->Make->find('list');
		$con1=array();
		$make_id=isset($this->request->data['Inventory']['make_id'])?$this->request->data['Inventory']['make_id']:0;
		$model_options =$list = $this->MakeModel->typelist($make_id);	
	
		$suppliers= $this->Supplier->find('list');
		$extras= $this->Extra->find('list');
		$this->set(compact('make_options','model_options','suppliers','extras'));
		
		$emission_classes= $this->Feature->loadFeatureByType(1);
		$colors= $this->Feature->loadFeatureByType(2);
		$doors= $this->Feature->loadFeatureByType(3);
		$fuels= $this->Feature->loadFeatureByType(4);
		$gearboxes= $this->Feature->loadFeatureByType(5);
		$number_of_seat= $this->Feature->loadFeatureByType(6);
		$vehicle_types= $this->Feature->loadFeatureByType(7);
		$this->set(compact('emission_classes','colors','doors','fuels','gearboxes','number_of_seat','vehicle_types'));
		$this -> render('admin_inventory_form');
	}
	
	public function admin_inventory_edit($id = null) {
		$this->set('title_for_layout', __d('croogo', 'Edit Car Inventory'));
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('croogo', 'Invalid inventory'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'inventory'));
		}
		if (!empty($this->request->data)) {
			if ($this->Inventory->save($this->request->data)) {
				$this->CarExtra->saveCarExtra($this->Inventory->id ,$this->request->data);
				$this->Photo->saveAll($this->request->data);
				$this->Session->setFlash(__d('croogo', 'The inventory has been saved'), 'flash', array('class' => 'success'));
				$this->Croogo->redirect(array('action' => 'inventory'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The inventory could not be saved. Please, try again.'), 'flash', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Inventory->read(null, $id);
			$temp_selected= array();
			$cextra = $this->request->data['CarExtra'];
			foreach($cextra as $c){
				$temp_selected['extra_id'][] =$c['extra_id'];
			}
			$this->request->data['CarExtra']=$temp_selected;
		}
		$make_options = $this->Make->find('list');
		$con1=array();
		$make_id=isset($this->request->data['Inventory']['make_id'])?$this->request->data['Inventory']['make_id']:0;
	    $model_options =$list = $this->MakeModel->typelist($make_id); 
		$suppliers= $this->Supplier->find('list');
		$extras= $this->Extra->find('list');
		
		$this->set(compact('make_options','model_options','suppliers','extras'));
		
		$emission_classes= $this->Feature->loadFeatureByType(1);
		$colors= $this->Feature->loadFeatureByType(2);
		$doors= $this->Feature->loadFeatureByType(3);
		$fuels= $this->Feature->loadFeatureByType(4);
		$gearboxes= $this->Feature->loadFeatureByType(5);
		$number_of_seat= $this->Feature->loadFeatureByType(6);
		$vehicle_types= $this->Feature->loadFeatureByType(7);
		$this->set(compact('emission_classes','colors','doors','fuels','gearboxes','number_of_seat','vehicle_types'));
		$this -> render('admin_inventory_form');
	}
	
	public function admin_inventory_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('croogo', 'Invalid inventory Id'), 'flash', array('class' => 'error'));
			return $this->redirect(array('action' => 'inventory'));
		}
		if ($this->Inventory->delete($id)) {
			$this->Session->setFlash(__d('croogo', 'inventory deleted'), 'flash', array('class' => 'success'));
			return $this->redirect(array('action' => 'inventory'));
		}
		
		$this->Session->setFlash(__d('croogo', 'Invalid inventory Id'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'inventory'));
	}
	
	public function admin_make() {
	 	$this->set('title_for_layout', __d('croogo', 'Car Makes'));
		$this->set('modelClass', __d('croogo', 'Make'));
		$this->modelClass= 'Make';
		
		$conditions =array();
		if(isset( $this->request->query['name'])&&$searchname= $this->request->query['name']){
			$searchname =trim($searchname);
			$conditions['Make.name LIKE']="%".$searchname."%";
		}
		if(isset( $this->request->query['status'])&& $search_status= $this->request->query['status']){
			if($search_status =='active'){
				$conditions['Make.status']=1;
			}else if($search_status =='inactive'){
				$conditions['Make.status']=0;
			}else{
				//Noting with
			}
				
				
		}
		
		$this->paginate['Make']['conditions'] =$conditions;
		$this->paginate['Make']['limit']=10;
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
		
		$this->Session->setFlash(__d('croogo', 'Invalid Make Id'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'make'));
	}	
	
	public function admin_model() {
		$this->set('title_for_layout', __d('croogo', 'Car Models'));
		$this->set('modelClass', __d('croogo', 'MakeModel'));
		$this->modelClass= 'MakeModel';
		
		//$this->MakeModel->recursive = 0;
		$conditions =array();
		if(isset( $this->request->query['name'])&&$searchname= $this->request->query['name']){
			$searchname =trim($searchname);
			$conditions['MakeModel.model_name LIKE']="%".$searchname."%";
		}
		if(isset( $this->request->query['status'])&& $search_status= $this->request->query['status']){
			if($search_status =='active'){
				$conditions['MakeModel.status']=1;
			}else if($search_status =='inactive'){
				$conditions['MakeModel.status']=0;
			}else{
				//Noting with 
			}
			
			
		}
		
		$this->paginate['MakeModel']['conditions'] =$conditions;
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
		
		$this->Session->setFlash(__d('croogo', 'Invalid Model Id'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'model'));
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
		$conditions =array();
		if(isset( $this->request->query['name'])&&$searchname= $this->request->query['name']){
			$searchname =trim($searchname);
			$conditions['Extra.name LIKE']="%".$searchname."%";
		}
		if(isset( $this->request->query['status'])&& $search_status= $this->request->query['status']){
			if($search_status =='active'){
				$conditions['Extra.status']=1;
			}else if($search_status =='inactive'){
				$conditions['Extra.status']=0;
			}else{
				//Noting with
			}
		
		
		}
		
		$this->paginate['Extra']['conditions'] =$conditions;
		$this->paginate['Extra']['limit']=10;
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
		$this->Session->setFlash(__d('croogo', 'Invalid Extra Id'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'extras'));
	}
	
	public function admin_featureTypes() {
		$this->set('title_for_layout', __d('croogo', 'Car Feature Types'));
		$this->set('modelClass', __d('croogo', 'FeatureType'));
		$this->modelClass= 'FeatureType';
		$searchFields = array('role_id', 'name');
	    $this->FeatureType->recursive = 0;
	    
	    $conditions =array();
	    if(isset( $this->request->query['name'])&&$searchname= $this->request->query['name']){
	    	$searchname =trim($searchname);
	    	$conditions['FeatureType.name LIKE']="%".$searchname."%";
	    }
	    if(isset( $this->request->query['status'])&& $search_status= $this->request->query['status']){
	    	if($search_status =='active'){
	    		$conditions['FeatureType.status']=1;
	    	}else if($search_status =='inactive'){
	    		$conditions['FeatureType.status']=0;
	    	}else{
	    		//Noting with
	    	}
	    
	    
	    }
	    
	    $this->paginate['FeatureType']['conditions'] =$conditions;
	    $this->paginate['FeatureType']['limit']=2;
	    
		$this->paginate['FeatureType']['order'] = 'FeatureType.created ASC';
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
		$this->Session->setFlash(__d('croogo', 'Invalid Feature Type Id'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'featuretypes'));
	}
	
	public function admin_features() {
		$this->set('title_for_layout', __d('croogo', 'Car Features'));
		$this->set('modelClass', __d('croogo', 'Feature'));
		$this->modelClass= 'Feature';
		$conditions =array();
		if(isset( $this->request->query['name'])&&$searchname= $this->request->query['name']){
			$searchname =trim($searchname);
			$conditions['Feature.name LIKE']="%".$searchname."%";
		}
		if(isset( $this->request->query['status'])&& $search_status= $this->request->query['status']){
			if($search_status =='active'){
				$conditions['Feature.status']=1;
			}else if($search_status =='inactive'){
				$conditions['Feature.status']=0;
			}else{
				//Noting with
			}
			 
			 
		}
		 
		$this->paginate['Feature']['conditions'] =$conditions;
		$this->paginate['Feature']['limit']=10;
		
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
		
		$this->Session->setFlash(__d('croogo', 'Invalid Feature Id'), 'flash', array('class' => 'error'));
		return $this->redirect(array('action' => 'features'));
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
	public function admin_loadoptions($default= NULL){
	$this->ajax=true;	
	$this->layout=false;
	$list =array();
	if (!empty($this->request->query) && isset($this->request->query['act'])) {
	$method = $this->request->query['act'];	
	$id =$this->request->query['id'];
	if($method == 'MakeModel'){
	
	$list = $this->MakeModel->typelist($id);	
	}
	
	} 
	$this->set('optionList',$list);// $option;
	
	}
}
