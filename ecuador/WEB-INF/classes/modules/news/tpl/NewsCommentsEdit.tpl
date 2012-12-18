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
			<textarea name="newscomment[text]" cols="45" rows="4" wrap="VIRTUAL" id="newscomment_text">|-$newscomment->gettext()-|</textarea>
		</p>
				<p>
				<label for="newscomment_email">email</label>
				<input type="text" id="newscomment_email" name="newscomment[email]" value="|-$newscomment->getemail()-|" title="email" maxlength="255" />
				</p>
				<p>
				<label for="newscomment_username">Usuario</label>
				<input type="text" id="newscomment_username" name="newscomment[username]" value="|-$newscomment->getusername()-|" title="username" maxlength="255" />
			</p>
<!--			<p>
				<label for="newscomment_url">url</label>
				<input type="text" id="newscomment_url" name="newscomment[url]" value="|-$newscomment->geturl()-|" title="url" maxlength="255" />
			</p> -->
			<p>
				<label for="newscomment_ip">ip</label>
				<input type="text" id="newscomment_ip" name="newscomment[ip]" value="|-$newscomment->getip()-|" title="ip" maxlength="50" />
			</p>
			<p>
				<label for="newscomment_creationDate">Fecha</label>
				<input name="newscomment[creationDate]" type="text" id="newscomment_creationDate" title="creationDate" value="|-$newscomment->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('newscomment[creationDate]', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newscomment_status">Estado</label>
				<input type="text" id="newscomment_status" name="newscomment[status]" value="|-$newscomment->getstatus()-|" title="status" />
			</p>
			<p>
				<label for="newscomment_userId">Usuario</label>
				<select id="newscomment_userId" name="newscomment[userId]" title="userId">
				<option value="">Seleccione un User</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newscomment->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
		</p>
		<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="newscomment[id]" id="newscomment_id" value="|-$newscomment->getid()-|" />
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
