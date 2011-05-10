|-include file="CommonAutocompleterInclude.tpl" -|

<script type="text/javascript" language="javascript" charset="utf-8">
function addParticipantToAdminAct(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'participantsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">agregando participante al acto...</span>';
	return true;
}

function deleteParticipantToAdminAct(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'participantsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">eliminando participante...</span>';
	return true;
}

function showParticipantType(type) {
	if (type == "Actor") {
		$('participantActor').show();
		$('participantUser').hide();
	}
	if (type == "User") {
		$('participantActor').hide();
		$('participantUser').show();
	}	
}

function clearElement(element) {
	var e_ref="";
	e_ref=document.getElementById(element);
	e_ref.innerHTML = '';
}
</script><script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="iconDelete" /></a> 
	</p> 
	|-include file="ActorsEditInclude.tpl"-|
</div> 
<h2>Tablero de Gestión</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Acto Administrativo</h1>
<div id="div_administrativeAct">
	<p>Ingrese los datos del Acto Administrativo</p>
		<p><a href="#" onClick="location.href='Main.php?do=panelAdministrativeActsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Acto Administrativo guardado correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el acto administrativo</div>
	|-/if-|
	
	<form name="form_edit_administrativeAct" id="form_edit_administrativeAct" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Acto Administrativo">
			<legend>Formulario de Administración de Acto Administrativos</legend>
			<p>
				<label for="params[type]">Tipo</label>
				<select id="params[type]" name="params[type]" title="Tipo de Acto Administrativo"> 
			<option value="">Seleccione tipo</option>
				|-foreach from=$types item=type key=key name=for_valores-|
        <option value="|-$key-|" |-$administrativeAct->getType()|selected:$key-|>|-$type-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[object]">Objeto</label>
				<input type="text" id="params[object]" name="params[object]" size="80" value="|-$administrativeAct->getobject()|escape-|" title="Objeto dle Acto" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p> 
				<label for="params[actDate]">Fecha</label>
				<input type="text" id="params[actDate]" name="params[actDate]" value="|-$administrativeAct->getActDate()|date_format:"%d-%m-%Y"-|" title="Fecha del acto (Formato: dd-mm-yyyy)" />
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[actDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> </p> 
			<p>
				<label for="params[projectId]">Proyecto/contrato</label>
				<select id="params[projectId]" name="params[projectId]" title="Proyecto"> 
				<option value="">Seleccione proyecto/contrato</option>
				|-foreach from=$projects item=project key=key name=for_valores-|
        <option value="|-$project->getId()-|" |-$administrativeAct->getProjectId()|selected:$project->getId()-|>|-$project->getName()|truncate:105:"...":false-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="70" rows="6" wrap="virtual" id="params[description]" title="Descripción">|-$administrativeAct->getdescription()|escape-|</textarea>
			</p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$administrativeAct->getid()-|" />
				|-else-|
			<p>* Para agregar información sobre participantes o anexar documentos, debe guardar primero el acto administrativo. </p>
				|-/if-|
			<p>
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="panelAdministrativeActsDoEdit" />
				<input type="submit" id="button_edit_administrativeAct" name="button_edit_administrativeAct" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Volver al listado" value="Volver al listado" onClick="location.href='Main.php?do=panelAdministrativeActsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if isset($action) and $action neq 'create'-|
<fieldset title="Formulario de edición de participantes asociadas al acto administrativo">
	<legend>Participantes</legend>
<div id="PartyAdding"> <span id="partieMsgField"></span> 
  <form method="post"> 
		<p>
			<label>El participante es</label>
			<input type="radio" name="participant[type]" value="Actor" onclick="showParticipantType(this.value)" checked="checked" title="Si el participante no está en el listado de usuarios del sistema" />Actor
			<a class="tooltipWide" href="#"><span>Sólo podrá agregar Actores que estén cargados en el sistema.</span><img src="images/icon_info.gif"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#lightbox1" rel="lightbox1" class="lbOn addNew">Crear nuevo actor </a> <br />
			<input type="radio" name="participant[type]" value="User" onclick="showParticipantType(this.value)" title="Para incluir como participante a personas de la institución y con usuario del sistema" />Usuario
		</p>

		<div id="participantActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Actor" url="Main.php?do=actorsAutocompleteListX&adminActId="|cat:$administrativeAct->getid() hiddenName="participant[actorId]" disableSubmit="addParticipant"-|
		</div>
	
		<div id="participantUser" style="display:none; position: relative;z-index:10000">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_users" label="Usuario" url="Main.php?do=usersAutocompleteListX&adminActId="|cat:$administrativeAct->getid() hiddenName="participant[userId]" disableSubmit="addParticipant"-|
		</div>
	<p>
      <input type="hidden" name="do" id="do" value="panelAdministrativeActsDoAddParticipantX" /> 
      <input type="hidden" name="administrativeActId" id="administrativeActId" value="|-$administrativeAct->getId()-|" /> 
      <input type="button" id="addParticipant" value="Agregar participante al acto" disabled onClick="javascript:addParticipantToAdminAct(this.form)"/> 
    </p> 
  </form> 
	<h3>Participantes</h3>
  <div id="participantsList">
	|-include file="PanelAdministrativeActParticipantsInclude.tpl"-|
  </div>	
</div>
</fieldset>
	|-include file="DocumentsListInclude.tpl" entity="AdministrativeAct" entityId=$administrativeAct->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="AdministrativeAct" entityId=$administrativeAct->getId()-|
|-/if-| 