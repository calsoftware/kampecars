<?php
$this->extend('/Common/admin_index');

$this->append('actions');

	echo $this->Croogo->adminAction(
		__d('croogo', 'Add'),
		array('action' => 'extras_add'),
		array('button' => 'success')
	);
$this->end();

	if (isset($this->request->params['named'])) {
		foreach ($this->request->params['named'] as $nn => $nv) {
			$this->Paginator->options['url'][] = $nn . ':' . $nv;
		}
	}

	$this->append('form-start', $this->Form->create('Extra', array(
		'url' => array(
			'action' => 'process',
		
		),
	)));

$this->start('table-heading');
	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Form->checkbox('checkAll'),
		//__d('croogo', 'Id'),
		__d('croogo', 'Extras'),
		__d('croogo', 'Status'),
		__d('croogo', 'Actions'),
	));
	echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');

	$rows = array();
	foreach ($Extras as $item):
		$actions = array();

		
				$actions[] = $this->Croogo->adminRowAction('',
					array('action' => 'extras_edit', $item[$modelClass]['id']),
					array('icon' => $this->Theme->getIcon('update'), 'tooltip' => __d('croogo', 'Edit this item'))
				);
				$actions[] = $this->Croogo->adminRowActions($item[$modelClass]['id']);
				$actions[] = $this->Croogo->adminRowAction('',
					array(
						'action' => 'extras_delete',
						$item[$modelClass]['id'],
					),
					array(
						'icon' => $this->Theme->getIcon('delete'),
						'tooltip' => __d('croogo', 'Remove this item')
					),
					__d('croogo', 'Are you sure?'));
		$actions = $this->Html->div('item-actions', implode(' ', $actions));
		$item[$modelClass]['status']=$item[$modelClass]['status']==1?'Active':'Inactive';

		$rows[] = array(
			$this->Form->checkbox('id', array('class' => 'row-select')),
			$item[$modelClass]['name'],
			$item[$modelClass]['status'],
			$actions,
		);
		
	endforeach;

	echo $this->Html->tableCells($rows);

$this->end();

$this->start('bulk-action');
	echo $this->Form->input('Link.action', array(
		'div' => 'input inline',
		'label' => false,
		'options' => array(
			'publish' => __d('croogo', 'Publish'),
			'unpublish' => __d('croogo', 'Unpublish'),
			'delete' => __d('croogo', 'Delete'),
			'copy' => array(
				'value' => 'copy',
				'name' => __d('croogo', 'Copy'),
				'hidden' => true,
			),
		),
		'empty' => true,
	));
$button = $this->Form->button(__d('croogo', 'Submit'), array(
		'type' => 'submit',
		'value' => 'submit',
	));
echo $this->Html->div('controls', $button);

$this->end();

$this->append('form-end',$this->Form->end());
