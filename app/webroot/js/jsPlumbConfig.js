var instance;
var globalFadeEffectInMilliSeconds = 400;

jsPlumb.ready(function() {

	init();

	/**
	 * Init-Methode für den initialen Start der visuellen Concept-Map-Erstellung
	 * @return {[type]} [description]
	 */

	// setup some defaults for jsPlumb.
	instance = jsPlumb.getInstance({
		Endpoint : ["Dot", {radius:2}],
		HoverPaintStyle : {strokeStyle:"#1e8151", lineWidth:2 },
		ConnectionOverlays : [
			[ "Arrow", {
				location:1,
				id:"arrow",
                length:14,
                foldback:0.8
			} ],
            [ "Label", { label:"Zieh mich", id:"label", cssClass:"aLabel" }]
		],
		Container:"concept-map"
	});

    // initialise draggable elements.
	instance.draggable($("#concept-map .w"));

    // bind a click listener to each connection; the connection is deleted. you could of course
	// just do this: jsPlumb.bind("click", jsPlumb.detach), but I wanted to make it clear what was
	// happening.

	instance.bind("dblclick", function(c) {
		instance.detach(c);
	});
	/* Funktioniert noch nicht wie gewollt
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	instance.bind("click", function(c) {
		var name = window.prompt("Gebe einen Namen für die Beziehung zwischen den beiden Elementen ein", "Name der Beziehung");
		c.setLabel(name);
	});*/
	
	// bind a connection listener. note that the parameter passed to this function contains more than
	// just the new connection - see the documentation for a full list of what is included in 'info'.
	// this listener sets the connection's internal
	// id as the label overlay's text.
    instance.bind("connection", function(info) {
    	var name = window.prompt("Gebe einen Namen für die Beziehung zwischen den beiden Elementen ein", "Name der Beziehung");
	   	if(name == null){
 			info.connection.getOverlay("label").setLabel("...nicht vergeben...");
    	}
    	else{
			info.connection.getOverlay("label").setLabel(name);
		}
    });


	// suspend drawing and initialise.
	instance.doWhileSuspended(function() {
		var isFilterSupported = instance.isDragFilterSupported();
		// make each ".ep" div a source and give it some parameters to work with.  here we tell it
		// to use a Continuous anchor and the StateMachine connectors, and also we give it the
		// connector's paint style.  note that in this demo the strokeStyle is dynamically generated,
		// which prevents us from just setting a jsPlumb.Defaults.PaintStyle.  but that is what i
		// would recommend you do. Note also here that we use the 'filter' option to tell jsPlumb
		// which parts of the element should actually respond to a drag start.
		// here we test the capabilities of the library, to see if we
		// can provide a `filter` (our preference, support by vanilla
		// jsPlumb and the jQuery version), or if that is not supported,
		// a `parent` (YUI and MooTools). I want to make it perfectly
		// clear that `filter` is better. Use filter when you can.
		if (isFilterSupported) {
			instance.makeSource($("#concept-map .w"), {
				filter:".ep",
				anchor:"Continuous",
				Endpoint : ["Dot", {radius:2}],	
  				connectionsDetachable:false,
				connector:[ "StateMachine", { curviness:20 } ],
				connectorStyle:{ strokeStyle:"#5c96bc", lineWidth:2, outlineColor:"transparent", outlineWidth:4 },
				maxConnections:5,
				onMaxConnections:function(info, e) {
					alert("Maximale Anzahl an Beziheungen (" + info.maxConnections + ") erreicht");
				}
			});
		}
		else {
			var eps = jsPlumb.getSelector(".ep");
			for (var i = 0; i < eps.length; i++) {
				var e = eps[i], p = e.parentNode;
				instance.makeSource(e, {
					parent:p,
					anchor:"Continuous",
					Endpoint : ["Dot", {radius:2}],	
  					connectionsDetachable:false,
					connector:[ "StateMachine", { curviness:20 } ],
					connectorStyle:{ strokeStyle:"#5c96bc",lineWidth:2, outlineColor:"transparent", outlineWidth:4 },
					maxConnections:5,
					onMaxConnections:function(info, e) {
						alert("Maximale Anzahl an Beziheungen (" + info.maxConnections + ") erreicht");
					}
				});
			}
		}
	});

	// initialise all '.w' elements as connection targets.
	instance.makeTarget($("#concept-map .w"), {
		dropOptions:{ hoverClass:"dragHover" },
		anchor:"Continuous",	
  		connectionsDetachable:false,
		allowLoopback:true
	});


});
function changeClass(){
	if($('#changeIcon').attr("class") == "glyphicon glyphicon-chevron-left"){
		$('#changeIcon').switchClass( "glyphicon-chevron-left", "glyphicon-chevron-right");
		$('#newKeyword').hide();
	}
	else{		
		$('#changeIcon').switchClass( "glyphicon-chevron-right", "glyphicon-chevron-left");
		$('#newKeyword').show();
	}
}
/*function addOwnKeyword(){
	var li = $("<li><input id='inputNewKeyword' placeholder='Neues Keyword'/></li>");
	$("#appendKeyword").append(li);
	return false;
}*/
	function init() {
		// Ids der Keywords ziehen
		var keywordIds = $('ul.sidebar-nav li').map(function () {
			return this.id;
		}).get();

		// Über keywords drüber schleifen und eventListener setzen
		for (j = 0; j < keywordIds.length; j++) {
			addEventListenerForDragStart(keywordIds[j]);
		}

		// Container als dropable-target markieren
		var drawingContainer = document.getElementById("concept-map");
		drawingContainer.addEventListener('dragover', allowDrop, false);
		drawingContainer.addEventListener('drop', dropKeyword, false);

		jsPlumb.setContainer(document.getElementById("concept-map"));

		// Toggling aktivieren
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		return;
	}
	
	// Methode ermöglicht neue Elemente durch Drag&Drop hinzuzufügen
	function dropKeyword(event) {
		// Weiterleitung als default-Action verhindern
		event.preventDefault();

		// Eigenschaften aus dem transfer-Element ziehen
		var keywordTitle = event.dataTransfer.getData("text");
		var keywordId = event.dataTransfer.getData("id");

		// Element aus der Liste entfernen
		removeElementFromKeywordList(keywordId);

		// Neues Keyword erzeugen
		var newKeyword = $('<div>').attr('id', keywordId).addClass('w').text(keywordTitle);
		var childElem = $('<div>').addClass('ep');


		// Position des neuen Elements setzen
		newKeyword.css({
			'top': event.pageY,
			'left': event.pageX
		});
		// Elemente (Titel und Connector an newKeyword anhängen)
		newKeyword.append(childElem);

		// Neues Keyword an das #concept-map -Element anhängen
		$('#concept-map').append(newKeyword);

		// Durch einen Doppelklick ein Element wieder entfernbar machen
		newKeyword.dblclick(function() {
			var idToRestore = $(this).attr("id");
			var nameToRestore = $(this).html();
			// Alle Verbindungen entfernen
			instance.detachAllConnections($("#"+idToRestore));
			$(this).fadeOut(globalFadeEffectInMilliSeconds, function() {$(this).remove();});
			addElementToKeywordList(idToRestore, nameToRestore);
		});
		// Neues Keyword verschiebbar machen
		instance.draggable($("#concept-map"));
		instance.draggable(newKeyword,{
			containment: 'parent'
		});
		
		// Neues Keyword zum Ziel eines Connectors machen
		instance.makeTarget(newKeyword, {
		dropOptions:{ hoverClass:"dragHover" },	
  		connectionsDetachable:false,
		anchor:"Continuous",
		allowLoopback:true
		});

 	
		// Neues Keyword zur Quelle eines Connectors machen
		instance.makeSource(newKeyword, {
				filter:".ep",
				anchor:"Continuous",
				endpoint : ["Dot", {radius:2}],	
  				connectionsDetachable:false,
				connector:[ "StateMachine", { curviness:20 } ],
				connectorStyle:{ strokeStyle:"#5c96bc", lineWidth:2, outlineColor:"transparent", outlineWidth:4 },
				maxConnections:5,
				onMaxConnections:function(info, e) {
					alert("Maximum connections (" + info.maxConnections + ") reached");
				}
			});
		
	}

	// Function bei dragstart
	function doDragStart(event) {
		event.dataTransfer.setData("Text", event.target.innerHTML);
		event.dataTransfer.setData("id", event.target.id);
	}

	// Function um einen Drop zu erlauben
	function allowDrop(event) {
		event.preventDefault();
	}

	/**
	 * Methode wird verwendet, um eine gegebene Id aus der KeywordList zu entfernen
	 * @param  {int} id Id of the element to remove
	 */
	function removeElementFromKeywordList(id) {
		$('#' + id).fadeOut(globalFadeEffectInMilliSeconds, function() {$(this).remove();});
		return;
	}

	/**
	 * Methode wird verwendet um nach dem Löschen eines Schlüsselwortes aus der Concept-Map dieses erneut in die Sidebar einzufügen
	 * @param {[type]} id   [description]
	 * @param {[type]} name [description]
	 */
	function addElementToKeywordList(id, name) {
		var keywordToAdd = $('<li>').addClass('keyword').attr({draggable: "true", id: id}).html(name);
		$('.sidebar-nav').append(keywordToAdd.hide().fadeIn(globalFadeEffectInMilliSeconds));
		addEventListenerForDragStart(id);
		$('#'+id+' .ep').remove();
		return;
	}

	/**
	 * Methode wird verwendet um ein keyword mit einem EventListener für Drag&Drop auszustatten
	 * @param {[type]} id [description]
	 */
	function addEventListenerForDragStart(id) {
		var keyword = document.getElementById(id);
		keyword.addEventListener('dragstart', doDragStart, false);

		return;
	}

