//migrada
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

//migrada
function submitEntriesChangeFormX(formId) {
	
	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Entrada ...</span>');
	
}

//migrada
function submitCommentsChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentario...</span>');
	
}
/*
function submitForm(formId) {
	var form = $(formId);
	if (form != null)
		form.submit();
}*/

//migrada
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

//migrada
function submitMultipleEntriesChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Entradas...</span>');
	
	return true;
	
}

//migrada
function submitMultipleCommentsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentarios...</span>');
	
}

function selectAllCheckboxes() {
	
	var checkboxes = document.getElementsByName('selected[]');
	var allbox = document.getElementById('allBoxes');
	for (i=0;i<checkboxes.length;i++) {
		checkboxes[i].checked = allbox.checked;
	}
	
}

//migrada
function submitPreview(form) {
	$(form).attr('target','_blank').submit();
}

//migrada
function submitPreviewOnHome(form) {
	
	$('#doEdit').attr('value','blogPreview');
	var mode = $('<input>').attr('type','hidden').attr('name','mode').attr('value','home');
	$(form).append(mode);
	submitPreview(form);
}

//migrada
function submitPreviewDetailed(form) {
	$('#doEdit').attr('value','blogPreview');
	mode = $('<input>').attr('type','hidden').attr('name','mode').attr('value','detailed');
	$(form).append(mode);
	submitPreview(form);
}

//migrada
function submitEntryCreation(form) {
	
	$('#doEdit').attr('value','blogDoEdit');
	$('<input>');
	$(form).attr('target','').submit();
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

//migrada?
function blogCommentsHide(divId) {
	
	$('#' + divId).html('');
	
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
