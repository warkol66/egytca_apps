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
<div id="div_boardComment">
	<form name="form_edit_boardComment" id="form_edit_boardComment" action="Main.php" method="post">
		|-if $message eq "ok"-|<div class="successMessage">Comentario guardado con éxito</div>
		|-elseif $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar el comentario</div>|-/if-|
		<h3>|-if !$boardComment->isNew()-|Editar|-else-|Crear|-/if-| Comentario</h3>
		<p>
			Ingrese los datos del comentario.
		</p>
		<fieldset title="Formulario de edición de datos de un comentario">
			<p>
				<label for="params_challengeId">Consigna</label>
				<select id="params_challengeId" name="params[challengeId]" title="challengeId" class="emptyValidation">
				<option value="">Seleccione una entrada</option>
					|-foreach from=$challengeIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $boardComment->getchallengeId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()|truncate:45:"...":true-|</option>
					|-/foreach-|
				</select> |-validation_msg_box idField="boardComment_challengeId"-|
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
				<label for="params_text">Comentario</label>
				<textarea name="params[text]" cols="55" rows="8" wrap="VIRTUAL" id="params_text">|-$boardComment->gettext()-|</textarea>
			</p>
				<p>
				<label for="params_email">email</label>
				<input type="text" id="params_email" name="params[email]" value="|-$boardComment->getemail()-|" title="email" maxlength="255" />
				</p>
				<p>
				<label for="params_username">Usuario</label>
				<input type="text" id="params_username" name="params[username]" value="|-$boardComment->getusername()-|" title="username" maxlength="255" />
			</p>
			<p>
				<label for="params_ip">ip</label>
				<input type="text" id="params_ip" name="params[ip]" value="|-$boardComment->getip()-|" title="ip" maxlength="50" />
			</p>
			<p>
				<label for="params_creationDate">Fecha</label>
				<input name="params[creationDate]" type="text" id="params_creationDate" class="datepicker" title="creationDate" value="|-$boardComment->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="params_status">Estado</label>
				<select id="params_status" name="params[status]" title="challengeId">
				<option value="">Seleccione estado</option>
					|-foreach from=$statusOptions key=optionKey item=option name=for_type-|
					<option value="|-$optionKey-|" |-if $boardComment->getstatus() eq $optionKey-|selected="selected" |-/if-|>|-$option-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params_userId">Usuario</label>
				<select id="params_userId" name="params[userId]" title="userId">
				<option value="">Seleccione un User</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $boardComment->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
		</p>
		<p>
				|-if !$boardComment->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$boardComment->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="boardCommentsDoEdit" />
				<p>|-javascript_form_validation_button id="button_edit_boardComment" value='Aceptar' title='Aceptar'-|
				<input type="button" onClick='location.href="Main.php?do=boardCommentsList"' title="Cancelar" value="Cancelar" />
				</p>
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($challengeId)-|
				<input type="hidden" name="params[challengeId]" value="|-$challengeId-|" id="params_challengeId"/>
				|-/if-|
				
			</p>
		</fieldset>
	</form>
</div>
