<?php

App::uses('CarsAppModel', 'Cars.Model');

/**
 * Menu
 *
 * @category Make
 */
class Make extends CarsAppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'Make';
	public $useTable = 'car_makes';


/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
			'name' => array(
					'isUnique' => array(
							'rule' => 'isUnique',
							'message' => 'This Make is already exist.',
					),
					'minLength' => array(
							'rule' => array('minLength', 2),
			             'message' => 'Make name cannot be empty.',
					),
			),
		
	);
	protected $_displayFields = array(
			'id',
			'name',
			'created',
			
	);
}
