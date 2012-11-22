<script>
	 $(function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
        });
     });
</script>
<h2>Comentarios</h2>
<h1>Administrar Comentarios</h1>
<div id="div_blogComment">
	<form name="form_edit_blogComment" id="form_edit_blogComment" action="Main.php" method="post">
		|-if $message eq "ok"-|<div class="successMessage">Comentario guardado con éxito</div>
		|-elseif $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar el comentario</div>|-/if-|
		<h3>|-if !$blogComment->isNew()-|Editar|-else-|Crear|-/if-| Comentario</h3>
		<p>
			Ingrese los datos del comentario.
		</p>
		<fieldset title="Formulario de edición de datos de un comentario">
			<p>
				<label for="params_entryId">Entrada</label>
				<select id="params_entryId" name="params[entryId]" title="entryId" class="emptyValidation">
				<option value="">Seleccione una entrada</option>
					|-foreach from=$entryIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $blogComment->getentryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()|truncate:45:"...":true-|</option>
					|-/foreach-|
				</select> |-validation_msg_box idField="blogComment_entryId"-|
				</p>
				<p>
				<label for="params_text">Comentario</label>
			<textarea name="params[text]" cols="55" rows="8" wrap="VIRTUAL" id="params_text">|-$blogComment->gettext()-|</textarea>
		</p>
				<p>
				<label for="params_email">email</label>
				<input type="text" id="params_email" name="params[email]" value="|-$blogComment->getemail()-|" title="email" maxlength="255" />
				</p>
				<p>
				<label for="params_username">Usuario</label>
				<input type="text" id="params_username" name="params[username]" value="|-$blogComment->getusername()-|" title="username" maxlength="255" />
			</p>
			<p>
				<label for="params_ip">ip</label>
				<input type="text" id="params_ip" name="params[ip]" value="|-$blogComment->getip()-|" title="ip" maxlength="50" />
			</p>
			<p>
				<label for="blogComment_creationDate">Fecha</label>
				<input name="blogComment[creationDate]" type="text" id="blogComment_creationDate" class="datepicker" title="creationDate" value="|-$blogComment->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="params_status">Estado</label>
				<select id="params_status" name="params[status]" title="entryId">
				<option value="">Seleccione estado</option>
					|-foreach from=$statusOptions key=optionKey item=option name=for_type-|
					<option value="|-$optionKey-|" |-if $blogComment->getstatus() eq $optionKey-|selected="selected" |-/if-|>|-$option-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params_userId">Usuario</label>
				<select id="params_userId" name="params[userId]" title="userId">
				<option value="">Seleccione un User</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $blogComment->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
		</p>
		<p>
				|-if !$blogComment->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$blogComment->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="blogCommentsDoEdit" />
				<p>|-javascript_form_validation_button id="button_edit_blogComment" value='Aceptar' title='Aceptar'-|
				<input type="button" onClick='location.href="Main.php?do=blogCommentsList"' title="Cancelar" value="Cancelar" />
				</p>
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($entryId)-|
				<input type="hidden" name="params[entryId]" value="|-$entryId-|" id="params_entryId"/>
				|-/if-|
				
			</p>
		</fieldset>
	</form>
</div>
