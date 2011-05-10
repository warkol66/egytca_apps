<h2>Formularios</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Formulario</h1>
|-include file='FormsEditTinyMceInclude.tpl' element=form[content] plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|

<div id="div_form">
	<form name="form_edit_form" id="form_edit_form" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el formulario</div>
		|-/if-|
		<p>
			Ingrese los datos del formulario. Si desea que la persona que completa el formulario reciba una copia del mensaje del envío, la dirección debe ingresarse en un campo con el nombre "email". Puede ingresar un mensaje personalizado para el encabezado del mismo.
		</p>
		<fieldset title="Formulario de edición de datos de un formulario">
		<legend>Formulario</legend>
			<p>
				<label for="form_name">Nombre</label>
				<input name="form[name]" type="text" id="form_name" title="Nombre del formulario, también se utilizará para el asunto del mensaje que se envíe" value="|-$form->getname()|escape-|" size="50" />
			</p>
			<p>
				<label for="form_description">Descripción</label>
				<textarea name="form[description]" cols="50" rows="2" id="form_description" title="name">|-$form->getDescription()|escape-|</textarea>
			</p>
		<p>
				<label for="form_mailsTo">Destinatarios</label>
				<input type="text" id="form_mailsTo" name="form[mailsTo]" size="50" value="|-$form->getmailsTo()-|" title="Ingrese las direcciones odnde recibir copia del mensaje, pued eincluir mas de una separando por comas." maxlength="255" />
		</p>
			<p>
				<label for="form_content">Cuerpo</label>
				<textarea id="form_content" name="form[content]" rows="10" cols="80">|-$form->getcontent()|htmlentities-|</textarea>
			</p>
			<p>
				<label for="form_redirectUrl">Redireccionar</label>
				<input type="text" id="form_redirectUrl" name="form[redirectUrl]" size="50" value="|-$form->getredirectUrl()|escape-|" title="redirectUrl" maxlength="255" />
			</p>
			<p>
				<label for="form_redirectMessage">Mensaje</label>
				<input type="text" id="form_redirectMessage" name="form[redirectMessage]" size="50" value="|-$form->getredirectMessage()|escape-|" title="redirectMessage" maxlength="255" />
			</p>
			<p>
				<label for="form_redirectMessage">Texto de envío</label>
				<input type="text" id="form_submitValue" name="form[submitValue]" size="50" value="|-$form->getsubmitValue()|escape-|" title="submitValue" maxlength="255" />
			</p>
			<p>
				<label for="form_senderEmailField">Mensaje al remitente</label>
				<textarea name="form[senderEmailField]" cols="50" rows="3" id="form_senderEmailField" title="redirectMessage">|-$form->getsenderEmailField()|escape-|</textarea>
			</p>
			<p>
				<label for="form_hasCaptcha">Usa Captcha</label>
				<input type="hidden" name="form[hasCaptcha]" value="0" />
				<input type="checkbox" id="form_hasCaptcha" name="form[hasCaptcha]" value="checkbox" title="Usa Captcha" |-if $form->gethasCaptcha()-|checked="checked"|-/if-| onClick="javascript:switch_vis('captchaMessage_div')" />
			</p>
			<div id="captchaMessage_div" style="display:|-if $form->gethasCaptcha()-|block|-else-|none|-/if-|"><p>
				<label for="form_captchaMessage">Texto de captcha</label>
				<input type="text" id="form_captchaMessage" name="form[captchaMessage]" size="50" value="|-$form->getcaptchaMessage()|escape-|" title="submitValue" maxlength="255" />
			</p></div>
			<p>
			|-if $action eq "edit"-|
				<input type="hidden" name="form[id]" id="form_id" value="|-$form->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="formsFormsDoEdit" />
				<input type="submit" id="button_edit_form" name="button_edit_form" title="Guardar" value="Guardar" />
			</p>
		</fieldset>
	</form>
</div>
