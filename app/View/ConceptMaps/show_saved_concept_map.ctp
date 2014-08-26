<?php
    // Helper JS laden
    echo $this->Html->script('jquery.jsPlumb-1.6.2-min', array('inline' => true));
    echo $this->Html->script('jsPlumbConfig', array('inline' => true));
?>    

<div id="wrapper">    
    <div id="sidebar-wrapper">      
        <ul class="sidebar-nav" id="appendKeyword">
            <li id="sidebar-header" class="sidebar-brand"><?php echo $conceptMap['ConceptMap']['name'] ?></li>
            <?php foreach ($conceptMap['Keyword'] as $keyword): ?>
                <li class="keyword" draggable="true" id="<?php echo $keyword['id'] ?>"><?php echo $keyword['name'] ?></li>
            <?php endforeach ?>
            
        </ul>
    </div>
  <div id="sidebarMenu">
            <a href="#menu-toggle" onclick="changeClass()" id="menu-toggle"><span id="changeIcon" class="glyphicon glyphicon-chevron-left"></span></a>
            <a href="" id="newOwnKeyword" class="new"><span class="glyphicon glyphicon-plus"></span></a>
    </div>
    <!-- In diesem Container können die einzelnen Keywords per D&D positioniert werden. -->
    <div id="main">
            <div class="concept-map" id="concept-map">
            </div>
        </div>
</div>