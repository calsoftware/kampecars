<?php
App::uses ( 'CarsAppModel', 'Cars.Model' );

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
	public $belongsTo = array (
			'Cars.Extra' 
	);
	
	/**
	 * Validation
	 *
	 * @var array
	 * @access public
	 */
	public $validate = array ();

	public function saveCarExtra($id, $rowdata) {
		if (isset ( $rowdata ['CarExtra'] ['extra_id'] )) {
			$this->deleteAll ( array (
					'CarExtra.car_id' => $id 
			), false );
			$datalist = array ();
			$i = 0;
			if(!empty($rowdata ['CarExtra'] ['extra_id'])){
			foreach ( $rowdata ['CarExtra'] ['extra_id'] as $eid ) {
				$row = array ();
				$row ['extra_id'] = $eid;
				$row ['car_id'] = $id;
				$row ['order'] = $i ++;
				
				$datalist ['CarExtra'] = $row;
				$this->saveAll ( $datalist );
			}
		}
			return 1;
		}
	}
}
