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
		<h3>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Comentario</h3>
		<p>
			Ingrese los datos del comentario.
		</p>
		<fieldset title="Formulario de edición de datos de un comentario">
			<p>
				<label for="newscomment_articleId">Noticia</label>
				<select id="newscomment_articleId" name="newscomment[articleId]" title="articleId">
				<option value="">Seleccione un NewsArticle</option>
					|-foreach from=$articleIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newscomment->getarticleId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()|truncate:45:"...":true-|</option>
					|-/foreach-|
				</select>
				</p>
				<p>
				<label for="newscomment_text">Comentario</label>
			<textarea name="params[text]" cols="45" rows="4" wrap="VIRTUAL" id="params_text">|-$newsComment->gettext()-|</textarea>
		</p>
				<p>
				<label for="newscomment_email">email</label>
				<input type="text" id="params_email" name="params[email]" value="|-$newsComment->getemail()-|" title="email" maxlength="255" />
				</p>
				<p>
				<label for="newscomment_username">Usuario</label>
				<input type="text" id="params_username" name="params[username]" value="|-$newsComment->getusername()-|" title="username" maxlength="255" />
			</p>
<!--			<p>
				<label for="newscomment_url">url</label>
				<input type="text" id="params_url" name="params[url]" value="|-$newsComment->geturl()-|" title="url" maxlength="255" />
			</p> -->
			<p>
				<label for="newscomment_ip">ip</label>
				<input type="text" id="params_ip" name="params[ip]" value="|-$newsComment->getip()-|" title="ip" maxlength="50" />
			</p>
			<p>
				<label for="newscomment_creationDate">Fecha</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="datepicker" title="creationDate" value="|-$newsComment->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newscomment_status">Estado</label>
				<input type="text" id="params_status" name="params[status]" value="|-$newsComment->getstatus()-|" title="status" />
			</p>
			<p>
				<label for="newscomment_userId">Usuario</label>
				<select id="newscomment_userId" name="params[userId]" title="userId">
				<option value="">Seleccione un User</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newscomment->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
		</p>
		<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$newsComment->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="newsCommentsDoEdit" />
				<input type="submit" id="button_edit_newscomment" name="button_edit_newscomment" title="Aceptar" value="Aceptar" />
				
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($articleId)-|
				<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
				|-/if-|
				
			</p>
		</fieldset>
	</form>
</div>
