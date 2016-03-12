<?php

App::uses('CarsAppModel', 'Cars.MakeModel');

/**
 * Cars
 *
 * @category FeatureType
 */
class FeatureType extends AppModel {

/**
 * FeatureType name
 *
 * @var string
 * @access public
 */
	public $name = 'FeatureType';
	public $useTable = 'car_feature_types';


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
	
	protected $_displayFields = array(
			'id',
			'name',
			'created',
			'status',				
	);
}
