<?php

App::uses('CarsAppModel', 'Cars.Model');

/**
 * Menu
 *
 * @category MakeModel
 */
class Supplier extends CarsAppModel {

/**
 * MakeModel name
 *
 * @var string
 * @access public
 */
	public $name = 'Supplier';
	public $useTable = 'car_suppliers';


/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'supplier_name' => array(
			'rule' => array('minLength', 2),
			'message' => 'Supplier name cannot be empty.',
		),
		'city' => array(
			'rule' => array('minLength', 2),
			'message' => 'city name cannot be empty.',
		),
		'post_code' => array(
			'rule' => array('minLength', 2),
			'message' => 'post_code cannot be empty.',
		),
		
	);
	protected $_displayFields = array(
			'id',
			'name',
			'status',
				
	);	
	
}
