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
function submitChallengesChangeFormX(formId) {
	
	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Consigna ...</span>');
	
}

//migrada
function submitCommentsChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentario...</span>');
	
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
function submitMultipleChallengesChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Consignas...</span>');
	
	return true;
	
}

//migrada
function submitMultipleCommentsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentarios...</span>');
	
}

//migrada
function selectAllCheckboxes() {
	
	var checkboxes = $('[name="selected[]"]');
	var allbox = $('#allBoxes').is(':checked');
	checkboxes.attr('checked',allbox);
}

//migrada
function submitPreview(form) {
	$(form).attr('target','_blank').submit();
	$('#doEdit').remove();
	$('#mode').remove();
}

//migrada
function submitPreviewOnHome(form) {
	
	//$('#doEdit').attr('value','boardPreview');
	prev = $('<input>').attr('type','hidden').attr('name','do').attr('id','doEdit').attr('value','boardPreview');
	var mode = $('<input>').attr('type','hidden').attr('name','mode').attr('id','mode').attr('value','home');
	$(form).append(prev);
	$(form).append(mode);
	submitPreview(form);
}

//migrada
function submitPreviewDetailed(form) {
	//$('#doEdit').attr('value','boardPreview');
	prev = $('<input>').attr('type','hidden').attr('name','do').attr('id','doEdit').attr('value','boardPreview');
	mode = $('<input>').attr('type','hidden').attr('name','mode').attr('id','mode').attr('value','detailed');
	$(form).append(prev);
	$(form).append(mode);
	submitPreview(form);
}

//migrada
function submitChallengeCreation(form) {
	
	$('#doEdit').attr('value','boardDoEdit');
	$('<input>');
	$(form).attr('target','').submit();
}

//migrada?
function sendBlogChallengeByEmailX(id,form) {
	
	$.ajax({
		url: url,
		data: $(form).serialize(),
		type: 'post',
		success: function(data){
			$('#sendChallengeMsgBox' + id).html(data);
		}	
	});
	$('#sendChallengeMsgBox'+id).html('<span class="inProgress>... enviando entrada a destinatario ...</span>');
}

function showSendEmailFormX(entryId,divId) {
	if ($(divId))
		$(divId).show();

		var fields = "&id="+entryId+"&do=boardSendForm";
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

//migrada?
function hideSendEmailForm(id) {
	//if ($(id))
		$('#' + id).hide();
		
	$(id).html('');
}

//migrada
function refreshCaptchaX(id) {
	
	var divId = '#captcha' + id;
	var time = new Date().getTime();
	$(divId).html('');
	$(divId).html("<img src='Main.php?do=commonCaptchaGeneration&t=" + time + "'/>");
	return false;
}

//migrada
function boardCommentsShow(form,id) {
	
	var divId = '#comments_holder_' + id;
	$(divId).show();

}

//migrada
function boardCommentsHide(divId) {
	
	$('#' + divId).hide();
	
}

//migrada?
function showCommentAddForm(idDiv) {
	
	/*var toShow = $(idDiv);
	if (toShow != null)*/
	 	$('#' + idDiv).show();
	
}

function hideCommentAddForm(id) {
	
	var toHide = $( "div_comments_adder_" + id);
	if (toHide != null)
	 	toHide.hide();
	
	$("formCommentAdder" + id).reset();
	
}

//migrada
function boardCommmentAdd(form,id) {
	
	$.ajax({
		url: url,
		data: $(form).serialize(),
		type: 'post',
		success: function(data){
			$('#mgsBoxCommentsShow' + id).html(data);
		}	
	});
	$('msgBoxAdder'+id).html('<span class="inProgress">... agregando comentario ...</span>');
	
}
