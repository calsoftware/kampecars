<?php

$this->extend('/Common/admin_edit');


echo $this->Form->create('Supplier');

echo $this->Html->tabStart('contact-message') .
        $this->Form->input('id') .
		$this->Form->input('supplier_name', array(
			'label' => __d('croogo', 'Supplier name'),
		)) .
		$this->Form->input('address1', array(
				'label' => __d('croogo', 'Address'),
		)) .
	/*	$this->Form->input('address2', array(
				'label' =>false,
		)) .*/
		$this->Form->input('city', array(
			'label' => __d('croogo', 'City'),
		)) .
		$this->Form->input('post_code', array(
			'label' => __d('croogo', 'Post Code'),
		)) .
	 $this->Html->tabEnd();


$this->end();

echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) ;
echo $this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'index'),
		array('button' => 'danger')
		) ;

echo  $this->Form->end();
