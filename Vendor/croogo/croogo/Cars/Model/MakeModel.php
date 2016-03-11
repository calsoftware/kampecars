<?php

App::uses('CarsAppModel', 'Cars.MakeModel');

/**
 * Menu
 *
 * @category MakeModel
 */
class MakeModel extends AppModel {

/**
 * MakeModel name
 *
 * @var string
 * @access public
 */
	public $name = 'MakeModel';
	public $useTable = 'car_models';


/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'model_name' => array(
			'rule' => array('minLength', 2),
			'message' => 'Make name cannot be empty.',
		),
		
	);
	public $belongsTo = array('Cars.Make');	
	protected $_displayFields = array(
			'id',
			'model_name',
			'created',
			'Make.name' => 'Make',
				
	);
}
