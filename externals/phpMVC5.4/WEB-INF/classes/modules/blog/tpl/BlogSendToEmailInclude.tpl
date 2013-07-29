<div id="entry|-$entry->getId()-|SendToEmail">
	<form action="Main.php" method="post">
		<fieldset>
		<legend>Envío de Entrada</legend>
		<p>
			<label for="email">Email Destinatario</label>
			<input name="email" type="text" value="" size="45">
			</input>
		</p>
		<p>
			<label for="email">Ingrese su email </label>
			<input name="emailReplyTo" type="text" value="" size="45">
			</input>
		</p>
		<p><label>Código de seguridad</label>
			<div id="captchaEntry|-$entry->getId()-|">
				<img src="Main.php?do=commonCaptchaGeneration&width=120&height=45&characters=5" />
			</div>
		</p>
		<p>
			<label for="security_code">Ingrese el código de seguridad</label>
			<input id="security_code" name="securityCode" type="text" size="10" />
		</p>								
		<p>
			<input type="hidden" name="id" value="|-$entry->getId()-|"></input>
			<input type="hidden" name="do" value="blogSendToEmailX" id="do"></input>
			<input type="button" value="Enviar a Email" onClick="javascript:sendBlogEntryByEmailX(|-$entry->getId()-|,form);"></input>
			<input type="button" name="hidder" value="Cancelar" onClick="javascript:hideSendEmailForm('sendToEmailDiv|-$entry->getId()-|')">
			<input type="button" name="captchaRefresher" value="Regenerar código de seguridad" onClick="javascript:refreshCaptchaX('|-$entry->getId()-|')">
			<span id='sendEntryMsgBox|-$entry->getId()-|'></span>
		</p>
		</fieldset>
	</form>
	
</div>