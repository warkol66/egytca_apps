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
		|-if $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar el comentario</div>|-/if-|
		<h3>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Comentario</h3>
		<p>
			Ingrese los datos del comentario.
		</p>
		<fieldset title="Formulario de edición de datos de un comentario">
			<p>
				<label for="blogComment_entryId">Entrada</label>
				<select id="blogComment_entryId" name="blogComment[entryId]" title="entryId" class="emptyValidation">
				<option value="">Seleccione una entrada</option>
					|-foreach from=$entryIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $blogComment->getentryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()|truncate:45:"...":true-|</option>
					|-/foreach-|
				</select> |-validation_msg_box idField="blogComment_entryId"-|
				</p>
				<p>
				<label for="blogComment_text">Comentario</label>
			<textarea name="blogComment[text]" cols="55" rows="8" wrap="VIRTUAL" id="blogComment_text">|-$blogComment->gettext()-|</textarea>
		</p>
				<p>
				<label for="blogComment_email">email</label>
				<input type="text" id="blogComment_email" name="blogComment[email]" value="|-$blogComment->getemail()-|" title="email" maxlength="255" />
				</p>
				<p>
				<label for="blogComment_username">Usuario</label>
				<input type="text" id="blogComment_username" name="blogComment[username]" value="|-$blogComment->getusername()-|" title="username" maxlength="255" />
			</p>
			<p>
				<label for="blogComment_ip">ip</label>
				<input type="text" id="blogComment_ip" name="blogComment[ip]" value="|-$blogComment->getip()-|" title="ip" maxlength="50" />
			</p>
			<p>
				<label for="blogComment_creationDate">Fecha</label>
				<input name="blogComment[creationDate]" type="text" id="blogComment_creationDate" class="datepicker" title="creationDate" value="|-$blogComment->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="blogComment_status">Estado</label>
				<select id="blogComment_status" name="blogComment[status]" title="entryId">
				<option value="">Seleccione estado</option>
					|-foreach from=$statusOptions key=optionKey item=option name=for_type-|
					<option value="|-$optionKey-|" |-if $blogComment->getstatus() eq $optionKey-|selected="selected" |-/if-|>|-$option-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="blogComment_userId">Usuario</label>
				<select id="blogComment_userId" name="blogComment[userId]" title="userId">
				<option value="">Seleccione un User</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $blogComment->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
		</p>
		<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="blogComment[id]" id="blogComment_id" value="|-$blogComment->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="blogCommentsDoEdit" />
				<p>|-javascript_form_validation_button id="button_edit_blogComment" value='Aceptar' title='Aceptar'-|
				<input type="button" onClick='location.href="Main.php?do=blogCommentsList"' title="Cancelar" value="Cancelar" />
				</p>
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($entryId)-|
				<input type="hidden" name="entryId" value="|-$entryId-|" id="entryId"/>
				|-/if-|
				
			</p>
		</fieldset>
	</form>
</div>