<h1><?php echo __('Passwort ändern')?></h1>
<?php echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<?php
		echo $this->Form->input('old_password', array(
			'label' => __('Altes Passwort'),
			'type' => 'password',
			'required' => true
			)
		);
		echo $this->Form->input('password', array(
			'label' => __('Neues Passwort'),
			'type' => 'password',
			'required' => true
			)
		);
		echo $this->Form->input('password_repeat', array(
			'label' => __('Passwort wiederholen'),
			'type' => 'password',
			'required' => true
			)
		);
	?>
	<div class="form-group">
		<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit(__('Passwort ändern'), array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
		</div>
	</div>
<?php echo $this->Form->end(); ?>