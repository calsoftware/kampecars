<?php

App::uses('CarsAppModel', 'Cars.MakeModel');

/**
 * Cars
 *
 * @category Feature
 */
class Feature extends AppModel {

/**
 * Feature name
 *
 * @var string
 * @access public
 */
	public $name = 'Feature';
	public $useTable = 'car_features';


/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'name' => array(
			'rule' => array('minLength', 2),
			'message' => 'Make name cannot be empty.',
		),
		
	);
	public $belongsTo = array('Cars.FeatureType');	
	protected $_displayFields = array(
			'id',
			'model_name'=>'Model',
			'FeatureType.name' => 'Feature Type',
			'status',				
	);
	public function loadFeatureByType($feature_type_id){
	return	$this->find('list',array('conditions'=>array('feature_type_id'=>$feature_type_id)));
	}
}
