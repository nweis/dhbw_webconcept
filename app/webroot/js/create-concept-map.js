jsPlumb.ready(function() {

	var globalFadeEffectInMilliSeconds = 400;

	init();
	
	/**
	 * Init-Methode für den initialen Start der visuellen Concept-Map-Erstellung
	 * @return {[type]} [description]
	 */
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
		var drawingContainer = document.getElementById("container");
		drawingContainer.addEventListener('dragover', allowDrop, false);
		drawingContainer.addEventListener('drop', dropKeyword, false);

		jsPlumb.setContainer(document.getElementById("container"));

		// Toggling aktivieren
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		return;
	}
	
	// Methode ermöglicht neue Elemente durch Drag&Drop hinzuzufügen
	function dropKeyword(event) {
		// Eigenschaften aus dem transfer-Element ziehen
		var keywordTitle = event.dataTransfer.getData("text");
		var keywordId = event.dataTransfer.getData("id");

		// Element aus der Liste entfernen
		removeElementFromKeywordList(keywordId);

		// Neues Keyword erzeugen
		var newKeyword = $('<div>').attr('id', keywordId).addClass('item');

		// Title des Objekts erzeugen
		var title = $('<div>').addClass('title').text(keywordTitle);

		// Connector Element erzeugen
		var connect = $('<div>').addClass('connect');

		// Position des neuen Elements setzen
		newKeyword.css({
			'top': event.pageY,
			'left': event.pageX
		});

		// Neues Keyword zum Ziel eines Connectors machen
		jsPlumb.makeTarget(newKeyword, {
			anchor: 'Continuous'
		});

		// Neues Keyword zur Quelle eines Connectors machen
		jsPlumb.makeSource(connect, {
			parent: newKeyword,
			anchor: 'Continuous'
		});

		// Elemente (Titel und Connector an newKeyword anhängen)
		newKeyword.append(title);
		newKeyword.append(connect);

		// Neues Keyword an das container-Element anhängen
		$('#container').append(newKeyword.hide().fadeIn(globalFadeEffectInMilliSeconds));

		// Neues Keyword verschiebbar machen
		jsPlumb.draggable(newKeyword, {
			containment: 'parent'
		});
 
		// Durch einen Doppelklick ein Element wieder entfernbar machen
		newKeyword.dblclick(function(event) {

			var idToRestore = $(this).attr("id");
			var nameToRestore = $(this).children(".title").html();
			
			// Alle Verbindungen entfernen
			jsPlumb.detachAllConnections($(this));
			$(this).fadeOut(globalFadeEffectInMilliSeconds, function() {$(this).remove();});
			event.stopPropagation();

			addElementToKeywordList(idToRestore, nameToRestore);

		});
	}

	// Function bei dragstart
	function doDragStart(event) {
		event.dataTransfer.setData("text", event.target.innerHTML);
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

});