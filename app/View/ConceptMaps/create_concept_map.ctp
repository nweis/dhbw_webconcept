
<?php
    // Helper JS laden
    echo $this->Html->script('jquery.jsPlumb-1.6.2-min', array('inline' => true));
    echo $this->Html->script('jsPlumbConfig', array('inline' => true));
    echo $this->Html->script('avgrund', array('inline' => true));
    echo $this->Html->css('avgrund');
?>    

<div id="wrapper">    
    <aside id="popup" class="avgrund-popup">
        <form id="PersgrpForm" role="form">
            <div>Bitte wählen Sie Ihre entsprechende Personengruppe aus:</div>
            <input type="Radio" name="Personengruppe" value="Student" checked="checked" /> Student <br/>
            <input type="Radio" name="Personengruppe" value="IT-Professional" /> IT-Professional <br/>
            <button class="btn btn-primary" type="button" id="submitPersgrp" value="Weiter" onclick="hidePopup()">Weiter</button>
        </form>
    </aside>

    <div id="sidebar-wrapper">      
        <ul class="sidebar-nav" id="appendKeyword">
            <li id="sidebar-header" class="sidebar-brand"><?php echo $conceptMap['ConceptMap']['name'] ?><br /></li>
            <li class="sidebar-brand2" id="getPersgrp"></li>
            <?php foreach ($conceptMap['Keyword'] as $keyword): ?>
                <li class="keyword" draggable="true" id="<?php echo $keyword['id'] ?>"><?php echo $keyword['name'] ?></li>
            <?php endforeach ?>
            
        </ul>
    </div>
  <div id="sidebarMenu">
            <a href="#menu-toggle" onclick="changeClass()" id="menu-toggle"><span id="changeIcon" class="glyphicon glyphicon-chevron-left"></span></a>
            <a href="" id="newOwnKeyword" class="new"><span class="glyphicon glyphicon-plus"></span></a>
            <a href="" id="saveCM" class="new borderTop"><span class="glyphicon glyphicon-floppy-open"></span></a>
    </div>
    <!-- In diesem Container können die einzelnen Keywords per D&D positioniert werden. -->
    <div id="main">
            <div class="concept-map" id="concept-map">
            </div>
        </div>
</div>
<div class="avgrund-cover"></div>
<script>

//x dient zum Hochzählen der IDs der neuen Keywords.
var x = 1;
//Wenn der Button zum Hinzufügen eines Keywords geklickt wurde
$('#newOwnKeyword').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    //Wenn die Klasse = "new" ist, führe das aus.
    if($(this).attr("class") == "new"){
        $('#appendKeyword').append('<li id="deleteLi"><input id="inputNewKeyword" placeholder="Neues Keyword"/></li>');
        $('#inputNewKeyword').focus();
        //Die Klasse wird zu save geändert, somit kann der Button Klick unterschieden werden, ob ein neues Keyword hinzugefügt werden soll, oder ob dies bereits passierte und es noch gespeichert werden muss.
        $('#newOwnKeyword').attr('class', 'save');
        //Icon des Buttons ändern.
        $('#newOwnKeyword span').switchClass("glyphicon-plus","glyphicon-floppy-saved");

        return false;
    }
    else{
        //Wenn eine Eingabe erfolte!
        var val = $('#inputNewKeyword').val().trim();
        if(val != ""){
            $('#appendKeyword').append('<li id="new'+x+'" class="keyword ownKeyword" draggable="true">'+val+'</li>');
            addEventListenerForDragStart("new"+x);
            x = x+1;
        }
        //Ändere Button, um neue Einghabe zu ermöglichen
        $('#deleteLi').remove();
        $('#newOwnKeyword').attr('class', 'new');
        $('#newOwnKeyword span').switchClass("glyphicon-floppy-saved","glyphicon-plus");
        
    }
    
});
$('#saveCM').click(function(e) {
    var confirm = window.confirm("Wollen Sie die Concept-Map beenden und absenden");
    if(confirm == true){
        
    }
    else{
        return false;
    }
    
});

</script>