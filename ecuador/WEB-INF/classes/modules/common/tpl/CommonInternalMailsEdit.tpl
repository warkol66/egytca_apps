|-if isset($iframe)-|
<!--Se vuelven a agregar los scripts y estilos porque si no no los incluye-->
<script src="scripts/jquery/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script src="scripts/jquery/jquery.ui.datepicker-es.js" language="JavaScript" type="text/javascript"></script>
<link rel="stylesheet" href="css/globalStyles.css" type="text/css">
<link rel="stylesheet" href="css/globalCustom.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
|-/if-|
<link type="text/css" rel="stylesheet" href="css/chosen.css" />
<script src="scripts/jquery/chosen.js"></script>
<script type="text/javascript" src="scripts/jquery/ajax-chosen.min.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>

|-*include file="CommonAutocompleterInclude.tpl" *-| 
|-*include file="CommonEditTinyMceInclude.tpl" elements="internalMail[body]" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"*-|

<script type="text/javascript" language="javascript" charset="utf-8">
function updateUserSelected(opt){
	
	var options = $(opt).children();
	var idx = $('#recipientsSelected > li').size();
	
	for (var i=0; i < options.length; i++) {
		if (options[i].selected){
			console.log(options[i]);
			$('#recipientsSelected').append('<li><input type="button" class="icon iconDelete" onClick="$(this).parent().remove();updateSubmitButton()" title="Eliminar destinatario" /><input type="hidden" name="internalMail[to]['+idx+'][id]" value="'+ $(options[i]).val() +'" /><input type="hidden" name="internalMail[to]['+idx+'][type]" value="user" />'+ $(options[i]).html()  +'</li>');
			$(options[i]).remove();
		}
	 }
	 $('.chzn-results').html('');
	 $('.search-choice').remove();
}

function updateAffiliateSelected(opt) {
	
	var options = $(opt).children();
	var idx = $('#recipientsSelected > li').size();
	
	for (var i=0; i < options.length; i++) {
		if (options[i].selected){
			$('#recipientsSelected').append('<li><input type="button" class="icon iconDelete" onClick="$(this).parent().remove();updateSubmitButton()" title="Eliminar destinatario" /><input type="hidden" name="internalMail[to]['+idx+'][id]" value="'+ $(options[i]).val() +'" /><input type="hidden" name="internalMail[to]['+idx+'][type]" value="affiliateUser" />'+ $(options[i]).html()  +'</li>');
			$(options[i]).remove();
		}
	 }
	 $('.chzn-results').html('');
	 $('.search-choice').remove();
}
//migrada
function changeRecipientType(entityName) {
	if (entityName == "affiliateUser") {
		$('#recipientsAffiliates').show();
		$('#recipientsUsers').hide();
	}
	if (entityName == "user") {
		$('#recipientsAffiliates').hide();
		$('#recipientsUsers').show();
	}	
}
//migrada
function updateSubmitButton() {
	$("#recipientsSelected").children().each(function(){$("#button_edit_internalMail").attr('disabled',true)});
	/*if (($("recipientsSelected").childNodes.length - 1) <= 0)
		$("button_edit_internalMail").disable();*/
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
				<input type="radio" name="internalMail[recipientType]" value="user" onclick="changeRecipientType(this.value)" checked />##users,2,Usuario##
|-if ($configModule->get("global","internalMailUseAffiliates"))-|<input type="radio" name="recipientType" value="affiliateUser" onclick="changeRecipientType(this.value)" />##affiliates,2,Affiliado##|-/if-|
			</p>
			<p>
			<label>Destinatario:</label>
			<div id="recipientsUsers" style="position: relative;">
			|-if isset($user) and get_class($user) eq 'User'-|
				<input type="hidden" id="params_user" name="internalMail[recipientId]" value="|-$user->getId()-|" /><span>|-$user->getName()-| |-$user->getSurname()-|</span>
			|-else-|
				<select multiple='multiple' id="params_user_select" name="internalMail[recipientId]" class="chzn-select markets-chz-select" data-placeholder="Para..." onChange="javascript:updateUserSelected('#params_user_select')"></select>
			|-/if-|
			</div>
			</p>
|-if ($configModule->get("global","internalMailUseAffiliates"))-|			
			<div id="recipientsAffiliates" style="position: relative; display: none">
			|-if isset($user) and get_class($user) eq 'Affiliate'-|
				<input type="hidden" id="params_user_select" name="internalMail[recipientId]" value="|-$user->getId()-|" /><span>|-$user->getName()-| |-$user->getSurname()-|</span>
			|-else-|
				<select multiple='multiple' id="params_affiliate_select" class="chzn-select markets-chz-select" data-placeholder="Para..." onChange="javascript:updateAffiliateSelected('#params_user_select')"></select>
			|-/if-|
			</div>
|-/if-|			
			<span id="indicator2" style="display: none">
				<img src="images/spinner.gif" alt="Procesando..." />
			</span>
			
			<p>
				|-assign var=recipients value=$internalMail->getTo()-|
				<ul id="recipientsSelected">
					|-foreach from=$internalMail->getRecipients() key=idx item=user-|
						<li>
							<input type="button" class="icon iconDelete" onClick="this.parentNode.remove();updateSubmitButton()" title="Eliminar destinatario" />
							<input type="hidden" name="internalMail[to][|-$idx-|][id]" value="|-$user->getId()-|" />
							<input type="hidden" name="internalMail[to][|-$idx-|][type]" value="|-$recipients[$idx].type-|" />
							|-if ($user->getName() ne '') or ($user->getSurname() ne '')-||-$user->getSurname()-|, |-$user->getName()-| - |-/if-|(|-$user->getUserName()-|)
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
				|-if isset($iframe)-|
				<input type="hidden" name="iframe" id="iframe" value="true" />
				<input type="hidden" name="userId" id="userId" value="|-$userId-|" />
				<input type="hidden" name="userType" id="userType" value="|-$userType-|" />
				|-/if-|
				<input type="submit" id="button_edit_internalMail" name="button_edit_internalMail" title="Enviar" value="Enviar" />
				|-if !isset($iframe)-|
				<input type="button" id="cancel" name="cancel" title="Cancelar y volver al listado" value="Cancelar" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>|-/if-|
			</p>
		</fieldset>
	</form>
</div>
<script type="text/javascript">
|-if !isset($user)-|
$('#params_user_select').egytca('autocomplete', 'Main.php?do=usersAutocompleteListX',{disable: '#button_edit_internalMail'});
$('#params_affiliate_select').egytca('autocomplete', 'Main.php?do=affiliatesUsersAutocompleteListX',{disable: '#button_edit_internalMail'});
|-/if-|
</script>
