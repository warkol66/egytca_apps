<script language="Javascript" src="scripts/news-comments.js" type="text/javascript"></script>
<form action="Main.php" method="post">
	<input type="hidden" name="do" value="newsCommentsShow" id="do">
	<input type="hidden" name="articleId" value="|-$article->getId()-|" id="articleId">
	|-if $article->getApprovedCommentsCount() gt 0-|
	Cantidad de Comentarios |-$article->getApprovedCommentsCount()-|
	<input type="button" name="commentsShow" value="Mostrar Comentarios" id="commentsShow" onClick="javascript:newsCommentsShow(this.form,|-$article->getId()-|);"/>
	<input type="button" name="commentsHide" value="Ocultar Comentarios" id="commentsHide" onClick="javascript:newsCommentsHide('comments_holder_|-$article->getId()-|')"/> 
	|-/if-|
	<span id="mgsBoxCommentsShow|-$article->getId()-|"></span>
</form>

<div id="comments_holder_|-$article->getId()-|">
	|-if $comments neq ''-|
		|-include file="NewsCommentsShow.tpl" comments=$comments article=$article-|
	|-/if-|
</div>