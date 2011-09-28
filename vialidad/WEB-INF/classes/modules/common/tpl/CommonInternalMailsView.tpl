<h2>Tablero de Gestión</h2>
<div id="div_internalMail">
	<p><a href="#" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a></p>
	
	<fieldset>
		<legend>Formulario de Administración de Mensajes</legend>
	
		<p class="textAfterLabel">
			<label>De: </label>
			|-assign var=userFrom value=$internalMail->getFrom()-|
			|-$userFrom->getName()-|
		</p>
		
		<p class="textAfterLabel">
			<label>Para: </label>
			|-foreach from=$internalMail->getRecipients() item=recipient-|
				<span>|-$recipient->getName()-|</span><br />
			|-/foreach-|
		</p>
		
		<p class="textAfterLabel">
			<label>Asunto: </label>
			|-$internalMail->getSubject()-|
		</p>
			
		<p class="textAfterLabel">
			<label>Mensaje: </label>
			|-$internalMail->getBody()-|
		</p>
		
	</fieldset>
	
	<form method="GET" action="Main.php">
			<p>
				<input type="hidden" name="do" id="do" value="commonInternalMailsEdit" />
				<input type="hidden" name="replyId" id="replyId" value="|-$internalMail->getId()-|" />
				<input type="hidden" name="page" id="page" value="|-$page-|" />
				<input type="submit" id="button_reply_internalMail" name="button_reply_internalMail" title="Responder a todos" value="Responder a todos" />
				<input type="button" id="cancel" name="cancel" title="Volver al listado" value="Volver al listado" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
	</form>
</div>