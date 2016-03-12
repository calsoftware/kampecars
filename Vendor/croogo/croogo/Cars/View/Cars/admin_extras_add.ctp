<?php

if ($this->request->params['action'] == 'admin_extras_edit') {
	$this->Html->addCrumb($this->request->data['Extra']['name']);
}

if ($this->request->params['action'] == 'admin_make_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Extra');

echo $this->Html->tabStart('contact-message') .
        $this->Form->input('id') .
		$this->Form->input('name', array(
			'label' => __d('croogo', 'Extras'),
		)) .
	 $this->Html->tabEnd();


$this->end();

echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) ;
echo $this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'make'),
		array('button' => 'danger')
		) ;

echo  $this->Form->end();
