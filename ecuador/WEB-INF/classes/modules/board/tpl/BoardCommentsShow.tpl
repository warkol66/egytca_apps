<script type="text/javascript" charset="utf-8">
	//$('#mgsBoxCommentsShow|-$boardChallenge->getId()-|').html('');
</script>
	<div id="comentarios">
	<!-- TITULO COMENTARIOS -->
		<div id="titleComments"><div id="icoComments"></div>Comentarios</div>
	|-if $comments|@count eq 0-|
		|-if !$finished-|
		<p id="no_comments_|-$boardChallenge->getId()-|">No hay comentarios actualmente, sea el primero en dejar uno.</p>
		|-else-|
		<p id="no_comments_|-$boardChallenge->getId()-|">No hay comentarios asociados al desafío.</p>
		|-/if-|
	|-/if-|
		<div id="div_comments_container_|-$boardChallenge->getId()-|" >
		|-foreach from=$comments item=comment name=for_comments-|
				|-assign var=id value=$comment->getId()-|
				|-assign var=children value=BoardComment::selectChildren($id)-|
				<div id="comment|-$comment->getId()-|" class="commentContainer">				
				<!-- begin INDIVIDUAL-->		 
					<div class="individual">
					<div class="image"><img src="images/individual.png" alt="" />
					<p class="nombre">|-$comment->getUsername()-|</p>
					</div>
					<div class="comment">
					<p><span class="fecha"> |-$comment->getCreationDate()|date_format:"%A %e de %B de %Y"|ucfirst-|</span><br />
|-$comment->getText()|escape|nl2br-|</p>
					</div>
					<div class="close"></div>
					</div><!-- end INDIVIDUAL-->
				</div>
				|-*include file="BoardChildrenCommentsInclude.tpl" id=$comment->getId() comments=$children*-|
				|-*include file="BoardChildrenCommentsFormInclude.tpl" comment=$comment*-|
		|-/foreach-|
		</div>
</div>
