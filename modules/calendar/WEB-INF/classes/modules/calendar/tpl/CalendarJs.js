function submitFormX(formId) {
	$.ajax({
		url: url,
		data: $('#' + formId).serialize(),
		type: 'post',
		success: function(data){
			$('#divMsgBox').html(data);
		}	
	});
}

function submitEntriesChangeFormX(formId) {
	
	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado del Evento ...</span>');
	
}

/*function submitForm(formId) {
	var form = $(formId);
	if (form != null)
		form.submit();
}*/

function buildMultipleItemsForm(formId) {
	
	var form = $('#' + formId);
	//elimino elementos que puedan existir en el form anteriormente
	$('#' + formId + " input[name='selected[]']").remove();
	
	//armo el formulario con los elementos seleccionados
	$('input[name="selected[]"]').each(function(){
		if($(this).attr('checked')){
			var hidden = $('<input>').attr('type','hidden').attr('name',$(this).attr('name')).attr('value',$(this).attr('value'));
			$('#' + formId).append(hidden);
			console.log(hidden);
		}
	});
	
	return true;
	
}

function submitMultipleEventsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Entradas...</span>');
	
	return true;
	
}

function selectAllCheckboxes() {
	
	var checkboxes = $('[name="selected[]"]');
	var allbox = $('#allBoxes').is(':checked');
	checkboxes.attr('checked',allbox);
}

function submitCalendarEventsMediaDeleteX(id,form) {
	
	var result = confirm('Seguro que desea eliminar la imagen?');
	if (result == false)
		return false;
		
	$.ajax({
		url: url,
		data: $('#' + form).serialize(),
		type: 'post',
		success: function(data){
			$('#msgBoxUploader').html(data);
		}	
	});
	$('#calendarMediaItemMsgBox'+id).innerHTML = 'eliminando media...';
	
}

function submitPreview(form) {
	$(form).attr('target','_blank').submit();
}

function submitEventsPreviewOnHome(form) {
	
	$('#doEdit').attr('value','calendarPreview');
	var mode = $('<input>').attr('type','hidden').attr('name','mode').attr('value','home');
	$(form).append(mode);
	submitPreview(form);
}

//migrar
function submitEventsPreviewDetailed(form) {
	$('doEdit').setAttribute('value','calendarPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','detailed');
	form.appendChild(mode);
	submitPreview(form);
}

function submitEventCreation(form) {
	
	$('#doEdit').attr('value','calendarDoEdit');
	$('<input>');
	$(form).attr('target','').submit();
}

function calendarMediaAdd(form) {
	
	$.ajax({
		url: url,
		data: $('#' + form).serialize(),
		type: 'post',
		success: function(data){
			$('#mediasAdderMsgBox').html(data);
		}	
	});
	$('mediasAdderMsgBox').innerHTML = '<span class="inProgress"> ... subiendo archivo... </span>';
}
