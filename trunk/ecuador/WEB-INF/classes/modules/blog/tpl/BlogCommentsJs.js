//migrada
function blogCommentsShow(form,id) {
	
	var divId = '#comments_holder_' + id;
	$(divId).show();
	
	/*$.ajax({
		url: url,
		data: $(form).serialize(),
		type: 'post',
		success: function(data){
			$(divId).html(data);
		}	
	});
	$('#mgsBoxCommentsShow'+id).html('<span class="inProgress">... buscando comentarios ...</span>');
	
	/*var divId = 'comments_holder_' + id;
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
			
	$('mgsBoxCommentsShow'+id).innerHTML = '<span class="inProgress">... buscando comentarios ...</span>';*/
	
}

//migrada
function blogCommentsHide(divId) {
	
	$('#' + divId).hide();
	
}

//migrada?
function showCommentAddForm(idDiv) {
	
	 $('#' + idDiv).show();
	
}

//migrada?
function hideCommentAddForm(id) {
	
	/*var toHide = $( "div_comments_adder_" + id);
	if (toHide != null)*/
	 	$("#div_comments_adder_" + id).hide();
	
	$("#formCommentAdder" + id).reset();
	
}

//migrada
function blogCommmentAdd(form,id) {
	
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

function submitCommentsChangeFormX(formId) {
	
	submitFormX(formId);
	$('divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentario...</span>');
	
}

//migrada
function submitEntriesChangeFormX(formId) {
	
	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Entrada ...</span>');
	
}

//migrada
function refreshCaptchaX(id) {
	
	var divId = '#captcha' + id;
	var time = new Date().getTime();
	$(divId).html('');
	$(divId).html("<img src='Main.php?do=commonCaptchaGeneration&t=" + time + "'/>");
	return false;
}
