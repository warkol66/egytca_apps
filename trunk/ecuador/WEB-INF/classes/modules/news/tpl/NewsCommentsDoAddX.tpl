|-if $comment->isApproved()-|
<script type="text/javascript">
	var noComments = $('no_comments_|-$article->getId()-|');
	if (noComments != null)
		noComments.remove();
	$('msgBoxAdder'+|-$article->getId()-|).innerHTML = '<span class="resultSuccess">El comentario ha sido agregado con exito</span>';
	$('formCommentAdder|-$article->getId()-|').reset();
	
	container = new Element('p');
	user = new Element('p');
	user.innerHTML = 'Usuario: |-$comment->getUsername()-|';
	site = new Element('p');
	site.innerHTML = 'Sitio: <a href="|-$comment->getUrl()-|" >|-$comment->getUrl()-|</a>';
	commentLabel = new Element('p');
	commentLabel.innerHTML = 'Comentario:';
	text = new Element('p');
	text.innerHTML = '|-$comment->getText()-|';
	
	container.appendChild(user);
	container.appendChild(site);
	container.appendChild(commentLabel);
	container.appendChild(text);
	
	$('div_comments_container_|-$article->getId()-|').appendChild(container);
	$('formCommentAdder|-$article->getId()-|').reset();
	
</script>
|-/if-|

|-if $comment->isPending()-|
<script type="text/javascript">
		$('msgBoxAdder'+|-$article->getId()-|).innerHTML = '<span class="resultSuccess">El comentario ha sido agregado. La publicación del mismo está sujeta a la aprobación por parte del administrador.</span>';
		$('formCommentAdder|-$article->getId()-|').reset();
</script>
|-/if-|