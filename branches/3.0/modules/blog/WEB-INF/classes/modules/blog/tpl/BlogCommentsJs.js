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