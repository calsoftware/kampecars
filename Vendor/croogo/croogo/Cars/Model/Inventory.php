<?php

App::uses('CarsAppModel', 'Cars.Model');

/**
 * Cars
 *
 * @category Inventory
 */
class Inventory extends CarsAppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'Inventory';
	public $useTable = 'car_inventories';


/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $hasMany = array(
			'CarExtra' => array(
					'className' => 'Cars.CarExtra',
					'foreignKey' => 'car_id',
				//	'conditions' => array('CarExtra.status' => '1'),
				//	'order' => 'CarExtra.created DESC',
					// 'dependent' => false
			),
			'Photo' => array(
					'className' => 'Cars.Photo',
					//'foreignKey' => 'car_id',
					//	'conditions' => array('CarExtra.status' => '1'),
					//	'order' => 'CarExtra.created DESC',
				//	'dependent' => false
			)
	);
	

	
	public $belongsTo = array(
			'Color' => array(
					'className' => 'Cars.Feature',
					'foreignKey' => 'color',
					//'conditions' => array('Color.status' => '1'),
			),
			'Door' => array(
					'className' => 'Cars.Feature',
					'foreignKey' => 'doors',
					//'conditions' => array('Color.status' => '1'),
			),
			'Fuel' => array(
					'className' => 'Cars.Feature',
					'foreignKey' => 'fuel',
					//'conditions' => array('Color.status' => '1'),
			),
			'EmissionClass' => array(
					'className' => 'Cars.Feature',
					'foreignKey' => 'emission_class',
					//'conditions' => array('Color.status' => '1'),
			),
			'Make' => array(
					'className' => 'Cars.Make',
					'foreignKey' => 'make_id',
					//'conditions' => array('Color.status' => '1'),
			),
			'MakeModel' => array(
					'className' => 'Cars.MakeModel',
					'foreignKey' => 'model_id',
					//'conditions' => array('Color.status' => '1'),
			),
			'Supplier' => array(
					'className' => 'Cars.Supplier',
					'foreignKey' => 'supplier_id',
					//'conditions' => array('Color.status' => '1'),
			)
			
	);
	
	public $validate = array(
				
			'reference_id' => array(
					'isUnique' => array(
							'rule' => 'isUnique',
							'message' => 'The Reference No already exists.',
							'last' => true,
					),
					
					'nonEmpty' =>array(
							'rule' => array('minLength', 2),
							'message' => 'Reference No. cannot be empty.',
					),
				),
			'make_id' => array(
					'rule' => 'notEmpty',
					'message' => 'This field cannot be left blank.',
			),
			'supplier_id' => array(
					'rule' => 'notEmpty',
					'message' => 'This field cannot be left blank.',
			),
			'title' => array(
					'rule' => 'notEmpty',
					'message' => 'This field cannot be left blank.',
			),
			'price' => array(
					'rule' => 'notEmpty',
					'message' => 'This field cannot be left blank.',
			),
			'meta_title' => array(
					'rule' => 'notEmpty',
					'message' => 'Meta title cannot be left blank.',
			),											
			'description' => array(
					'rule' => 'notEmpty',
					'message' => 'Description cannot be left blank.',
			),	
	   );

	
	public function beforeDelete($cascade = true) {
		return true;
	}
}
