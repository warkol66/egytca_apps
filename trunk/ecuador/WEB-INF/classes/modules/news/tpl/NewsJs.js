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
function submitNewsChangeFormX(formId) {

	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Noticia ...</span>');

}
//migrada
function submitCommentsChangeFormX(formId) {

	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentario...</span>');

}
//migrada
function submitForm(formId) {
	var form = $('#' + formId);
	if (form != null)
		form.submit();
}
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
function submitMultipleArticlesChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	submitForm(formId);
	$('divMsgBox').html('<span class="inProgress">... Actualizando Estado de Articulos...</span>');

	return true;

}
//migrada
function submitMultipleCommentsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentarios...</span>');
	
}
//migrada
function selectAllCheckboxes() {

	var checkboxes = $('[name="selected[]"]');
	var allbox = $('#allBoxes').is(':checked');
	checkboxes.attr('checked',allbox);
	
}
//migrada - probar
function submitNewsArticleMediaDeleteX(id,form) {
	
	var result = confirm('Seguro que desea eliminar el newsmedia?');
	if (result == false)
		return false;
	
	$.ajax({
		url: url,
		data: $(form).serialize(),
		type: 'post',
		success: function(data){
			$('#msgBoxUploader').html(data);
		}
	});
	$('#newsMediaItemMsgBox'+id).html('<span class="inProgress>... eliminando media ...</span>');
	
}
function submitAddMedia(form) {
	$('#msgBoxUploader').html('<span class="inProgress>... creando media ...</span>');
	$.ajax({
		url: url,
		data: { data: $(form).serialize()},
		type: 'post',
		success: function(data){
			$('#msgBoxUploader').html(data);
		}
	});
}

//migrada - probar
function submitnewsMediasVideoDoReplaceThumbnailX(id,form) {
	
	var result = confirm('Seguro que desea regenerar el thumbnail?');
	if (result == false)
		return false;
		
	$.ajax({
		url: url,
		data: $(form).serialize(),
		type: 'post',
		success: function(data){
			$('#msgBoxUploader').html(data);
		}
	});
	$('newsMediaItemMsgBox'+id).html('<span class="inProgress>... generando thumbnail ...</span>');
	
}
//migrada
function submitPreview(form) {
	$(form).attr('target','_blank').submit();
}
//migrada
function submitPreviewOnHome(form) {
	$('#doEdit').attr('value','newsArticlesPreview');
	var mode = $('<input>').attr('type','hidden').attr('name','mode').attr('value','home');
	$(form).append(mode);
	submitPreview(form);

}
//migrada
function submitPreviewDetailed(form) {
	$('#doEdit').attr('value','newsArticlesPreview');
	mode = $('<input>').attr('type','hidden').attr('name','mode').attr('value','detailed');
	$(form).append(mode);
	submitPreview(form);

}
//migrada
function submitArticleCreation(form) {

	$('#doEdit').attr('value','newsArticlesDoEdit');
	$('<input>');
	$(form).attr('target','').submit();

}
//migrada
function sendNewsArticleByEmailX(id,form) {

	$.ajax({
		url: url,
		data: $(form).serialize(),
		type: 'post',
		success: function(data){
			$('#sendArticleMsgBox' + id).html(data);
		}	
	});
	$('#sendArticleMsgBox'+id).html('<span class="inProgress>... enviando noticia a destinatario ...</span>');
	
}
//terminar
function showSendEmailFormX(idArticle,idDiv) {

	$('#' + idDiv).show();

	var fields = "&id="+idArticle+"&do=newsArticlesSendForm";
	
	/*$.ajax({
		url: url,
		data: fields,
		type: 'post',
		success: function(data){
			$('#' + idDiv).html(data);
		}	
	});*/
			
	/*var toHide = $$('div.sendToEmailFormClass');
	for (var i=0; i < toHide.length; i++) {
		if (toHide[i].id != idDiv)
			toHide[i].innerHTML = '';
	};*/
	
}
//migrada
function hideSendEmailForm(id) {
	$('#' + id).hide();
	$('#' + id).html('');
}
//migrada
function refreshCodeX(id) {
	
	var divId = '#code' + id;
	var time = new Date().getTime();
	$(divId).html("<img src='Main.php?do=commonImage&width=120&height=45&characters=5&t=" + time + "'/>");
	return false;
}

function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}		
