|-if $captcha-|
<script type="text/javascript" charset="utf-8">
	$('#msgBoxAdder'+|-$entry->getId()-|).html('<span class="resultFailure">El código de validación ingresao es incorrecto, ingreselo nuevamente</span>');
</script>
|-elseif !is_object($comment)-|
<script type="text/javascript" charset="utf-8">
	$('#msgBoxAdder'+|-$entry->getId()-|).html('<span class="resultFailure">Se ha producido un error al agregar el comentario</span>');
</script>
|-else-|
|-if $comment->getStatus() eq 2-|
<script type="text/javascript">
	var noComments = $('#no_comments_' + |-$entry->getId()-|);
	if (noComments != null)
		noComments.remove();
	$('#msgBoxAdder'+|-$entry->getId()-|).html('<span class="resultSuccess">El comentario ha sido agregado con éxito</span>');
	$('#formCommentAdder|-$entry->getId()-|')[0].reset();
	
	var container = $('<div></div>').addClass("commentContainer").attr('id', "comment|-$comment->getId()-|");
	var individual = $('<div>',{
		"class": "individual",
		html: "<div class='image'><img src='images/individual.png' /><p class='nombre'>|-$comment->getUsername()-|</p></div>",
	});
	var comment = $('<div>',{
		"class": "comment",
		html: '<p><span class="fecha">|-$comment->getCreationDate()|date_format:"%A %e de %B de %Y"|ucfirst-|</span><br />|-$comment->getText()|escape|nl2br-|</p><div class="close"></div>'
	})
	var closeDiv = $('<div>',{"class": "close"});
	
	$(individual).append(comment).append(closeDiv);
	$(container).append(individual);
	
	$('#div_comments_container_|-$entry->getId()-|').append(container);
	$('#formCommentAdder|-$entry->getId()-|')[0].reset();
	
</script>
|-/if-|

|-if $comment->isPending()-|
<script type="text/javascript">
		$('#msgBoxAdder'+|-$entry->getId()-|).html('<span class="resultSuccess">El comentario ha sido agregado. La publicación del mismo está sujeta a la aprobación por parte del administrador.</span>');
		$('#formCommentAdder|-$entry->getId()-|')[0].reset();
</script>
|-/if-|
|-/if-|
