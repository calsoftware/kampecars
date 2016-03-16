<?php

App::uses('CarsAppModel', 'Cars.Model');

/**
 * Cars
 *
 * @category Extra
 */
class CarExtra extends CarsAppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'CarExtra';
	public $useTable = 'car_extra_list';

	public $belongsTo = array('Cars.Extra');
	
	
/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		
	);
}
