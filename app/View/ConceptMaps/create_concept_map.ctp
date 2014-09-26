<?php
    // Helper JS laden
    echo $this->Html->script('jquery.jsPlumb-1.6.2-min', array('inline' => true));
    echo $this->Html->script('jsPlumbConfig', array('inline' => true));
    echo $this->Html->script('avgrund', array('inline' => true));
    echo $this->Html->css('avgrund');
    $i = count($conceptMap['StudyGroup']);
?>    
<?php // Zeige Popup nur dann an, wenn Studiengruppen definiert sind; ?>
<?php if ($i > 0): ?>
    <aside id="popup" class="avgrund-popup">
        <form id="PersgrpForm" role="form">
            <div>Bitte wählen Sie Ihre entsprechende Personengruppe aus:</div>
            <?php foreach ($conceptMap['StudyGroup'] as $studyGroup): ?>
                <input type="Radio" name="Personengruppe" id="<?php echo $studyGroup['name']; ?>" value="<?php echo $studyGroup['id'] ?>"/>&nbsp;<?php echo $studyGroup['name']; ?><br/>
            <?php endforeach ?>
            <button class="btn btn-primary" type="button" id="submitPersgrp" value="Weiter" onclick="hidePopup()">Weiter</button>
        </form>
    </aside>    
<?php endif ?>

<aside id="help" class="avgrund-popup col-md-6">
        <div>
            <h2>HELP:</h2>
            <h3>Concept-Map-Objekte positionieren</h3>
            <p>Um eine Concept-Map zu erstellen ziehen Sie (per Drag & Drop) die Begriffe aus der linken Spalte in den weißen Bereich der Webseite.
                Per Drag & Drop können Sie bereits angelegte Objekte neu poositionieren</p>
            <h3>Beziehungen zwischen 2 Objekten erstellen</h3>
            <p>Um eine Beziehung zwischen 2 Objekten herzustellen, klicken Sie (per Drag & Drop) auf ein organgenes Quadrat eines Objektes. Ziehen Sie dieses in ein anderes Objekt und lassen es dort los. Geben Sie einen Namen ein um die Beziehung zu betiteln. Ein Objekt kann maximal 5 Beziehungen besitzen. Die Beziehungen sind ausschließlich gerichtet möglich.</p>
            <h3>Objekte oder Beziehungen korrigieren/löschen</h3>
            <p>Um ein Objekt oder eine Beziehung zu löschen, klicken Sie per Doppelklick auf das entsprechende Objekt oder die entsprechende Beziehung.
                Die Beziehung verschwindet und eine neue Beziehung kann erstellt werden. Das Objekt erscheint nach einem Doppelklick wieder in der Liste.</p>
            </p>
            <h3>Neue Begriffe anlegen</h3>
            <p>Um weitere Begriffe anzulegen, klicken Sie oben links im Menü auf das Plus-Zeichen. Ein neues Eingabefeld wird unter den Begriffen in der Liste erscheinen. Geben Sie den Begriff ein und bestätigen diesen mit der Enter-Taste.</p>
            <h3>Concept-Map speichern</h3>
            <p>Um die Concept-Map zu speichern und die Arbeit zu beenden, klicken Sie oben links auf das Disketten-Symbol. Eine Sicherheits-Abfrage wird angezeigt, die Sie mit "Ja" bestätigen.
            Ihre Concept-Map wird gespeichert und Sie können von nun an nichts mehr ändern.
            </p>
            <button class="btn btn-primary" type="button" value="close" onclick="hidePopup()">Schließen</button>
        </div>
    </aside>    

<div id="wrapper">    
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
    <div id="helpRight">
        <a href="#" onclick="helpPopup()">?</a>
    </div>
    <!-- In diesem Container können die einzelnen Keywords per D&D positioniert werden. -->
    <div id="main">
        <div class="concept-map" id="concept-map">
        </div>
    </div>
</div>

<?php echo $this->Form->create('Evaluation', array('url' => array('controller' => 'evaluations', 'action' => 'add'))); ?>
<?php echo $this->Form->hidden('concept_map_id', array('value' => $conceptMap['ConceptMap']['id']));?>
<?php echo $this->Form->hidden('study_group_id');?>
<?php echo $this->Form->hidden('content');?>
<?php echo $this->Form->hidden('evaluated', array('value' => 0));?>
<?php echo $this->Form->end() ?>

<div class="avgrund-cover"></div>
<script>

x = 1;
//Wenn der Button zum Hinzufügen eines Keywords geklickt wurde
$('#newOwnKeyword').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    if($('#deleteLi').length > 0){
        $('#inputNewKeyword').focus();
        return false;
    }
    else{
        //Wenn die Klasse = "new" ist, führe das aus.
        $('#appendKeyword').append('<li id="deleteLi"><input id="inputNewKeyword" placeholder="Neues Keyword"/></li>');
        $('#inputNewKeyword').focus();
        return false;
    }
});
$(document).keypress(function(e) {
    if(e.which == 13) {
        var val = $('#inputNewKeyword').val().trim();
        if(val != ""){
            $('#appendKeyword').append('<li id="new'+x+'" class="keyword ownKeyword" draggable="true">'+val+'</li>');
            addEventListenerForDragStart("new"+x);
            $('#deleteLi').remove();
            x = x+1;
        }
    }
});
$('#saveCM').click(function(e) {
    e.preventDefault();
    var confirm = window.confirm("Wollen Sie die Concept-Map beenden und absenden?");
    if(confirm == true){
        $('#sidebarMenu').remove();
        var evaluationContent = $('#wrapper').html();
        $('#EvaluationContent').val(evaluationContent);
        document.forms["EvaluationCreateConceptMapForm"].submit();
    }
    else{
        return false;
    }
    
});

</script>