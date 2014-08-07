// Methode wird verwendet um dynamisch Input-Fields zu erzeugen (View/Keywords/Add)
function newInputField(){
	var i = $('#moreInputs').attr('value');
	i = parseFloat(i)+1;
	$('#inputFields').clone().attr('id','inputFields'+i).appendTo('#moreInputs');
	$('#inputFields'+i).find('#Keyword0Name').attr({
		id:'Keyword'+i+'Name',
		name: 'data[Keyword]['+i+'][name]'
	});
	$('#Keyword'+i+'Name').val(' ');
	$('#moreInputs').attr('value',i);
	$('#Keyword0ConceptMapId').clone().attr({
		id:'Keyword'+i+'ConceptMapId',
		name: 'data[Keyword]['+i+'][concept_map_id]'
	}).appendTo('#Keyword0ConceptMapId');
	$('#dif').show();
}
function delInputField(){
	var i = $('#moreInputs').attr('value');
	i = parseFloat(i);
	$('#inputFields'+i).remove();
	$('#Keyword'+i+'ConceptMapId').remove();
	i = parseFloat(i)-1;
	$('#moreInputs').attr('value',i);
	if(i === 0) {
		$('#dif').hide();
	}
}