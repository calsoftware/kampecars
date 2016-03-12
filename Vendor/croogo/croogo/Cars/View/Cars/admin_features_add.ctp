<?php
echo $this->Form->create('Feature');

echo $this->Html->tabStart('contact-message') .
$this->Form->input('id') .
		$this->Form->input('name', array(
			'label' => __d('croogo', 'Car Feature'),
		)) .
		$this->Form->input('feature_type_id', array('options'=>$featuretypes,'label' => __d('croogo', 'Feature Type'),'empty' => true,)) .
	    $this->Html->tabEnd();


$this->end();

echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) ;
echo $this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'model'),
		array('button' => 'danger')
		) ;

echo  $this->Form->end();
