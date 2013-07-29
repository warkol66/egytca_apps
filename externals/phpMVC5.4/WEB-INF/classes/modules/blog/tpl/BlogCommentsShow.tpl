<script type="text/javascript" charset="utf-8">
	//$('#mgsBoxCommentsShow|-$entry->getId()-|').html('');
</script>
	<div id="comentarios">
	<!-- TITULO COMENTARIOS -->
		<div id="titleComments"><div id="icoComments"></div>Comentarios</div>
	|-if ($comments|@count eq 0)-|
		<p id="no_comments_|-$entry->getId()-|">No hay comentarios actualmente, sea el primero en dejar uno.</p>
	|-/if-|
		<div id="div_comments_container_|-$entry->getId()-|" >
		|-foreach from=$comments item=comment name=for_comments-|
				<div id="comment|-$comment->getId()-|" class="commentContainer">				
				<!-- begin INDIVIDUAL-->		 
					<div class="individual">
					<div class="image"><img src="images/individual.png" alt="" width="55" height="55" />
					<p class="nombre">|-$comment->getUsername()-|</p>
					</div>
					<div class="comment">
					<p><span class="fecha"> |-$comment->getCreationDate()|date_format:"%A %e de %B de %Y"-|</span><br />
|-$comment->getText()|escape|nl2br-|</p>
					</div>
					<div class="close"></div>
					</div><!-- end INDIVIDUAL-->
				</div>
		|-/foreach-|
		</div>
</div>
