<?php

App::uses('CarsAppModel', 'Cars.MakeModel');

/**
 * Cars
 *
 * @category Feature
 */
class Photo extends AppModel {

/**
 * Feature name
 *
 * @var string
 * @access public
 */
	public $name = 'Photo';
	public $useTable = 'car_photos';


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
	
	
}
