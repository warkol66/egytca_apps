<script src="Main.php?do=js&name=commentsJs&module=board&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$('#codeRefresher').click(function(event){
			refreshCodeX('msgBoxAdder|-$challenge->getId()-|');
		});
	});
</script>
<form action="Main.php" method="post" style="margin-bottom: 20px;">
	<input type="hidden" name="do" value="boardCommentsShow" id="do">
	<input type="hidden" name="challengeId" value="|-$challenge->getId()-|" id="challengeId">
	|-if $challenge->getApprovedCommentsCount() gt 0-|
	Cantidad de Comentarios |-$challenge->getApprovedCommentsCount()-|
	<input type="button" style="display:none;" name="commentsShow" value="Mostrar Comentarios" id="commentsShow" onClick="javascript:boardCommentsShow(this.form,|-$challenge->getId()-|);"/>
	<input type="button" name="commentsHide" value="Ocultar Comentarios" id="commentsHide" onClick="javascript:boardCommentsHide('comments_holder_|-$challenge->getId()-|')"/> 
	|-/if-|
	<span id="mgsBoxCommentsShow|-$challenge->getId()-|"></span>
</form>
<div id="comments_holder_|-$challenge->getId()-|">
		|-include file="BoardCommentsShow.tpl" comments=$comments challenge=$challenge-|
<!-- Formulario para agregar comentario -->
<div id="div_comments_adder_|-$challenge->getId()-|">
<a name="commentsForm"></a>

<!-- TITULO FORMULARIO / DEJAR COMENTARIOS -->
 <div id="titleComments"><div id="icoWriteComments"></div>Deja tu comentario</div>	
	<div id="msgError"></div>
	<div id="formComments">
	<form action="Main.php" method="post" id="formCommentAdder|-$challenge->getId()-|">
<fieldset title="Formulario para agregar comentarios">
	<p>
	<label for="boardComment_username">Nombre</label>
			<input type="text" id="params_username" name="params[username]" title="username" size="40"/>
		</p>
		<p>
			<label for="params_email">Email</label><input type="text" id="params_email" name="params[email]" size="40" />
		</p>
		<p>
			<label for="params_bondId">Compromiso</label>
			<select id="params_bondId" name="params[bondId]" title="bondId" class="emptyValidation">
			<option value="">Seleccione el nivel de compromiso</option>
				|-foreach from=$bonds item=object-|
				<option value="|-$object->getid()-|">|-$object->getname()|truncate:45:"...":true-|</option>
				|-/foreach-|
			</select> |-validation_msg_box idField="boardComment_challengeId"-|
		</p>
		<p>
			<label for="params_text">Comentario</label><textarea id="params_text" name="params[text]" cols="65" rows="5" wrap="VIRTUAL" ></textarea>
		</p>
		<p>	
			<input type="hidden" name="params[challengeId]" value="|-$challenge->getId()-|" id="params_challengeId" />
			<input type="hidden" name="do" value="boardCommentsDoAddX" id="do">
			<input type="button" value="Agregar Comentario" onClick="javascript:boardCommmentAdd(this.form,|-$challenge->getId()-|)" /> 
			<input type="button" name="commentAdderHideButton|-$challenge->getId()-|" value="Cancelar" id="commentAdderHideButton|-$challenge->getId()-|" onClick="javascript:hideCommentAddForm(|-$challenge->getId()-|)" />
		</p>
		</fieldset>
	</form>
	</div>
</div>
</div>