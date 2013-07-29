<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
		});

	});//fin docready
</script>
<h2>Comentarios</h2>
<h1>Administrar Comentarios</h1>
<div id="div_newscomment">
	<form name="form_edit_newscomment" id="form_edit_newscomment" action="Main.php" method="post">
		|-if $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar el comentario</div>|-/if-|
		<h3>|-if !$newsComment->isNew()-|Editar|-else-|Crear|-/if-| Comentario</h3>
		<p>
			Ingrese los datos del comentario.
		</p>
		<fieldset title="Formulario de edición de datos de un comentario">
			<p>
				<label for="newscomment_newsarticleid">Noticia</label>
				<select id="params_newsArticleId" name="params[newsArticleId]" class="emptyValidation">
				<option value="">Seleccione un NewsArticle</option>
					|-foreach from=$articleIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newsComment->getNewsarticleid() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()|truncate:45:"...":true-|</option>
					|-/foreach-|
				</select> |-validation_msg_box idField="newsComment_newsarticleId"-|
				</p>
				<p>
				<label for="newscomment_text">Comentario</label>
				<textarea name="params[text]" cols="45" rows="4" wrap="VIRTUAL" id="params_text">|-$newsComment->gettext()-|</textarea>
				</p>
<!--			<p>
				<label for="newscomment_url">url</label>
				<input type="text" id="params_url" name="params[url]" value="|-$newsComment->geturl()-|" title="url" maxlength="255" />
			</p> -->
			<p>
				<label for="newscomment_creationDate">Fecha</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="datepicker" title="creationDate" value="|-$newsComment->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newscomment_status">Estado</label>
				<select id="params_status" name="params[status]" title="status">
					<option value="">Seleccione un Estado</option>
					|-foreach from=$statuses key=optionKey item=option name=for_type-|
					<option value="|-$optionKey-|" |-if $newsComment->getstatus() eq $optionKey-|selected="selected" |-/if-|>|-$option-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				|-if !$newsComment->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$newsComment->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="newsCommentsDoEdit" />
				<p>|-javascript_form_validation_button id="button_edit_blogComment" value='Aceptar' title='Aceptar'-|
				<input type="button" onClick='location.href="Main.php?do=blogCommentsList"' title="Cancelar" value="Cancelar" />
				</p>
				<!--input type="submit" id="button_edit_newscomment" name="button_edit_newscomment" title="Aceptar" value="Aceptar" /-->
				
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($articleId)-|
				<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
				|-/if-|
				
			</p>
		</fieldset>
	</form>
</div>
