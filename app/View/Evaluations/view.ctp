
<?php
    // Helper JS laden
    echo $this->Html->script('jquery.jsPlumb-1.6.2-min', array('inline' => true));
    echo $this->Html->script('jsPlumbConfig', array('inline' => true));

?>    

<div id="wrapper">
	<?php echo $evaluation['Evaluation']['content']; ?>
</div>
