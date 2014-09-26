<?php $this->Html->addCrumb(__('Concept-Maps'), '/concept_maps'); ?>
<?php $this->Html->addCrumb($conceptMap['ConceptMap']['name'], '/keywords/index/'.$conceptMap['ConceptMap']['id']); ?>
<?php $this->Html->addCrumb(__('Resultate für').' '.$conceptMap['ConceptMap']['name']); ?>

<div class="evaluations index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Resultate für').' '.$conceptMap['ConceptMap']['name']; ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->

	<div class="row">
		<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="col-sm-1"><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
						<th><?php echo $this->Paginator->sort('study_group_id', __('Studiengruppe')); ?></th>
						<th><?php echo $this->Paginator->sort('created', __('Erstellt')); ?></th>					
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($evaluations as $evaluation): ?>
					<tr>
						<td><?php echo h($evaluation['Evaluation']['id']); ?>&nbsp;</td>
						<td><?php echo h($evaluation['StudyGroup']['name']); ?></td>

						<td><?php echo $this->Time->format('d.m.Y, H:i', $evaluation['Evaluation']['created']); ?>&nbsp;</td>

						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $evaluation['Evaluation']['id']), array('escape' => false, 'target' => '_blank')); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $evaluation['Evaluation']['id']), array('escape' => false), __('Sind Sie sicher, dass Sie die Auswertung mit der ID #%s löschen wollen?', $evaluation['Evaluation']['id'])); ?>
						</td>

					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p class="text-center">
				<small><?php echo $this->Paginator->counter(array('format' =>__('Seite {:page} von {:pages}, zeige {:current} Datensätze von {:count} insgesamt an, beginnend bei {:start}, endend bei {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<div class="text-center">
				<?php
					echo $this->Paginator->pagination(array('ul' => pagination));				?>
			</div>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->