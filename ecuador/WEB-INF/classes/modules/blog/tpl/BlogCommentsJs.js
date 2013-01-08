//migrada
function blogCommentsShow(form,id) {
	
	var divId = '#comments_holder_' + id;
	$(divId).slideToggle('slow',function(){
		$('#commentsShow').hide();
		$('#commentsHide').show();
	});
	
}

//migrada
function blogCommentsHide(divId) {
	
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
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Comentario...</span>');
	
}

//migrada
function submitEntriesChangeFormX(formId) {
	
	submitFormX(formId);
	$('#divMsgBox').html('<span class="inProgress">... Actualizando Estado de Entrada ...</span>');
	
}

//migrada
function refreshCodeX(id) {
	
	var divId = '#code' + id;
	var time = new Date().getTime();
	$(divId).html("<img src='Main.php?do=commonImage&width=120&height=45&characters=5&t=" + time + "'/>");
	return false;
}
