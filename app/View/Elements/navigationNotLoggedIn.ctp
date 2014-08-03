<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">DHBW Concept-Map-Tool</a>
    </div>
    <div class="navbar-collapse collapse">
	 <?php    
	    echo $this->Form->create('User', array(
	    	'action' => 'login',
	    	'class' => 'navbar-form navbar-right',
	    	'inputDefaults' => array(
				'div' => 'form-group',
	    		'class' => 'form-control'
	    		)
	    	)
	    	
	    );
		echo $this->Form->input('username', array(
			'required' => false,
			'class' => 'form-control',
			'placeholder' => __('Benutzername'),
			'label' => false,
			)
		);
		echo $this->Form->input('password', array(
			'required' => false,
			'class' => 'form-control',
			'placeholder' => __('Passwort'),
			'label' => false,
			)
		);
		echo $this->Form->submit('Anmelden', array(
					'div' => false,
					'class' => 'btn btn-success'
				));
		echo $this->Form->end();
	?>
    </div><!--/.nav-collapse -->
  </div>
</div>