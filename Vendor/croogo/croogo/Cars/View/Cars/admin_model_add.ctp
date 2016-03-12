<?php

$this->extend('/Common/admin_edit');


if ($this->request->params['action'] == 'admin_model_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('MakeModel');

echo $this->Html->tabStart('contact-message') .
$this->Form->input('id') .
		$this->Form->input('model_name', array(
			'label' => __d('croogo', 'Model'),
		)) .
		$this->Form->input('make_id', array('label' => __d('croogo', 'Make'),'empty' => true,)) .
	    $this->Html->tabEnd();


$this->end();

echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) ;
echo $this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'model'),
		array('button' => 'danger')
		) ;

echo  $this->Form->end();
