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

function twitterDoEditValue(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'resultDiv'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('resultDiv').innerHTML = '<span class="inProgress">... Actualizando Estado de Entrada ...</span>';
}

function twitterDoEditMultiple(form, result){
	buildMultipleItemsForm(form);
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: result},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$(result).innerHTML = '<span class="inProgress">... Actualizando Estado de Entradas ...</span>';
}

function submitEntriesChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Entrada ...</span>';
	
}

function submitCommentsChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Comentario...</span>';
	
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

function submitMultipleEntriesChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	submitForm(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Entradas...</span>';
	
	return true;
	
}

//queda
function selectAllCheckboxes(name = null) {
	
	if(name == null)
		var checkboxes = document.getElementsByName('selected[]');
	else
		var checkboxes = document.getElementsByName(name);
	var allbox = document.getElementById('allBoxes');
	for (i=0;i<checkboxes.length;i++) {
		checkboxes[i].checked = allbox.checked;
	}
	
}

function submitEntryCreation(form) {
	$('doEdit').setAttribute('value','blogDoEdit');
	mode = document.createElement('input');
	form.setAttribute('target','');
	form.submit();
}

function refreshCaptchaX(id) {
	var divId = 'captcha' + id;

	var url = 'Main.php?do=commonCaptchaRefresh';
		
	var myAjax = new Ajax.Updater(
				{success: divId},
				url,
				{
					method: 'post',
					postBody: '&id='+id,
					evalScripts: true
				}
			);
	
	$(id).innerHTML = '<span class="inProgress>...regenerando captcha...</span>';
	$(divId).innerHTML = "";
	return false;
}

