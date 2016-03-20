<?php 
echo '<div class="carphoto Images_wrapper">';
if($photos_list){

foreach($photos_list as $photo){
echo '<div class="photo-single">';
echo '<a href="#" class="removephoto" title="Remove '.$photo['title'].'"></a>';
		$mimeType = explode('/', $photo['mime_type']);
		$imageType = $mimeType['1'];
		$mimeType = $mimeType['0'];
		$imagecreatefrom = array('gif', 'jpeg', 'png', 'string', 'wbmp', 'webp', 'xbm', 'xpm');
		if ($mimeType == 'image' && in_array($imageType, $imagecreatefrom)) {
			$imgUrl = $this->Image->resize('/uploads/' . $photo['slug'], 75, 75, false, array('alt' => $photo['title']));
			$thumbnail = $this->Html->link($imgUrl, $photo['path'],
			array('escape' => false, 'class' => 'thickbox', 'title' => $photo['title']));
		} else {
			$thumbnail = $this->Html->thumbnail('/croogo/img/icons/page_white.png', array('alt' => $photo['mime_type'])) . ' ' . $photo['mime_type'] . ' (' . $this->Filemanager->filename2ext($photo['slug']) . ')';
		}
echo $thumbnail;
echo '<input type="hidden" name="photos_ids[]" value="'.$photo['id'].'" />';
echo '</div>';	
}

}
echo '<div id="Inventorycarsphots"></div>';
echo '</div>';
?>
<style>
.carphoto{margin: 0; padding: 0; margin-top: 10px;}
.carphoto .photo-single{display: inline-block; padding: 10px; list-style: none;}
</style>