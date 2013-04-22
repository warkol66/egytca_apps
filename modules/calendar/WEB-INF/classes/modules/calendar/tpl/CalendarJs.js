function submitFormX(formId) {

	var form = $(formId);
	var fields = Form.serialize(form);

	var myAjax = new Ajax.Updater(
				{success: 'divMsgBox'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});


}

function submitEventsChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Evento ...</span>';
	
}

function submitForm(formId) {
	var form = $(formId);
	if (form != null)
		form.submit();
}

function buildMultipleItemsForm(formId) {
	
	var form = $(formId);
	
	//elimino elementos que puedan existir en el form anteriormente
	toDelete = form.childElements();
	
	var i;
	for (i=0;i<toDelete.length; i++) {
		if (toDelete[i].name == 'selected[]')
			toDelete[i].remove();
	}
	
	//armo el formulario con los elementos seleccionados
	var checkboxes = document.getElementsByName('selected[]');
	
	for (i=0;i<checkboxes.length; i++) {
		
		if (checkboxes[i].checked == true) {
			
			var hidden = document.createElement('input');
			hidden.setAttribute('type','hidden');
			hidden.setAttribute('name',checkboxes[i].name);
			hidden.setAttribute('value',checkboxes[i].value);
			form.appendChild(hidden);
		}
	
	}
	
	return true;
	
}

function submitMultipleEventsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	submitForm(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Eventos...</span>';
	
	return true;
	
}

function selectAllCheckboxes() {
	
	var checkboxes = document.getElementsByName('selected[]');
	for (i=0;i<checkboxes.length;i++) {
		checkboxes[i].checked = true;
	}
	
}

function submitCalendarEventsMediaDeleteX(id,form) {
	
	var result = confirm('Seguro que desea eliminar la imagen?');
	if (result == false)
		return false;
		
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgBoxUploader'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('calendarMediaItemMsgBox'+id).innerHTML = 'eliminando media...';
	
}

function submitPreview(form) {
	form.setAttribute('target','_blank');
	form.submit();
}

function submitEventsPreviewOnHome(form) {
	$('doEdit').setAttribute('value','calendarEventsPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','home');
	form.appendChild(mode);
	submitPreview(form);
}

function submitEventsPreviewDetailed(form) {
	$('doEdit').setAttribute('value','calendarEventsPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','detailed');
	form.appendChild(mode);
	submitPreview(form);
}

function submitEventCreation(form) {
	$('doEdit').setAttribute('value','calendarEventsDoEdit');
	mode = document.createElement('input');
	form.setAttribute('target','');
	form.submit();
}

function calendarMediaAdd(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'mediasAdderMsgBox'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);
	$('mediasAdderMsgBox').innerHTML = '<span class="inProgress"> ... subiendo archivo... </span>';
}
