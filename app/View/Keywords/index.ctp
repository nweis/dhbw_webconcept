<?php $this->Html->addCrumb(__('Concept-Maps'), '/concept_maps'); ?>
<?php $this->Html->addCrumb($conceptMap['ConceptMap']['name'], ''); ?>

<div class="keywords index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Begriffe von').' '.$conceptMap['ConceptMap']['name']; ?></h1>
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
										__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; Begriff erstellen'),
										array('action' => 'add', $conceptMap['ConceptMap']['id']), array('escape' => false)); ?>
								</li>
									<li>
									<?php echo $this->Html->link(
										__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Concept Maps anzeigen'),
										array('controller' => 'concept_maps',
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
						<th><?php echo $this->Paginator->sort('created', __('Erstellt')); ?></th>
						<th><?php echo $this->Paginator->sort('modified', __('Verändert')); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($keywords as $keyword): ?>
					<tr>
						<td><?php echo h($keyword['Keyword']['name']); ?>&nbsp;</td>
						<td><?php echo $this->Time->format('d.m.Y, H:m', $keyword['Keyword']['created']); ?>&nbsp;</td>
						<td><?php echo $this->Time->format('d.m.Y, H:m', $keyword['Keyword']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $keyword['Keyword']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $keyword['Keyword']['id']), array('escape' => false), __('Sind Sie sicher, dass # %s löschen wollen?', $keyword['Keyword']['id'])); ?>
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