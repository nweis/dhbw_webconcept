<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="<?php echo $pluralVar; ?> index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo "<?php echo __('Aktionen');?>" ?></div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
							<?php
								echo "\t<li>\n";
								echo "\t\t\t\t\t\t\t\t\t<?php echo \$this->Html->link(\n";
								echo "\t\t\t\t\t\t\t\t\t\t__('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp; " . $singularHumanName . " erstellen'),\n";
								echo "\t\t\t\t\t\t\t\t\t\tarray('action' => 'add'), array('escape' => false)); ?>\n";
								echo "\t\t\t\t\t\t\t\t</li>\n";
							?>
							<?php
								$done = array();
								foreach ($associations as $type => $data) {
									foreach ($data as $alias => $details) {
										if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
											echo "\t\t<li>\n";
											echo "\t\t\t\t\t\t\t\t\t<?php echo \$this->Html->link(\n";
											echo "\t\t\t\t\t\t\t\t\t\t__('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp; " . Inflector::humanize($details['controller']) . " anzeigen'),\n";
											echo "\t\t\t\t\t\t\t\t\t\tarray('controller' => '{$details['controller']}',\n";
											echo "\t\t\t\t\t\t\t\t\t\t'action' => 'index'), array('escape' => false)); ?>\n";
											echo "\t\t\t\t\t\t\t\t</li>\n";

											echo "\t\t\t\t\t\t\t\t<li>\n";
											echo "\t\t\t\t\t\t\t\t\t<?php echo \$this->Html->link(\n";
											echo "\t\t\t\t\t\t\t\t\t\t__('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp; " . Inflector::humanize(Inflector::underscore($alias)) . " erstellen'),\n";
											echo "\t\t\t\t\t\t\t\t\t\tarray('controller' => '{$details['controller']}',\n";
											echo "\t\t\t\t\t\t\t\t\t\t'action' => 'add'), array('escape' => false)); ?>\n";
											echo "\t\t\t\t\t\t\t\t</li>\n";
										}
									}
								}
							?>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
			<?php foreach ($fields as $field): ?>
			<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
			<?php endforeach; ?>
			<th class="actions"><?php "<?php echo __('Aktionen'); ?>" ?></th>
					</tr>
				</thead>
				<tbody>
			<?php
			echo "\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
			echo "\t\t\t\t\t<tr>\n";
				foreach ($fields as $field) {
					$isKey = false;
					if (!empty($associations['belongsTo'])) {
						foreach ($associations['belongsTo'] as $alias => $details) {
							if ($field === $details['foreignKey']) {
								$isKey = true;
								echo "\t\t\t\t\t\t\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
								break;
							}
						}
					}
					if ($isKey !== true) {
						echo "\t\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
					}
				}

				echo "\t\t\t\t\t\t<td class=\"actions\">\n";
				echo "\t\t\t\t\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-search\"></span>', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>\n";
				echo "\t\t\t\t\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-edit\"></span>', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>\n";
				echo "\t\t\t\t\t\t\t<?php echo \$this->Form->postLink('<span class=\"glyphicon glyphicon-remove\"></span>', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false), __('Sind Sie sicher, dass # %s löschen wollen?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
				echo "\t\t\t\t\t\t</td>\n";
			echo "\t\t\t\t\t</tr>\n";

			echo "\t\t\t\t<?php endforeach; ?>\n";
			?>
				</tbody>
			</table>

			<p class="text-center">
				<small><?php echo "<?php echo \$this->Paginator->counter(array('format' =>__('Seite {:page} von {:pages}, zeige {:current} Datensätze von {:count} insgesamt an, beginnend bei {:start}, endend bei {:end}')));?>"; ?></small>
			</p>

			<?php
				echo "<?php\n";
				echo "\t\t\t\$params = \$this->Paginator->params();\n";
				echo "\t\t\tif (\$params['pageCount'] > 1) {\n";
				echo "\t\t\t?>\n";
			?>
			<div class="text-center">
			<?php
				echo "\t<?php\n";
				echo "\t\t\t\t\techo \$this->Paginator->pagination(array('ul' => pagination));";
				echo "\t\t\t\t?>\n";
			?>
			</div>
			<?php 
				echo "<?php } ?>\n";
			?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->