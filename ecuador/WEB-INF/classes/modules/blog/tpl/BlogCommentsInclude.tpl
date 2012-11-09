<script src="Main.php?do=js&name=commentsJs&module=blog&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$('#codeRefresher').click(function(event){
			refreshCodeX('msgBoxAdder|-$entry->getId()-|');
		});
	});
</script>
<form action="Main.php" method="post">
	<input type="hidden" name="do" value="blogCommentsShow" id="do">
	<input type="hidden" name="entryId" value="|-$entry->getId()-|" id="entryId">
	|-if $entry->getApprovedCommentsCount() gt 0-|
	Cantidad de Comentarios |-$entry->getApprovedCommentsCount()-|
	<input type="button" style="display:none;" name="commentsShow" value="Mostrar Comentarios" id="commentsShow" onClick="javascript:blogCommentsShow(this.form,|-$entry->getId()-|);"/>
	<input type="button" name="commentsHide" value="Ocultar Comentarios" id="commentsHide" onClick="javascript:blogCommentsHide('comments_holder_|-$entry->getId()-|')"/> 
	|-/if-|
	<span id="mgsBoxCommentsShow|-$entry->getId()-|"></span>
</form>

<div id="comments_holder_|-$entry->getId()-|">
		|-include file="BlogCommentsShow.tpl" comments=$comments entry=$entry-|
<!-- Formulario para agregar comentario -->
<div id="div_comments_adder_|-$entry->getId()-|">
<a name="commentsForm"></a>

<!-- TITULO FORMULARIO / DEJAR COMENTARIOS -->
 <div id="titleComments"><div id="icoWriteComments"></div>Deja tu comentario</div>		   
	<div id="formComments">
	<form action="Main.php" method="post" id="formCommentAdder|-$entry->getId()-|">
<fieldset title="Formulario para agregar comentarios">
	<p>
	<label for="blogComment_username">Nombre</label>
			<input type="text" id="blogComment_username" name="blogComment[username]" title="username" size="40"/>
		</p>
		<p>
			<label for="blogComment_email">Email</label><input type="text" id="blogComment_email" name="blogComment[email]" size="40" />
		</p>
		<p>
			<label for="blogComment_text">Comentario</label><textarea id="blogComment_text" name="blogComment[text]" cols="65" rows="5" wrap="VIRTUAL" ></textarea>
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
			<input type="hidden" name="entryId" value="|-$entry->getId()-|" id="entryId" />
			<input type="hidden" name="do" value="blogCommentsDoAddX" id="do">
			<input type="hidden" name="blogComment[entryId]" value="|-$entry->getId()-|" id="blogComment[entryId]" />
			<input type="button" value="Agregar Comentario" onClick="javascript:blogCommmentAdd(this.form,|-$entry->getId()-|)" /> 
			<input type="button" name="commentAdderHideButton|-$entry->getId()-|" value="Cancelar" id="commentAdderHideButton|-$entry->getId()-|" onClick="javascript:hideCommentAddForm(|-$entry->getId()-|)" />
			<input type="button" name="codeRefresher" id="codeRefresher" value="Regenerar código de seguridad"> <span id="msgBoxAdder|-$entry->getId()-|"></span>
		</p>
		</fieldset>
	</form>
	</div>
</div>
</div>
