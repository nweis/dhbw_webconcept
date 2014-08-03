<div class="row">

	<div class="col-sm-3 col-md-2 sidebar">
		<h3><?php echo __('Aktionen'); ?></h3>
		<?php echo $this->Html->link(__('Benutzer hinzufügen'), array('action' => 'add'), array('class'=>'btn btn-default')); ?>
	</div>

	
		<div class="col-md-10">
			<h2><?php echo __('Benutzerverwaltung'); ?></h2>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
				<tr>
						<th><?php echo $this->Paginator->sort('username', __('Benutzername')); ?></th>
						<th><?php echo $this->Paginator->sort('group_id', __('Gruppe')); ?></th>
						<th class="actions"><?php echo __('Aktionen'); ?></th>
				</tr>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
					<td><?php echo h($user['Group']['name']); ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('Anzeigen'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
						&nbsp;
						<?php echo $this->Html->link(__('Bearbeiten'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
						&nbsp;
						<?php echo $this->Form->postLink(__('Löschen'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-default btn-xs'), __('Sind Sie sicher, dass Sie den Benutzer "%s" entfernen wollen?', $user['User']['username'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				</table>
			</div>
			<p class="text-center">
				<?php
					echo $this->Paginator->counter(array(
						'format' => __('Seite {:page} von {:pages}, zeige {:current} Datensätze von {:count} insgesamt an, beginnend bei {:start}, endend bei {:end}')
					));
				?>	
			</p>
			<div class="text-center">
				<?php echo $this->Paginator->pagination(array(
					'ul' => 'pagination'
				)); ?>
			</div>
		
	</div>

</div>