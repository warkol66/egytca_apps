|-include file="CommonAutocompleterInclude.tpl" -|

<script type="text/javascript" language="javascript" charset="utf-8">
function addUserToScheduleSubscription(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'detinataryList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">agregando destinatario...</span>';
	return true;
}

function deleteUserFromScheduleSubscription(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'detinataryList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">eliminando destinatario...</span>';
	return true;
}

function moduleEntitiesAfterUpdateElement(text, li) {
    $('autocomplete_modulesEntities_selected_id').value = li.id;
    if (!li.hasClassName('informative_only')) {
        var submit = $('button_edit_scheduleSubscription');
        if (Object.isElement(submit))
    		submit.enable();
	}
	showEntityFieldSelector(li.id);
}

function moduleEntitiesOnChange() {
	var submit = $('button_edit_scheduleSubscription'); 
	if (Object.isElement(submit)) 
		submit.disable();
	$('entityFieldSelector').hide();
}

function showEntityFieldSelector(entityName) {
	var myAjax = new Ajax.Updater(
				{success: 'entityFieldSelector'},
				'Main.php?do=commonSchedulesSubscriptionsGetEntityFields',
				{
					method: 'get',
					parameters: {|-if $scheduleSubscription->getid() ne ''-|scheduleSubscriptionId: |-$scheduleSubscription->getid()-|, |-/if-|entityName: entityName},
					evalScripts: true
				});
	$('indicator2').innerHTML = '<span class="inProgress">agregando destinatario...</span>';
	return true;
}
</script>
<h2>Tablero de Gestión</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Suscripción a Agenda</h1>
<div id="div_scheduleSubscription">
	<p>Ingrese los datos del Suscripción a Agenda</p>
		<p><a href="#" onClick="location.href='Main.php?do=commonSchedulesSubscriptionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Suscripción a Agenda guardado correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el suscripción a agenda</div>
	|-/if-|
	
	<form name="form_edit_scheduleSubscription" id="form_edit_scheduleSubscription" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Suscripción a Schedulea">
			<legend>Formulario de Administración de Suscripción a Agendas</legend>
			<p>
				<label for="scheduleSubscription[name]">Nombre</label>
				<input type="text" id="scheduleSubscription[name]" name="scheduleSubscription[name]" size="80" value="|-$scheduleSubscription->getName()-|" title="Nombre de la suscripcion" />
			</p>
			<p>
				<div id="moduleEntity" style="position: relative;">
					|-include file="CommonAutocompleterInstanceInclude.tpl" id="autocomplete_modulesEntities" label="Entidad" defaultValue=$moduleEntity->getPhpName() defaultHiddenValue=$moduleEntity->getName() url="Main.php?do=modulesEntitiesAutocompleteListX" afterUpdateElement="moduleEntitiesAfterUpdateElement" onChange="moduleEntitiesOnChange()" onComplete="moduleEntitiesOnChange()"-|
				</div>
				<input type="hidden" id="autocomplete_modulesEntities_selected_id" name="scheduleSubscription[entityName]" value="|-$scheduleSubscription->getEntityName()-|" />
			</p>
			<span id="indicator2" style="display: none">
				<img src="images/spinner.gif" alt="Procesando..." />
			</span>
			<div id="entityFieldSelector">
				|-include file="CommonSchedulesSubscriptionsEntityFieldSelectorInclude.tpl"-|
			</div>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$scheduleSubscription->getid()-|" />
				|-else-|
			<p>* Para agregar información sobre destinatarios debe guardar primero la suscripción a agenda. </p>
				|-/if-|
			<p>
				<input type="hidden" name="do" id="do" value="commonSchedulesSubscriptionsDoEdit" />
				<input type="submit" id="button_edit_scheduleSubscription" name="button_edit_scheduleSubscription" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Volver al listado" value="Volver al listado" onClick="location.href='Main.php?do=commonSchedulesSubscriptionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if isset($action) and $action neq 'create'-|
<fieldset title="Formulario de edición de destinatarios asociadas al suscripción a agenda">
	<legend>Destinatarios</legend>
<div id="PartyAdding"> <span id="partieMsgField"></span> 
  <form method="post"> 
		<div id="user" style="position: relative;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_users" label="Usuario" url="Main.php?do=usersAutocompleteListX" hiddenName="user[id]" disableSubmit="addUser"-|
		</div>
	<p>
      <input type="hidden" name="do" id="do" value="commonSchedulesSubscriptionsDoAddUserX" /> 
      <input type="hidden" name="scheduleSubscriptionId" id="scheduleSubscriptionId" value="|-$scheduleSubscription->getId()-|" /> 
      <input type="button" id="addUser" value="Agregar destinatario" disabled onClick="javascript:addUserToScheduleSubscription(this.form)"/> 
    </p> 
  </form>
  <div id="detinataryList">
	|-include file="CommonSchedulesSubscriptionsUsersInclude.tpl"-|
  </div>	
  <form method="post" action="Main.php"> 
	<p>
		<label for="scheduleSubscription[extraRecipients]">Destinatarios adicionales</label>
		<textarea name="scheduleSubscription[extraRecipients]">|-$scheduleSubscription->getExtraRecipients()-|</textarea>
	</p>
	<p>
      <input type="hidden" name="do" id="do" value="commonSchedulesSubscriptionsDoEdit" />
      <input type="hidden" name="id" id="id" value="|-$scheduleSubscription->getid()-|" />
      <input type="submit" value="Agregar"/> 
    </p> 
  </form> 
</div>
</fieldset>
|-/if-| 