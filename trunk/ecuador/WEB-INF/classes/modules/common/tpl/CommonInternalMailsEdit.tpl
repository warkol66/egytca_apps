|-if isset($iframe)-|
<!--Se vuelven a agregar los scripts y estilos porque si no no los incluye-->
<script src="scripts/jquery/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script src="scripts/jquery/jquery.ui.datepicker-es.js" language="JavaScript" type="text/javascript"></script>
<link rel="stylesheet" href="css/main.css" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(images/bkg_bodyFancybox.png);
	background-color: #dad2ca;
	background-position: top left;
	background-repeat:repeat-x;
	color: #333;
	font-size:77%; /* this makes the text sized at 10px */
	padding: 0 0 40px;
}
#wrapper {
	width: 100%;
	background-color:#fdf8e9;
	-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.5);
	box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.5);
	-webkit-border-radius: 0px 0px 10px 10px;
border-radius: 0px 0px 10px 10px;

}
#rightColumn{
	background-image: url(images/bkg_bodyFancyboxBody.png);
	background-repeat: repeat-x;
	background-position: top;
	background-color: #FDF8E9;
	margin-top: 0px;
}
.emergent{
	width: 90% !Important;
	margin-left: auto;
}
-->
</style>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
|-/if-|
<link type="text/css" rel="stylesheet" href="css/chosen.css" />
<script src="scripts/jquery/chosen.js"></script>
<script type="text/javascript" src="scripts/jquery/ajax-chosen.min.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>

|-*include file="CommonAutocompleterInclude.tpl" *-| 
|-*include file="CommonEditTinyMceInclude.tpl" elements="internalMail[body]" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"*-|

<script type="text/javascript" language="javascript" charset="utf-8">
$(function(){
	var users = [|-foreach from=$users item=avUser name=users-|"|-$avUser-|"|-if !$smarty.foreach.users.last-|,|-/if-||-/foreach-|];
	var affiliates = [|-foreach from=$affiliates item=avAffiliate name=affiliates-|"|-$avAffiliate-|"|-if !$smarty.foreach.users.last-|,|-/if-||-/foreach-|];
	
	$( "#userRecipients" ).autocomplete({source: users});
	$( "#affiliateRecipients" ).autocomplete({source: users});
});

function updateUserSelected(opt){
	
	var options = $(opt).children();
	var idx = $('#recipientsSelected > li').size();
	
	for (var i=0; i < options.length; i++) {
		if (options[i].selected){
			if($('#recipient_' + $(options[i]).val()).length() == 0){
				$('#recipientsSelected').append('<li id="recipient_' + $(options[i]).val() +'"><input type="button" class="icon iconDelete" onClick="$(this).parent().remove();updateSubmitButton()" title="Eliminar destinatario" /><input type="hidden" name="internalMail[to]['+idx+'][id]" value="'+ $(options[i]).val() +'" /><input type="hidden" name="internalMail[to]['+idx+'][type]" value="user" />'+ $(options[i]).html()  +'</li>');
			}
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
			if($('#recipient_' + $(options[i]).val()).length() == 0){
				$('#recipientsSelected').append('<li id="recipient_' + $(options[i]).val() +'"><input type="button" class="icon iconDelete" onClick="$(this).parent().remove();updateSubmitButton()" title="Eliminar destinatario" /><input type="hidden" name="internalMail[to]['+idx+'][id]" value="'+ $(options[i]).val() +'" /><input type="hidden" name="internalMail[to]['+idx+'][type]" value="affiliateUser" />'+ $(options[i]).html()  +'</li>');
			}
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
|-if $iframe-|<div id="wrapper">
<div id="rightColumn" class="emergent">
  <p>&nbsp;</p>
|-/if-|
<h2>Mensajería Interna</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Mensaje</h1>
<div id="div_internalMail">
	<p>Ingrese los datos del mensaje</p>
		|-if !$iframe-|<p><a href="#" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>|-/if-|
		</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Mensaje enviado correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar enviar el mensaje</div>
	|-/if-|
	
	<form name="form_edit_internalMail" id="form_edit_internalMail" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un mensaje">
			<legend>Formulario de Administración de Mensajes</legend>
			
			<p |-if $iframe-|style="display:none;"|-/if-|>
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
				<input id="userRecipients" />
			|-/if-|
			</div>
			</p>
|-if ($configModule->get("global","internalMailUseAffiliates"))-|			
			<div id="recipientsAffiliates" style="position: relative; display: none">
			|-if isset($user) and get_class($user) eq 'Affiliate'-|
				<input type="hidden" id="params_user_select" name="internalMail[recipientId]" value="|-$user->getId()-|" /><span>|-$user->getName()-| |-$user->getSurname()-|</span>
			|-else-|
				<input id="affiliateRecipients" />
			|-/if-|
			</div>
|-/if-|			
			<span id="indicator2" style="display: none">
				<img src="images/spinner.gif" alt="Procesando..." />
			</span>
			
			<p>
				|-assign var=recipients value=$internalMail->getTo()-|
				<ul id="recipientsSelected">
					|-foreach from=$internalMail->getRecipients() key=idx item=toUser-|
						<li id="recipient_|-$toUser->getId()-|">
							<input type="button" class="icon iconDelete" onClick="$(this).parent().remove();updateSubmitButton()" title="Eliminar destinatario" />
							<input type="hidden" name="internalMail[to][|-$idx-|][id]" value="|-$toUser->getId()-|" />
							<input type="hidden" name="internalMail[to][|-$idx-|][type]" value="|-$recipients[$idx].type-|" />
							|-if ($toUser->getName() ne '') or ($toUser->getSurname() ne '')-||-$toUser->getSurname()-|, |-$toUser->getName()-| - |-/if-|(|-$toUser->getUserName()-|)
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
				<textarea id="internalMail[body]" name="internalMail[body]" cols="60" rows="6" wrap="virtual" value="|-$internalMail->getBody()-|" title="Cuerpo del mensaje"></textarea>
			</p>

			<p>
				<input type="hidden" name="do" id="do" value="commonInternalMailsDoEdit" />
				<input type="hidden" name="id" id="id" value="|-$internalMail->getId()-|" />
				<input type="hidden" name="internalMail[replyId]" id="internalMail[replyId]" value="|-$internalMail->getReplyId()-|" />
				<input type="hidden" name="page" id="page" value="|-$page-|" />
				|-if isset($iframe)-|
				<input type="hidden" name="iframe" id="iframe" value="true" />
				<input type="hidden" name="userId" id="userId" value="|-$user->getId()-|" />
				<input type="hidden" name="userType" id="userType" value="|-get_class($user)-|" />
				|-/if-|
				<input type="submit" id="button_edit_internalMail" name="button_edit_internalMail" title="Enviar" value="Enviar" />
				|-if !isset($iframe)-|
				<input type="button" id="cancel" name="cancel" title="Cancelar y volver al listado" value="Cancelar" onClick="location.href='Main.php?do=commonInternalMailsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>|-/if-|
			</p>
		</fieldset>
	</form>
</div>
|-if $iframe-|</div>
</div>
|-/if-|
