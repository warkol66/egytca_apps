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

function submitNewsChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Noticia ...</span>';
	
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

function submitMultipleArticlesChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	submitForm(formId);
	$('divMsgBox').innerHTML = '<span class="inProgress">... Actualizando Estado de Articulos...</span>';
	
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

function submitNewsArticleMediaDeleteX(id,form) {
	
	var result = confirm('Seguro que desea eliminar el newsmedia?');
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
	
	$('newsMediaItemMsgBox'+id).innerHTML = '<span class="inProgress>... eliminando media ...</span>';
	
}

function submitnewsMediasVideoDoReplaceThumbnailX(id,form) {
	
	var result = confirm('Seguro que desea regenerar el thumbnail?');
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
	
	$('newsMediaItemMsgBox'+id).innerHTML = '<span class="inProgress>... generando thumbnail ...</span>';
	
}

function submitPreview(form) {
	form.setAttribute('target','_blank');
	form.submit();
}

function submitPreviewOnHome(form) {
	$('doEdit').setAttribute('value','newsArticlesPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','home');
	form.appendChild(mode);
	submitPreview(form);
}

function submitPreviewDetailed(form) {
	$('doEdit').setAttribute('value','newsArticlesPreview');
	mode = document.createElement('input');
	mode.setAttribute('type','hidden');
	mode.setAttribute('name','mode');
	mode.setAttribute('value','detailed');
	form.appendChild(mode);
	submitPreview(form);
}

function submitArticleCreation(form) {
	$('doEdit').setAttribute('value','newsArticlesDoEdit');
	mode = document.createElement('input');
	form.setAttribute('target','');
	form.submit();
}

function sendNewsArticleByEmailX(id,form) {
		
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'sendArticleMsgBox'+id},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				}
			);		
	
	$('sendArticleMsgBox'+id).innerHTML = '<span class="inProgress>... enviando noticia a destinatario ...</span>';
	
}

function showSendEmailFormX(idArticle,idDiv) {
	if ($(idDiv))
		$(idDiv).show();

		var fields = "&id="+idArticle+"&do=newsArticlesSendForm";
		var myAjax = new Ajax.Updater(
					{success: idDiv},
					url,
					{
						method: 'post',
						postBody: fields,
						evalScripts: true
					}
				);
				
	var toHide = $$('div.sendToEmailFormClass');
	for (var i=0; i < toHide.length; i++) {
		if (toHide[i].id != idDiv)
			toHide[i].innerHTML = '';
	};
	
}

function hideSendEmailForm(id) {
	if ($(id))
		$(id).hide();
		
	$(id).innerHTML = '';
}


function refreshCaptchaX(id) {
	var idDiv = 'captchaArticle' + id;

	var url = 'Main.php?do=newsCaptchaRefresh';
		
	var myAjax = new Ajax.Updater(
				{success: idDiv},
				url,
				{
					method: 'post',
					postBody: '&id='+id,
					evalScripts: true
				}
			);
	
	$('sendArticleMsgBox'+id).innerHTML = 'recargando captcha...';
	$(idDiv).innerHTML = "";
	return false;
	
}