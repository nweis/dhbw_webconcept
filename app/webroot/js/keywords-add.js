// Methode wird verwendet um dynamisch Input-Fields zu erzeugen (View/Keywords/Add)
function newInputField(){
	var i = $('#moreInputs').attr('value');
	i = parseFloat(i)+1;
	$('#inputFields').clone().attr('id','inputFields'+i).appendTo('#moreInputs');
	$('#inputFields'+i).find('#Keyword0Name').attr({
		id:'Keyword'+i+'Name',
		name: 'data[Keyword]['+i+'][name]'
	});
	j = i+1;
	$('#inputFields'+i).find('label').html('Begriff '+j);
	$('#Keyword'+i+'Name').val('');
	$('#moreInputs').attr('value',i);
	$('#Keyword0ConceptMapId').clone().attr({
		id:'Keyword'+i+'ConceptMapId',
		name: 'data[Keyword]['+i+'][concept_map_id]'
	}).appendTo('#Keyword0ConceptMapId');
	$('#dif').show();
	// Entspricht 15 Eingabefeldern
	if(i === 14){
		$('#addKeywordBut').hide();
	}
	$('#inputFields div').removeClass('has-error');
	$('#inputFields div div span').hide();
	$('.alert-danger').hide();
	while(i > 0){
		var ipf = '#inputFields'+i;
		$(ipf+' div').removeClass('has-error');
		$(ipf+' div div span').hide();
		i = i-1;
	}
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
	else if(i < 15){
		$('#addKeywordBut').show();
	}
}