|-include file="CommonAutocompleterInclude.tpl" -|
|-include file="CommonEditTinyMceInclude.tpl" elements="internalMail[body]" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<script type="text/javascript" language="javascript" charset="utf-8">

function recipientsUsersAfterUpdateElement(text, li) {
	$('autocomplete_users').value = '';
	var idx = $$('#recipientsSelected > li').size();
	$('recipientsSelected').insert('<li><input type="hidden" name="internalMail[to]['+idx+'][id]" value="'+li.id+'" /><input type="hidden" name="internalMail[to]['+idx+'][type]" value="user" />'+li.innerHTML.stripTags()+'<input type="button" class="iconDelete" onClick="this.parentNode.remove()" /></li>')
    if (!li.hasClassName('informative_only')) {
        var submit = $('button_edit_internalMail');
        if (Object.isElement(submit))
    		submit.enable();
	}
}

function recipientsAffiliatesAfterUpdateElement(text, li) {
	$('autocomplete_affiliates').value = '';
	var idx = $$('#recipientsSelected > li').size();
	$('recipientsSelected').insert('<li><input type="hidden" name="internalMail[to]['+idx+'][id]" value="'+li.id+'" /><input type="hidden" name="internalMail[to]['+idx+'][type]" value="affiliateUser" />'+li.innerHTML.stripTags()+'<input type="button" class="iconDelete" onClick="this.parentNode.remove()" /></li>')
    if (!li.hasClassName('informative_only')) {
        var submit = $('button_edit_internalMail');
        if (Object.isElement(submit))
    		submit.enable();
	}
}

function changeRecipientType(entityName) {
	if (entityName == "affiliateUser") {
		$('recipientsAffiliates').show();
		$('recipientsUsers').hide();
	}
	if (entityName == "user") {
		$('recipientsAffiliates').hide();
		$('recipientsUsers').show();
	}	
}
</script>
<h2>Mensajería Interna</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Mensaje</h1>
<div id="div_internalMail">
	<p>Ingrese los datos del mensaje</p>
		<p><a href="#" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Mensaje enviado correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar enviar el mensaje</div>
	|-/if-|
	
	<form name="form_edit_internalMail" id="form_edit_internalMail" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un mensaje">
			<legend>Formulario de Administración de Mensajes</legend>
			
			<p>
				<label>Tipo de destinatario:</label>
				<input type="radio" name="recipientType" value="user" onclick="changeRecipientType(this.value)" checked />##users,2,Usuario##
				<input type="radio" name="recipientType" value="affiliateUser" onclick="changeRecipientType(this.value)" />##affiliates,2,Affiliado##
			</p>
	
			<div id="recipientsUsers" style="position: relative;">
				|-include file="CommonAutocompleterInstanceInclude.tpl" id="autocomplete_users" label="Para" defaultValue="" defaultHiddenValue="" url="Main.php?do=usersAutocompleteListX" afterUpdateElement="recipientsUsersAfterUpdateElement"-|
			</div>	
			
			<div id="recipientsAffiliates" style="position: relative; display: none">
				|-include file="CommonAutocompleterInstanceInclude.tpl" id="autocomplete_affiliates" label="Para" defaultValue="" defaultHiddenValue="" url="Main.php?do=affiliatesUsersAutocompleteListX" afterUpdateElement="recipientsAffiliatesAfterUpdateElement"-|
			</div>
			
			<span id="indicator2" style="display: none">
				<img src="images/spinner.gif" alt="Procesando..." />
			</span>
			
			<p>
				|-assign var=recipients value=$internalMail->getTo()-|
				<ul id="recipientsSelected">
					|-foreach from=$internalMail->getRecipients() key=idx item=user-|
						<li>
							<input type="hidden" name="internalMail[to][|-$idx-|][id]" value="|-$user->getId()-|" />
							<input type="hidden" name="internalMail[to][|-$idx-|][type]" value="|-$recipients[$idx].type-|" />
							|-if ($user->getName() ne '') or ($user->getSurname() ne '')-||-$user->getSurname()-|, |-$user->getName()-| - |-/if-|(|-$user->getUserName()-|)
							<input type="button" class="iconDelete" onClick="this.parentNode.remove()" />
						</li>
					|-/foreach-|
				</ul>
			</p>
			
			<p>
				<label for="internalMail[subject]">Asunto</label>
				<input type="text" id="internalMail[subject]" name="internalMail[subject]" size="60" value="|-$internalMail->getSubject()-|" title="Asunto del mensaje" />
			</p>
			
			<p>
				<label for="internalMail[body]">Mensaje</label>
				<textarea id="internalMail[body]" name="internalMail[body]" cols="60" rows="8" wrap="virtual" value="|-$internalMail->getBody()-|" title="Cuerpo del mensaje"></textarea>
			</p>

			<p>
				<input type="hidden" name="do" id="do" value="commonInternalMailsDoEdit" />
				<input type="hidden" name="id" id="id" value="|-$internalMail->getId()-|" />
				<input type="hidden" name="internalMail[replyId]" id="internalMail[replyId]" value="|-$internalMail->getReplyId()-|" />
				<input type="hidden" name="page" id="page" value="|-$page-|" />
				<input type="submit" id="button_edit_internalMail" name="button_edit_internalMail" title="Enviar" value="Enviar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar y volver al listado" value="Cancelar" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>