/**
 * document ready
 *
 * @return void
 */
$(function() {
	Admin.toggleRowSelection('#InventoryCheckAll_');
	Admin.toggleRowSelection('#ExtraCheckAll');
	Admin.toggleRowSelection('#MakeCheckAll');
	Admin.toggleRowSelection('#MakeModelCheckAll');
	Admin.toggleRowSelection('#FeatureCheckAll');
	
	$('#InventoryMakeId').change(function(){
		var id =$(this).val();
		Admin.dyanamicOptions('#InventoryMakeId','#InventoryModelId',id,'MakeModel');
	
	});
});

/**
 * Helper method to get the proper icon class name based on theme settings
 */
Admin.dyanamicOptions = function(selector,target, default_value,action) {
	var url  ;
	$.ajax({
		url:Croogo.basePath+'admin/cars/cars/loadoptions',
		type:'get',
		data:{act:action,id:default_value},
		beforeSend:function(){
			$(target).html('<option>Loading...</option>').attr('readonly',true); 
		},
		success:function(rs){
			$(target).html(rs).removeAttr('readonly');
		},
		error:function(){
			
		}
		
	});
}