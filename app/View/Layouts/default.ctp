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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __('CakePHP Boilerplate by flux-services.net');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
	</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('custom');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery-1.11.0.min'); // Include jQuery library
		echo $this->Html->script('bootstrap.min'); // Include bootstrap library
	?>
</head>
<body role="document">
	<?php 
		// Unterschiedliche Navigationsleiste - je nachdem ob der Benutzer eingeloggt ist, oder nicht
		if($this->Session->read('Auth.User')) { // Wenn Benutzer eingeloggt ist
			if($this->Session->read('Auth.User.group_id') == '1') { // Wenn Benutzer Administrator ist, dannn...
				echo $this->element('navigation');	
			}else{ // Wenn Benutzer kein Administrator ist, dann...
				echo $this->element('navigation'); 
			}
			?>			
	<?php 
		}else{ // Wenn Benutzer nicht eingeloggt ist
			echo $this->element('navigationNotLoggedIn');	
		}
	?>

	<div class="container">
		<?php 
			$all_crumbs = $this->Html->getCrumbs(';');
			$crumbs = explode(";", $all_crumbs);

			$amountCrumbs = count($crumbs);
			$i = 0;

			if(isset($all_crumbs)) {				
				echo '<ol class="breadcrumb">';
				foreach ($crumbs as $key => $crumb) {
					if(++$i === $amountCrumbs) {
   						echo '<li class="active">';
  					}else{
						echo '<li>';
  					}
  					echo $crumb;
					echo '</li>';
				};
				echo '</ol>';
			}
		?>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<hr />

	<footer class="text-center">	
		<?php
			echo $this->Html->link(__('powered by flux-services.net'),'http://flux-services.net/', array('id'=>'flux', 'target'=>'_blank'));
		?>
	</footer>

</body>
</html>