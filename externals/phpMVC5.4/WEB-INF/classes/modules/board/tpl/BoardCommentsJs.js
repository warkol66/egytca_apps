//migrada
function boardCommentsShow(form,id) {
	
	var divId = '#comments_holder_' + id;
	$(divId).slideToggle('slow',function(){
		$('#commentsShow').hide();
		$('#commentsHide').show();
	});
	
}

//migrada
function boardCommentsHide(divId) {
	
	$('#' + divId).slideToggle('slow',function(){
		$('#commentsHide').hide();
		$('#commentsShow').show();
	});
	
}

//migrada?
function showCommentAddForm(idDiv) {
	
	$('#' + idDiv).show();
	
}

//migrada
function hideCommentAddForm(id) {
	
	//$("#div_comments_adder_" + id).hide();
	$("#formCommentAdder" + id)[0].reset();
	
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
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentario...</span>');
	
}

function submitMultipleCommentsChangeFormX(formId) {

	buildMultipleItemsForm(formId);
	$('#' + formId).submit();
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentarios...</span>');
	
}

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
function submitChallengesChangeFormX(formId) {
	
	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de la Consigna ...</span>');
	
}

//migrada
function refreshCodeX(id) {
	
	var divId = '#code' + id;
	var time = new Date().getTime();
	$(divId).html("<img src='Main.php?do=commonImage&width=120&height=45&characters=5&t=" + time + "'/>");
	return false;
}
