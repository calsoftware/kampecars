<?php
App::uses ( 'CarsAppController', 'Cars.Controller' );
class SearchController extends CarsAppController {
	
	
	public $uses = array('Cars.Make','Cars.MakeModel','Cars.Extra','Cars.FeatureType','Cars.Feature','Cars.Inventory','Cars.Supplier','Cars.CarExtra','Cars.Photo');	
	
	public function index() {
		
		$make_options = $this->Make->find('list');
		$con1=array();
		$make_id=isset($this->request->data['Inventory']['make_id'])?$this->request->data['Inventory']['make_id']:0;
	    $model_options =$list = $this->MakeModel->typelist($make_id); 
		$suppliers= $this->Supplier->find('list');
		$extras= $this->Extra->find('list');
		
		$emission_classes= $this->Feature->loadFeatureByType(1);
		$colors= $this->Feature->loadFeatureByType(2);
		$doors= $this->Feature->loadFeatureByType(3);
		$fuels= $this->Feature->loadFeatureByType(4);
		$gearboxes= $this->Feature->loadFeatureByType(5);
		$number_of_seat= $this->Feature->loadFeatureByType(6);
		$vehicle_types= $this->Feature->loadFeatureByType(7);
		$search_data = compact('emission_classes','colors','doors','fuels','gearboxes','number_of_seat','vehicle_types','make_options','model_options','extras');
		$this->set(compact('search_data'));
	
	}
	
}
