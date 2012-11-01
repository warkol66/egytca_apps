|-if $comment->isApproved()-|
<script type="text/javascript">
	var noComments = $('no_comments_|-$entry->getId()-|');
	if (noComments != null)
		noComments.remove();
	$('msgBoxAdder'+|-$entry->getId()-|).innerHTML = '<span class="resultSuccess">El comentario ha sido agregado con exito</span>';
	$('formCommentAdder|-$entry->getId()-|').reset();
	
	container = new Element('div');
	container.className = "commentContainer";
	container.id = "comment|-$comment->getId()-|";
	individual = new Element('div');
	individual.className = "individual";
	individual.innerHTML = "<div class='image'><img src='images/individual.png' width='55' height='55' /><p class='nombre'>|-$comment->getUsername()-|</p></div>";
	comment = new Element('div');
	comment.className = "comment";	
	comment.innerHTML = '<p><span class="fecha">|-$comment->getCreationDate()|date_format:"%A %e de %B de %Y"-|</span><br />|-$comment->getText()|escape|nl2br-|</p><div class="close"></div>';
	closeDiv = new Element('div');
	closeDiv.className = "close";	
	individual.appendChild(comment);
	individual.appendChild(closeDiv);
	container.appendChild(individual);
	
	$('div_comments_container_|-$entry->getId()-|').appendChild(container);
	$('formCommentAdder|-$entry->getId()-|').reset();
	
</script>
|-/if-|

|-if $comment->isPending()-|
<script type="text/javascript">
		$('msgBoxAdder'+|-$entry->getId()-|).innerHTML = '<span class="resultSuccess">El comentario ha sido agregado. La publicación del mismo está sujeta a la aprobación por parte del administrador.</span>';
		$('formCommentAdder|-$entry->getId()-|').reset();
</script>
|-/if-|