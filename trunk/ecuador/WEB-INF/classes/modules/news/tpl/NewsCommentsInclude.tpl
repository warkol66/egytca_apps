<script src="Main.php?do=js&name=commentsJs&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$('#codeRefresher').click(function(event){
			refreshCodeX('msgBoxAdder|-$article->getId()-|');
		});
	});
</script>
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

<!-- TITULO FORMULARIO / DEJAR COMENTARIOS -->
 <div id="titleComments"><div id="icoWriteComments"></div>Deja tu comentario</div>	
	<div id="msgError"></div>
	<div id="formComments">
	<form action="Main.php" method="post" id="formCommentAdder|-$entry->getId()-|">
<fieldset title="Formulario para agregar comentarios">
	<p>
	<label for="blogComment_username">Nombre</label>
			<input type="text" id="params_username" name="params[username]" title="username" size="40"/>
		</p>
		<p>
			<label for="params_email">Email</label><input type="text" id="params_email" name="params[email]" size="40" />
		</p>
		<p>
			<label for="params_text">Comentario</label><textarea id="params_text" name="params[text]" cols="65" rows="5" wrap="VIRTUAL" ></textarea>
		</p>
		<p><label>Código de seguridad</label><div id="codemsgBoxAdder|-$entry->getId()-|">
			<img src="Main.php?do=commonImage&width=120&height=45&characters=5" />
			</div>
		</p>
		<p>
			<label for="formId">Ingrese el código de seguridad</label><input id="formId" name="formId" type="text" size="10" />
		</p>
		<div id="cpatcha" style="display:none">		<p>
			<label for="security_code">No completar</label><input id="security_code" name="securityCode" type="text" size="10" />
		</p></div>
		<p>	
			<input type="hidden" name="params[articleId]" value="|-$article->getId()-|" id="params_entryId" />
			<input type="hidden" name="do" value="newsCommentsDoAddX" id="do">
			<input type="button" value="Agregar Comentario" onClick="javascript:newsCommmentAdd(this.form,|-$article->getId()-|)" /> 
			<input type="button" name="commentAdderHideButton|-$entry->getId()-|" value="Cancelar" id="commentAdderHideButton|-$article->getId()-|" onClick="javascript:hideCommentAddForm(|-$article->getId()-|)" />
			<input type="button" name="codeRefresher" id="codeRefresher" value="Regenerar código de seguridad"> <span id="msgBoxAdder|-$article->getId()-|"></span>
		</p>
		</fieldset>
	</form>
	</div>
</div>
</div>
