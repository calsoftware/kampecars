<div class="block push contact-wrap">
<div class="page-heading">
		<div class="container">
			<h1 class="heading">Contact Us</h1>
		</div>
	</div>
    <div class="container">
<div class="row">    
<!--<div id="contact-<?php echo $contact['Contact']['id']; ?>" class="">
	<h2><?php echo $contact['Contact']['title']; ?></h2>-->
	<div class="col-sm-5 col-md-4">
	<?php echo $contact['Contact']['body']; ?>
	</div>
<div class="col-sm-7 col-md-8">
	<?php if ($contact['Contact']['message_status']): ?>
	<div class="contact-form">
	<?php
		echo $this->Form->create('Message', array(
			'url' => array(
				'plugin' => 'contacts',
				'controller' => 'contacts',
				'action' => 'view',
				$contact['Contact']['alias'],
			),
			'class'=>'home-search form-dyna xo contact-form',
		));
		echo $this->Form->input('Message.name', array('div'=>'group','class'=>'form-control' ,'label' => __d('croogo', 'Your name')));
		echo $this->Form->input('Message.email', array('div'=>'group','class'=>'form-control' ,'label' => __d('croogo', 'Your email')));
		echo $this->Form->input('Message.title', array('div'=>'group','class'=>'form-control' ,'label' => __d('croogo', 'Subject')));
		echo $this->Form->input('Message.body', array('div'=>'group','class'=>'form-control' ,'label' => __d('croogo', 'Message')));
		if ($contact['Contact']['message_captcha']):
			echo $this->Recaptcha->display_form();
		endif;
		echo $this->Form->end(__d('croogo', 'Send'));
	?>
	</div>
	<?php endif; ?>
    </div>
<!--</div>-->
</div>
</div>
</div>