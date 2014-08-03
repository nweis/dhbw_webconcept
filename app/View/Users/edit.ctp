<?php $this->Html->addCrumb(__('Benutzerverwaltung'), '/users'); ?>
<?php $this->Html->addCrumb(__('Benutzer bearbeiten'), ''); ?>

<?php echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
		),
	'class' => 'well form-horizontal')
	); ?>
<?php
	echo $this->Form->input('id');
	echo $this->Form->input('group_id', array('label' => 'Benutzergruppe'));
	echo $this->Form->input('username', array('label' => 'Benutzername'));
	echo $this->Form->input('password', array('label' => 'Passwort', 'type' => 'password', 'value' => ''));
	echo $this->Form->input('password_repeat', array('label' => __('Passwort wiederholen'), 'type' => 'password', 'value' => ''));
	echo $this->Form->input('enabled', array(
		'label' => __('Benutzer aktiv?'),
		'type' => 'checkbox',
		'wrapInput' => 'col col-md-9 col-md-offset-3',
		'class' => false
		)
	);
?>
<div class="form-group">
	<div class="col col-md-9 col-md-offset-3">
		<?php echo $this->Form->submit('Änderungen speichern', array(
			'div' => false,
			'class' => 'btn btn-primary'
		)); ?>
		<?php echo $this->Html->link(__('Abbrechen'), array('action' => 'index'), array('class'=>'btn btn-default')); ?></li>
	</div>
</div>


<?php echo $this->Form->end(); ?>