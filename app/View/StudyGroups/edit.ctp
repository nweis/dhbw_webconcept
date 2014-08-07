<?php
	// Breadcrumb-Leiste hinzu fügen
	$this->Html->addCrumb(__('Studiengruppen'), '/study_groups');
	$this->Html->addCrumb(__('Studiengruppe bearbeiten'), '');
?>

<div class="studyGroups form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Studiengruppe bearbeiten'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('StudyGroup', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Speichern'), array('class' => 'btn btn-primary')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
