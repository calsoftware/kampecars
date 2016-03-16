<?php

App::uses('CarsAppModel', 'Cars.Model');

/**
 * Cars
 *
 * @category Extra
 */
class Extra extends CarsAppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'Extra';
	public $useTable = 'car_extras';

/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
			'name' => array(
					'minLength' => array(
							'rule' => array('minLength', 2),
			             'message' => 'Make name cannot be empty.',
					),
			),
		
	);
	protected $_displayFields = array(
			'id',
			'name'=>'Extras',
			'status',
			
	);
}
