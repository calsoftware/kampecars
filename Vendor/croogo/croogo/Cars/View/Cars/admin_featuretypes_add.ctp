<?php

echo $this->Form->create('FeatureType');

echo $this->Html->tabStart('contact-message') .
        $this->Form->input('id') .
		$this->Form->input('name', array(
			'label' => __d('croogo', 'Feature Type'),
		)) .
	 $this->Html->tabEnd();


$this->end();

echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) ;
echo $this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'featuretypes'),
		array('button' => 'danger')
		) ;

echo  $this->Form->end();
