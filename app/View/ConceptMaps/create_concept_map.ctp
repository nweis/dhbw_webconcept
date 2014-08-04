
<?php
    // Helper JS laden
    echo $this->Html->script('jquery.jsPlumb-1.6.2-min', array('inline' => true));
    echo $this->Html->script('create-concept-map', array('inline' => true));
?>    

<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li id="sidebar-header" class="sidebar-brand"><?php echo $conceptMap['ConceptMap']['name'] ?></li>
            <?php foreach ($conceptMap['Keyword'] as $keyword): ?>
                <li class="keyword" draggable="true" id="<?php echo $keyword['id'] ?>"><?php echo $keyword['name'] ?></li>    
            <?php endforeach ?>
        </ul>
        
        <!-- Diesen Button sollte man noch schöner positionieren -->
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
    </div>

    <!-- In diesem Container können die einzelnen Keywords per D&D positioniert werden. -->
    <div id="container">
    </div>

</div>