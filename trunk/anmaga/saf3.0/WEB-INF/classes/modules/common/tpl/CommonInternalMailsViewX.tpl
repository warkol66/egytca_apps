<h2>Mensajería Interna</h2>
<h1>Asunto: |-$internalMail->getSubject()-|</h1>
<div id="div_internalMail">
	<fieldset>
		<legend>Datos del mensaje</legend>
		<p class="textAfterLabel">
			<label>Fecha: </label>
			|-$internalMail->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y %H:%M:%S"-|
		</p>
		<p class="textAfterLabel">
			<label>De: </label>
			|-assign var=userFrom value=$internalMail->getFrom()-|
			|-$userFrom->getName()-|
		</p>
|-if ($internalMail->getFromId() neq "-1" && $internalMail->getFromType() neq "user")-|		<p class="textAfterLabel">
			<label>Para: </label>
			|-foreach from=$internalMail->getRecipients() item=recipient-|
				<span>|-$recipient->getName()-|</span><br />
			|-/foreach-|
		</p>|-/if-|
	</fieldset>
		<p class="textAfterLabel">
			<label>Mensaje: </label>
		</p>
			|-$internalMail->getBody()-|
			<p>&nbsp;</p>
			<p>&nbsp;</p>
	<hr />	
			<p>&nbsp;</p>
|-if ($internalMail->getFromId() neq "-1" && $internalMail->getFromType() neq "user")-|<form method="GET" action="Main.php" style="display: inline;">
				<input type="hidden" name="do" id="do" value="commonInternalMailsEdit" />
				<input type="hidden" name="replyId" id="replyId" value="|-$internalMail->getId()-|" />
				<input type="hidden" name="page" id="page" value="|-$page-|" />
				<input type="submit" id="button_reply_internalMail" name="button_reply_internalMail" title="Responder" value="Responder" />
	</form>
	<form method="GET" action="Main.php" style="display: inline;">
				<input type="hidden" name="do" id="do" value="commonInternalMailsEdit" />
				<input type="hidden" name="replyToAll" id="replyToAll" value="true" />
				<input type="hidden" name="replyId" id="replyId" value="|-$internalMail->getId()-|" />
				<input type="hidden" name="page" id="page" value="|-$page-|" />
				<input type="submit" id="button_reply_internalMail" name="button_reply_internalMail" title="Responder a todos" value="Responder a todos" />
	</form>|-/if-|
	<form method="GET" action="Main.php" style="display: inline;">
				<input type="button" id="button_mark_as_unread" name="button_mark_as_unread" title="Marcar como no leído" value="Marcar como no leído" onClick="markAsUnread({ 'selectedIds[]': |-$internalMail->getId()-|}); return false;"/>
	</form>
	<form method="GET" action="Main.php" style="display: inline;">
				<a href="#" class="lbAction blackNoDecoration" rel="deactivate"><input type="button" id="button_delete" name="button_delete" title="Eliminar" value="Eliminar" onClick="deleteMessages({ 'selectedIds[]': |-$internalMail->getId()-|});"/></a> 
	</form>
</div>