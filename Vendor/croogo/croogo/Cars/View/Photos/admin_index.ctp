<?php 
echo $this->Form->create('Photo',array('type'=>'file'));
echo $this->Form->input('name');
echo $this->Form->input('files', array(
		'type' => 'file',
		'multiple' => TRUE,
		'label' => __d('croogo', ''),
		//'name'=>'files'
));
echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success','id'=>'btn-success'));
echo $this->Form->end();
?>
<?php 
$this->Js->get('#PhotoFiles')->event('change', 
$this->Js->request(array(
'plugin'=>'cars',		
'controller'=>'photos',
'action'=>'ajaxFrontCardUpload'
), array(
'update'=>'#InventoryModelId',
'async' => true,
'method' => 'post',
'dataExpression'=>true,
'data'=> $this->Js->serializeForm(array(
	'isForm'=>false	
		
))
))
);
?>
<div class="Images_wrapper">
<div id="InventoryModelId"></div>
</div>