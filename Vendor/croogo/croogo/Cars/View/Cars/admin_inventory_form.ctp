<?php

$this->extend('/Common/admin_edit');




$this->append('tab-heading');
	echo $this->Croogo->adminTab(__d('croogo', 'Summary'), '#inventory-summary');
	echo $this->Croogo->adminTab(__d('croogo', 'Detail'), '#inventory-details');
	echo $this->Croogo->adminTab(__d('croogo', 'Description'), '#inventory-description');
	echo $this->Croogo->adminTab(__d('croogo', 'Extras'), '#inventory-extras');
	echo $this->Croogo->adminTab(__d('croogo', 'Photos'), '#inventory-photos');
	echo $this->Croogo->adminTab(__d('croogo', 'SEO'), '#inventory-seo');
	echo $this->Croogo->adminTabs();
$this->end();

$this->append('tab-content');
$this->append('form-start', $this->Form->create('Inventory'));
echo $this->Html->script(array(
		'/cars/js/admin',
));
	echo $this->Html->tabStart('inventory-summary') ;
	
	echo $this->Form->input('id') ;
	echo $this->Form->input('reference_id', array(
			'label' => __d('croogo', 'Reference ID:'),
			'type'=>'text'
		)) ;
	echo $this->Form->input('make_id', array(
			'label' => __d('croogo', 'Make:'),
			'options'=>$make_options,
			'empty'=>true
	)) ;
	echo $this->Form->input('model_id', array(
			'label' => __d('croogo', 'Model:'),
			'options'=>$model_options,
			'empty'=>true
	)) ;
	echo $this->Form->input('status', array(
			'label' => __d('croogo', 'Status'),
			'options'=>array('0'=>'inactive','1'=>'Active')
	)) ;
	echo $this->Form->input('supplier_id', array(
			'label' => __d('croogo', 'Suppliers'),
			'empty'=>true
			//'options'=>array('0'=>'inactive','1'=>'Active')
	)) ;	
	
	echo $this->Html->tabEnd();

	echo $this->Html->tabStart('inventory-details') .
		$this->Form->input('title', array(
			
		)) .
		$this->Form->input('emission_class', array(
		'options'=>	$emission_classes
		)).
		$this->Form->input('color', array(
					
		)).
		$this->Form->input('doors', array(
					
		)).
		$this->Form->input('fuel', array(
					
		)).
		$this->Form->input('gearbox', array(
					
		)).
		$this->Form->input('number_of_seat', array(
		'options'=>	$number_of_seat		
		)).
		$this->Form->input('vehicle_type', array(
				'options'=>	$vehicle_types
		)).
		$this->Form->input('price', array(
					
		)).
		$this->Form->input('first_registration', array(
			'type'=>'text'		
		)).
		$this->Form->input('mileage', array(
					
		)).
		$this->Form->input('power', array(
			//'label' => __d('croogo', 'Fax'),
		));
	
	echo $this->Html->tabEnd();

	
	
	echo $this->Html->tabStart('inventory-description') .
		$this->Form->input('description', array(
			//'label' => __d('croogo', 'Let users leave a message'),
		)) ;
	echo $this->Html->tabEnd();
	
	
	echo $this->Html->tabStart('inventory-extras') ;
	
	
	echo $this->Form->input('CarExtra.id', array(
			'label' => __d('croogo', 'Extras'),
			'options'=>$extras,
			'type' => 'select',
			'multiple' => 'checkbox',
	));
	

	echo $this->Html->tabEnd();
	
	echo $this->Html->tabStart('inventory-photos') .
	
	
	$this->Form->input('Photos', array(
			'type' => 'file',
			'multiple' => TRUE,
			'label' => __d('croogo', ''),
	));

	echo $this->Html->tabEnd();
	
	echo $this->Html->tabStart('inventory-seo') .
	$this->Form->input('meta_title', array(
			
	)) .
	$this->Form->input('meta_keywords', array(
			
	)) .
	$this->Form->input('meta_description', array(
			
	));
	
	
	echo $this->Html->tabEnd();	
	echo $this->Croogo->adminTabs();
$this->end();

$this->append('panels');
	 
		
		echo$this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) .
		$this->Html->link(
			__d('croogo', 'Cancel'),
			array('action' => 'index'),
			array('button' => 'danger')
		) ;

	

 echo $this->Croogo->adminBoxes();
$this->end();

$this->append('form-end', $this->Form->end());

?>
<?php /*
$this->Js->get('#InventoryMakeId')->event('change', 
$this->Js->request(array(
'plugin'=>'cars',		
'controller'=>'cars',
'action'=>'loadoptions'
), array(
'update'=>'#InventoryModelId',
'async' => true,
'method' => 'post',
'dataExpression'=>true,
'data'=> $this->Js->serializeForm(array(
'isForm' => true,
'inline' => true
))
))
);*/
?>
