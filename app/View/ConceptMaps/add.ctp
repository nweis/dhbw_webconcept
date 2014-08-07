<?php
	// Breadcrumb-Leiste hinzu fügen
	$this->Html->addCrumb(__('Concept-Maps'), '/concept_maps');
	$this->Html->addCrumb(__('Concept-Map erstellen'), '');
?>

<div class="conceptMaps form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Neue Concept-Map erstellen'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('ConceptMap', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<?php if (!empty($study_groups)): ?>
					<div class="form-group">
						<?php 
							echo $this->Form->input('StudyGroup', array(
								'label' => __('Studiengruppen zuordnen'),
								'class' => 'checkbox-inline',
								'multiple' => 'checkbox',
								'options' => $study_groups,
								)
							);
						?>
					</div>	
				<?php else: ?>
					<div class="form-group">
						<p><?php echo __('Hinweis: Um Studiengruppen zuzuweisen, legen Sie diese im Menüpunkt "Studiengruppen" an.') ?></p>
					</div>
				<?php endif ?>
				
				<div class="form-group">
					<?php echo $this->Form->submit(__('Speichern'), array('class' => 'btn btn-primary')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
