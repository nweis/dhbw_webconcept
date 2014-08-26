<?php
	// Breadcrumb-Leiste hinzu fügen
	$this->Html->addCrumb(__('Concept-Maps'), '/concept_maps');
	$this->Html->addCrumb($conceptMap['ConceptMap']['name'], '/keywords/index/'.$conceptMap['ConceptMap']['id']);
	$this->Html->addCrumb(__('Begriff bearbeiten')); 
?>
<div class="keywords form">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Begriff bearbeiten'); ?></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Keyword', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Speichern'), array('class' => 'btn btn-primary')); ?>
				</div>

			<?php echo $this->Form->hidden('concept_map_id', array('value' => $conceptMap['ConceptMap']['id']));?>
			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>