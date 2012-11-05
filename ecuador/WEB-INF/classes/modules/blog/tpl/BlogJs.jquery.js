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

function submitMultipleCommentsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	submitForm(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Comentarios...</span>';
	
	
}

function selectAllCheckboxes() {
	
	var checkboxes = document.getElementsByName('selected[]');
	var allbox = document.getElementById('allBoxes');
	for (i=0;i<checkboxes.length;i++) {
		checkboxes[i].checked = allbox.checked;
	}
	
}

function submitPreview(form) {
	form.setAttribute('target','_blank');
	form.submit();
}

function submitPreviewOnHome(form) {
	$('doEdit').setAttribute('value','blogPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','home');
	form.appendChild(mode);
	submitPreview(form);
}

function submitPreviewDetailed(form) {
	$('doEdit').setAttribute('value','blogPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','detailed');
	form.appendChild(mode);
	submitPreview(form);
}

function submitEntryCreation(form) {
	$('doEdit').setAttribute('value','blogDoEdit');
	mode = document.createElement('input');
	form.setAttribute('target','');
	form.submit();
}

function sendBlogEntryByEmailX(id,form) {
		
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'sendEntryMsgBox'+id},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('sendEntryMsgBox'+id).innerHTML = '<span class="inProgress>... enviando entrada a destinatario ...</span>';
	
}

function showSendEmailFormX(entryId,divId) {
	if ($(divId))
		$(divId).show();

		var fields = "&id="+entryId+"&do=blogSendForm";
		var myAjax = new Ajax.Updater(
					{success: divId},
					url,
					{
						method: 'post',
						postBody: fields,
						evalScripts: true
					}
				);
				
	var toHide = $$('div.sendToEmailFormClass');
	for (var i=0; i < toHide.length; i++) {
		if (toHide[i].id != divId)
			toHide[i].innerHTML = '';
	};
	
}

function hideSendEmailForm(id) {
	if ($(id))
		$(id).hide();
		
	$(id).innerHTML = '';
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

function blogCommentsShow(form,id) {
	
	var divId = 'comments_holder_' + id;
	$(divId).innerHTML = '';
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: divId},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);
			
	$('mgsBoxCommentsShow'+id).innerHTML = '<span class="inProgress">... buscando comentarios ...</span>';
	
}

function blogCommentsHide(divId) {
	
	$(divId).innerHTML = '';
	
}

function showCommentAddForm(idDiv) {
	
	var toShow = $(idDiv);
	if (toShow != null)
	 	toShow.show();
	
}

function hideCommentAddForm(id) {
	
	var toHide = $( "div_comments_adder_" + id);
	if (toHide != null)
	 	toHide.hide();
	
	$("formCommentAdder" + id).reset();
	
}

function blogCommmentAdd(form,id) {
	
	var fields = Form.serialize(form);
	var divId = 'mgsBoxCommentsShow'+id;
	var myAjax = new Ajax.Updater(
				{success: divId},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.top
				}
			);
	$('msgBoxAdder'+id).innerHTML = '<span class="inProgress">... agregando comentario ...</span>';
}


function addTagToEntry(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'tagList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('tagMsgField').innerHTML = '<span class="inProgress">agregando etiqueta a entrada</span>';
	return true;
}

function deleteTagFromEntry(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'tagMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('tagMsgField').innerHTML = '<span class="inProgress">eliminando etiqueta de entrada</span>';
	return true;
}
