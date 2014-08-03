<?php 
$user = AuthComponent::user();

$username = $user['username'];

?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">DHBW-Lörrach Concept-Map-Tool</a>
    </div>
    <div class="navbar-collapse collapse">
    	
    	<ul class="nav navbar-nav">
            <li <?php if($this->params['action'] == 'display') {echo 'class="active"';} ?>>
            	<a href="/"><?php echo __('Startseite'); ?></a>
            </li>

            <li <?php if($this->params['controller'] == 'concept_maps') {echo 'class="active"';} ?>>
              <a href="/concept_maps"><?php echo __('Concept-Maps'); ?></a>
            </li>

            <?php if($this->Session->read('Auth.User.group_id') == 1) { ?>
            <li class="dropdown <?php 
                if($this->params['controller'] == 'users' && !($this->params['action'] == 'changePassword')) {
                    echo 'active';
                } ?>
              ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Administration'); ?><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/users/index"><?php echo __('Benutzerverwaltung') ?></a></li>
              </ul>
            </li>
            <?php } ?>
        </ul>

        <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Eingeloggt als: ').$username.'  ';?><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/users/changePassword"><span class="glyphicon glyphicon-lock"></span>&nbsp;<?php echo __('Passwort ändern'); ?></a></li>
                <li>
            		<a href="/users/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<?php echo __('Ausloggen');?></a>
            	</li>
              </ul>
            </li>
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	            	<img src="/img/<?php echo $this->Session->read('Config.language'); ?>.png"/><b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu">
	              	<li>
	              		<a href="/setLanguage/deu"><img src="/img/deu.png" class="language"/><?php echo __('Deutsch');?></a>
	              	</li>
	               	<li>
	            		<a href="/setLanguage/eng" ><img src="/img/eng.png" class="language"/><?php echo __('English');?></a>
	            	</li>
	            </ul>
			</li>

        </ul>


    </div><!--/.nav-collapse -->
  </div>
</div>