<?php 
if($photos_list){
echo '<ul class="carphoto">';
foreach($photos_list as $photo){
echo '<li>';
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
echo '</li>';	
}
echo '</ul>';
}?>
<style>
.carphoto{margin: 0; padding: 0; margin-top: 10px;}
.carphoto li{display: inline-block; padding: 10px; list-style: none;}
</style>