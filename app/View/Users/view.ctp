<?php $this->Html->addCrumb(__('Benutzerverwaltung'), '/users'); ?>
<?php $this->Html->addCrumb(__('Benutzer anzeigen'), ''); ?>

<h2><?php echo __('Benutzer').': '.h($user['User']['username']) ; ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Benutzer-ID: '); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Benutzergruppe: '); ?></dt>
		<dd>
			<?php echo h($user['Group']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Benutzername: '); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Erstellungsdatum: '); ?></dt>
		<dd>
			<?php echo $this->Time->format('d.m.Y, H:i',$user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Änderungsdatum: '); ?></dt>
		<dd>
			<?php echo $this->Time->format('d.m.Y, H:i', $user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Letzter Login: '); ?></dt>
		<dd>
			<?php
				if(isset($user['User']['lastlogin'])) {
					echo $this->Time->format('d.m.Y, H:i', $user['User']['lastlogin']); 	
				}else{
					echo '-';
				}
				
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Benutzer aktiv: '); ?></dt>
		<dd>
			<?php echo h($user['User']['enabled']); ?>
			&nbsp;
		</dd>
	</dl>
</div>