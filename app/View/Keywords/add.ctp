<?php
	// Breadcrumb-Leiste hinzu fügen
	$this->Html->addCrumb(__('Concept-Maps'), '/concept_maps');
	$this->Html->addCrumb($conceptMap['ConceptMap']['name'], '/keywords/index/'.$conceptMap['ConceptMap']['id']);
	$this->Html->addCrumb(__('Neuen Begriff erstellen')); 

	// Helper JS laden
	$this->Html->script('keywords-add', array('inline' => false));
?>

<div class="keywords form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Neuen Begriff erstellen'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Keyword', array('role' => 'form')); ?>

				<?php $this->Form->unlockField('Keyword.name');?>
				<?php $this->Form->unlockField('Keyword.concept_map_id');?>

				<div class="form-group" id="inputFields">
					<?php echo $this->Form->input('Keyword.0.name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div id="moreInputs" value="0"></div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Speichern'), array('class' => 'btn btn-primary', 'div' => false)); ?>
					<input class="btn btn-info" onclick="newInputField()" value="<?php echo __('Weiterer Begriff');?>">
				</div>
			
			<?php echo $this->Form->hidden('Keyword.0.concept_map_id', array('value' => $conceptMap['ConceptMap']['id']));?>
			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
