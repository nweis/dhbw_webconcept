<div class="conceptMaps index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Concept-Maps'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo __('Aktionen');?></div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li>
									<?php echo $this->Html->link(
										__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; Concept Map erstellen'),
										array('action' => 'add'), array('escape' => false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(
										__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Studiengruppen anzeigen'),
										array('controller' => 'study_groups',
										'action' => 'index'), array('escape' => false)); ?>
								</li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('name', __('Name')); ?></th>
						<th><?php echo __('Zugeordnete Studiengruppen'); ?></th>
						<th><?php echo $this->Paginator->sort('created', _('Erstellt')); ?></th>
						<th><?php echo $this->Paginator->sort('modified', __('Verändert')); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($conceptMaps as $conceptMap): ?>
					<tr>
						<td><?php echo $this->Html->link(
							$conceptMap['ConceptMap']['name'],
							array(
								'controller' => 'keywords',
								'action' => 'index', 
								$conceptMap['ConceptMap']['id']
								)
							); ?>&nbsp;</td>
						<td>
						<?php 
							$amountOfStudyGroups = count($conceptMap['StudyGroup']);
							if($amountOfStudyGroups == 0) {
									echo __('-');
								}
						?>
						<?php foreach ($conceptMap['StudyGroup'] as $studyGroup): ?>
							<?php
								if($amountOfStudyGroups == 0) {
									echo __('- Keine Studiengruppen zugeordnet -');
								}
								if($amountOfStudyGroups == 1) {
									echo $studyGroup['name'];
								}else{
									echo $studyGroup['name'].', ';
								}
								$amountOfStudyGroups = $amountOfStudyGroups - 1;
							?>
						<?php endforeach ?>
						</td>
						<td><?php echo $this->Time->format('d.m.Y, H:i' ,$conceptMap['ConceptMap']['created']); ?>&nbsp;</td>
						<td><?php echo $this->Time->format('d.m.Y, H:i' ,$conceptMap['ConceptMap']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $conceptMap['ConceptMap']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $conceptMap['ConceptMap']['id']), array('escape' => false), __('Sind Sie sicher, dass Sie die Concept-Map "%s" löschen wollen? Alle zugeordneten Keywords werden ebenfalls gelöscht.', $conceptMap['ConceptMap']['name'])); ?>
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