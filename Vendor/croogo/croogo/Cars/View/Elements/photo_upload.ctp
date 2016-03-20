<?php 
$method=isset($method)&&$method?$method:'replace';
?>
<script type="text/javascript">
$(document).ready(function(){

	$('.removephoto').click(function(){
    $(this).parent('.photo-single').fadeOut().remove();
    return false;
		});
	var selector ='<?php echo $selector?>';
	var method = '<?php echo $method?>';
$('#button-upload').on('click', function() {
	$('#form-upload').remove();
	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file[]" value="" multiple="multiple" /></form>');	
	$('#form-upload input[name=\'file[]\']').trigger('click');
	
	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}
		
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file[]\']').val() != '') {
			clearInterval(timer);
			
			$.ajax({
				url: Croogo.basePath+'admin/cars/photos/upload',
				type: 'post',		
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				//data: $('#form-upload').serialize(),
				cache: false,
				contentType: false,
				processData: false,		
				beforeSend: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$('#button-upload').prop('disabled', true);
				},
				complete: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
					$('#button-upload').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}
					
					if (json['success']) {
						
						if(json['uploadlist']){
							//uploadlist =json['uploadlist'];
                           
							
							
							if(method=='before'){
								 $(selector).before(json['uploadlist']);
							}else if(method=='after'){
								$(selector).after(json['uploadlist']);
							}
							else{
								 $(selector).html(json['uploadlist']);
								}
							alert(json['success']);
						}else{
							alert('Error Occured. Please try again.');
							}
						
					}
				},			
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});	
		}
	}, 500);
});

});
</script>
<style>

.photo-single {
    display: inline;
    padding: 10px;
}
</style>
  <button type="button" data-toggle="tooltip" title="Upload" id="button-upload" class="btn btn-primary"><i class="fa fa-upload"></i>Upload Photo</button>
