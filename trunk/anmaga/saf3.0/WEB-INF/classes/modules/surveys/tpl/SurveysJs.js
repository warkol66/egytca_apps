var selected=-1;

function submitAnswerToQuestionX(form) {	
	var fields = Form.serialize(form);
	console.log(fields);
	var myAjax = new Ajax.Updater(
				{success: 'msgBoxAnswerAdd'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('msgBoxAnswerAdd').innerHTML = '<span class="inProgress">Agregando opción de respuesta...</span>';
	
}

function deleteAnswerOptionX(form) {	
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgBoxAnswerAdd'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('msgBoxAnswerAdd').innerHTML = '<span class="inProgress">Eliminando opción de respuesta...</span>';
	
}

function submitSurveyX(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgBoxSurveyForm'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('msgBoxSurveyForm').innerHTML = '<span class="inProgress">enviando encuesta...</span>';


	return true;
}

function submitSurveyWithoutAnswerX(form) {
	
	var fields = Form.serialize(form);
	
	noresponse = document.createElement('input');
	noresponse.name = 'noResponse';
	noresponse.value = '1';
	noresponse.type = 'hidden';
	
	form.appendChild(noresponse);
	
	var myAjax = new Ajax.Updater(
				{success: 'msgBoxSurveyForm'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('msgBoxSurveyForm').innerHTML = '<span class="inProgress">procesando...</span>';


	return true;
	
}

function validateOneAnswer() {

	var elements = document.getElementsByTagName('input');
	var checked = 0;
	for (var i=0; i < elements.length; i++) {
		if (elements[i].type == 'radio' && elements[i].name == 'answers[]' && elements[i].checked == true)
			checked++;
	};
	
	if (checked > 0) {
		return true;
	}
	return false;
}

function validateAnswer() {

	var elements = document.getElementsByTagName('input');
	var checked = 0;
	for (var i=0; i < elements.length; i++) {
		if (elements[i].type == 'checkbox' && elements[i].name == 'answers[]' && elements[i].checked == true)
			checked++;
	};
	
	if (checked == 0) {
		return false;
	}
	return true;
}

function submitAllAnswersSurveyX(form) {
	var fieldsets = $$('fieldset');
	var ok = true;
	fieldsets.each( function(fieldset) {
		if (!validateAnswersByFieldset(fieldset)) {
			$$('fieldset#'+fieldsetId+' span.msgBoxSurveyValidationMsg')[0].innerHTML = '<span class="resultFailure">Debe seleccionar al menos una respuesta.</span>';
			ok = false;
		} else {
			clearValidationFailure(fieldset);
		}
	} );
	if (ok)
		submitSurveyX(form);
	else
		return false;
}

function clearValidationFailure(fieldset) {
	$$('fieldset#'+fieldsetId+' span.msgBoxSurveyValidationMsg')[0].innerHTML = '';
}

function validateAnswersByFieldset(fieldset) {
		fieldsetId = fieldset.id;
		var elements = $$('fieldset#'+fieldsetId + ' input');
		var checked = 0;
		for (var i=0; i < elements.length; i++) {
			if (elements[i].type == 'checkbox' || elements[i].type == 'radio' && elements[i].checked == true)
				checked++;
		};
		
		if (checked == 0) {
			return false;
		}
		return true;
}

function submitOneAnswerSurveyX(form) {

	if (!validateOneAnswer()) {
		$('msgBoxSurveyForm').innerHTML = '<span class="resultFailure">Debe seleccionar una opción</span>'
		return false;
	}
	submitSurveyX(form);
}

function submitMultipleAnswerSurveyX(form) {

	if(!validateAnswer()) {
		$('msgBoxSurveyForm').innerHTML = '<span class="resultFailure">Debe seleccionar al menos una respuesta.</span>'
		return false;		
	}
	
	submitSurveyX(form);
}

/**
 * Carga los resultados de la encuesta en un determinado div
 */
function loadSurveyResultsX(surveyId,targetDivId) {
	var url = 'Main.php?do=surveysResults&id='+surveyId+'&ajax=1';
	var myAjax = new Ajax.Updater(
				{success: targetDivId},
				url,
				{
					method: 'get',
					evalScripts: true
				}
			);		

	return true;
}

function deleteQuestionX(form) {
	var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
			{success: 'msgBoxQuestionAdd'},
			'Main.php',
			{
				method: 'post',
				postBody: fields,
				evalScripts: true,
				onComplete: updateLightBox //inicializamos el lighbox nuevamente
			}
		);
		return true;	
	
	$('msgBoxSurveyForm').innerHTML = '<span class="inProgress">enviando encuesta...</span>';

	return true;
}

function editQuestionX(form) {
	id = form.serialize(true).id;
	if (selected != id) { 
		//Cargamos los datos en el lightbox.
		document.getElementById('lightboxContent').innerHTML = "<p>Cargando mensaje&nbsp;&nbsp;&nbsp;<img src='images/spinner.gif' /></p>";
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
			{success: 'lightboxContent'},
			'Main.php',
			{
				method: 'get',
				parameters: fields,
				evalScripts: true,
				onComplete: updateLightBox //inicializamos el lighbox nuevamente
			}
		);
		selected = id;
	}
	
	return true;
}

function doEditQuestionX(form) {
	//Cargamos los datos en el lightbox.
	document.getElementById('lightboxContent').insert({top:"<p>Cargando mensaje&nbsp;&nbsp;&nbsp;<img src='images/spinner.gif' /></p>"});
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
		{success: 'lightboxContent'},
		'Main.php',
		{
			method: 'post',
			postBody: fields,
			evalScripts: true,
			onComplete: updateLightBox //inicializamos el lighbox nuevamente
		}
	);
	
	return true;
}

function updateLightBox() {
	lbox = document.getElementsByClassName('lbOn');
	for(i = 0; i < lbox.length; i++) {
		valid = new lightbox(lbox[i]);
		lbActions = document.getElementsByClassName('lbAction');
		for(j = 0; j < lbActions.length; j++) {
			Event.observe(lbActions[j], 'click', valid[lbActions[j].rel].bindAsEventListener(valid), false);
			lbActions[j].onclick = function(){return false;};
		}
	}
}

