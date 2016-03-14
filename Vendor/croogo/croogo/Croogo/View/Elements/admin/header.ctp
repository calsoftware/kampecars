<?php

$dashboardUrl = Configure::read('Croogo.dashboardUrl');

?>
<!-- 
<header class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="<?php echo $this->Theme->getCssClass('container'); ?>">
			<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<span class="hidden-phone">
			<?php echo $this->Html->link(Configure::read('Site.title'), $dashboardUrl, array('class' => 'brand ellipsis')); ?>
			</span>
			<span class="hidden-desktop hidden-tablet">
			<?php echo $this->Html->link(__d('croogo', 'Dashboard'), $dashboardUrl, array('class' => 'brand')); ?>
			</span>
			<div class="hidden nav-collapse collapse" style="height: 0px; ">
			<?php
				echo $this->Croogo->adminMenus(CroogoNav::items('top-left'), array(
					'type' => 'dropdown',
					'htmlAttributes' => array(
						'id' => 'top-left-menu',
						'class' => 'nav',
					),
				));
			?>
			<?php if ($this->Session->read('Auth.User.id')): ?>
			<?php
				echo $this->Croogo->adminMenus(CroogoNav::items('top-right'), array(
					'type' => 'dropdown',
					'htmlAttributes' => array(
						'id' => 'top-right-menu',
						'class' => 'nav pull-right',
					),
				));
			?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</header>
 -->
 
 
  
<div class="container-fluid  ims-dashborad-top ">
		
		<div class="logo col-md-8" style="">
		<?php 
		
  	   $logo=	$this->Html->image('/Cars/images/kampe-logo.png');
		echo $this->Html->link(	$logo, $dashboardUrl, array('class' => 'logo')); ?>
		</div>	
		
		<div class="top-user-block pull-right col-md-4">
<?php if ($this->Session->read('Auth.User.id')): ?>
		Welcome,	<?php 	$name = $this->Session->read('Auth.User.name'); 
		$userId = $this->Session->read('Auth.User.id');
		echo $this->Html->link($name,array('controller'=>'users','plugin'=>'users','action'=>'edit',$userId));?>
			<?php endif; ?>
</div>
	
</div>
 
<div class="container-fluid  ims-dashborad-div">
		<h1><?php echo $title_for_layout;?>	</h1>
</div>
<style>
#wrap > nav{padding-top:0px; }
#push{display: none;}
.ims-dashborad-top {text-align: center;min-height:50px;}
.ims-dashborad-div {background: #AAA9A9;text-align: center; color: #fff;}
#wrap > nav{margin-top:0; }
.top-user-block.pull-right.col-md-4 {
    position: absolute;
    right: 40px;
    top: 30px;
}
#content-container{padding: 0;}
h1{font-size: 28px;}
</style>