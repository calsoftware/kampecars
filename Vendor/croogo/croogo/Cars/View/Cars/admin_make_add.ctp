<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => $this->Theme->getIcon('home')))
	->addCrumb(__d('croogo', 'Makes'), array('controller' => 'cars', 'action' => 'make'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Contact']['title']);
}

if ($this->request->params['action'] == 'admin_make_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Make');

echo $this->Html->tabStart('contact-message') .
        $this->Form->input('id') .
		$this->Form->input('name', array(
			'label' => __d('croogo', 'Make'),
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
