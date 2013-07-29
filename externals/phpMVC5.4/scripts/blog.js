//migrada?
function blogCommentsShow(form,id) {
	
	var divId = '#comments_holder_' + id;
	$(divId).html('');
	
	$.ajax({
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
	
	$('#' + divId).html('');
	
}

//migrada?
function showCommentAddForm(idDiv) {
	
	/*var toShow = $(idDiv);
	if (toShow != null)*/
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
	
	/*var fields = Form.serialize(form);
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
	$('msgBoxAdder'+id).innerHTML = '<span class="inProgress">... agregando comentario ...</span>';*/
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

function refreshCaptchaX(id) {
	
	divId = '#captcha' + id;
	
	$.ajax({
		url: 'Main.php?do=commonCaptchaGeneration',
		type: 'post',
		success: function(data){
			$('#divId').html(data);
		}	
	});
	
	$('#' + id).html('<span class="inProgress>...regenerando captcha...</span>');
	$(divId).html("");
	/*
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
	$(divId).innerHTML = "";*/
	return false;
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

function selectAllCheckboxes() {
	
	var checkboxes = $('[name="selected[]"]');
	var allbox = $('#allBoxes').is(':checked');
	checkboxes.attr('checked',allbox);
}
