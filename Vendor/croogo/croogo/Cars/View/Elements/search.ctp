<?php

echo $this->Html->script(array(
		'/cars/js/admin',
));

if (empty ( $modelClass )) {
	$modelClass = Inflector::singularize ( $this->name );
}
if (! isset ( $className )) {
	$className = strtolower ( $this->name );
}

?>
<div class="<?php echo $className; ?> filter">
<?php
$actionadd = strtolower ( $modelClass ) . '_add';
if ($modelClass == 'FeatureType') {
	$actionadd = 'featuretypes_add';
}
if ($modelClass == 'Extra') {
	$actionadd = 'extras_add';
}
if ($modelClass == 'MakeModel') {
	$actionadd = 'model_add';
}
if ($modelClass == 'Feature') {
	$actionadd = 'features_add';
}
?>
<?php

echo $this->Form->create ( $modelClass, array (
		'class' => 'form-inline',
		'type' => 'get',
		'novalidate' => true,
		'url' => array (
				'plugin' => $this->request->params ['plugin'],
				'controller' => $this->request->params ['controller'],
				'action' => $this->request->params ['action'] 
		) 
) );
echo $this->Croogo->adminAction ( __d ( 'croogo', 'Add' ), array (
		'action' => $actionadd 
), array (
		'button' => 'success' 
) );

$search_val = isset ( $this->request->query ['name'] ) ? $this->request->query ['name'] : '';
$status_val = isset ( $this->request->query ['status'] ) ? $this->request->query ['status'] : 'any';
echo $this->Form->input ( 'name', array (
		'label' => false,
		'placeholder' => 'Serach...',
		'value' => $search_val 
) );
$options = array (
		'any' => 'All',
		'active' => 'Acitve',
		'inactive' => 'In Active' 
)
;
// echo $this->Form->input('status',array('options'=>$options,'label' => false,'value'=>$status_val));
echo $this->Form->input ( __d ( 'croogo', 'Search' ), array (
		'type' => 'submit',
		'label' => false 
) );
foreach ( $options as $i => $j ) {
	echo $this->Html->link ( __d ( 'croogo', $j ), array (
			'plugin' => $this->request->params ['plugin'],
			'controller' => $this->request->params ['controller'],
			'action' => $this->request->params ['action']."?status=$i",
			 
	), array (
			'button' => 'status' 
	) );
}

echo $this->Form->end ();
?>
</div>

