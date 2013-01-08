|-if $captcha-|
<script type="text/javascript" charset="utf-8">
	$('#msgBoxAdder'+|-$article->getId()-|).html('<span class="resultFailure">El código de validación ingresao es incorrecto, ingreselo nuevamente</span>');
</script>
|-elseif !is_object($comment)-|
<script type="text/javascript" charset="utf-8">
	$('#msgBoxAdder'+|-$article->getId()-|).html('<span class="resultFailure">Se ha producido un error al agregar el comentario</span>');
</script>
|-else-|
|-if $comment->isApproved()-|
<script type="text/javascript">
	var noComments = $('#no_comments_'  + |-$article->getId()-|);
	if (noComments != null)
		noComments.remove();
	$('msgBoxAdder'+|-$article->getId()-|).html('<span class="resultSuccess">El comentario ha sido agregado con exito</span>');
	$('#formCommentAdder|-$article->getId()-|')[0].reset();
	
	var container = $('<p></p>');
	var user = $('<p></p>').html('Usuario: |-$comment->getUsername()-|');
	var site = $('<p></p>').html('Sitio: <a href="|-$comment->getUrl()-|" >|-$comment->getUrl()-|</a>');
	var commentLabel = $('<p></p>').html('Comentario:');
	var text = $('<p></p>').html('|-$comment->getText()-|');
	
	$(container).append(user).append(site).append(commentLabel).append(text);
	
	$('#div_comments_container_|-$article->getId()-|').append(container);
	$('#formCommentAdder|-$article->getId()-|')[0].reset();
	
</script>
|-/if-|

|-if $comment->isPending()-|
<script type="text/javascript">
		$('#msgBoxAdder'+|-$article->getId()-|).html('<span class="resultSuccess">El comentario ha sido agregado. La publicación del mismo está sujeta a la aprobación por parte del administrador.</span>');
		$('#formCommentAdder|-$article->getId()-|')[0].reset();
</script>
|-/if-|

|-/if-|
