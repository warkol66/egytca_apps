|-include file="CommonAutocompleterInclude.tpl"-|

<script type="text/javascript" language="javascript" charset="utf-8">
function addParticipantToMission(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'participantsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">agregando participante a misión...</span>';
	return true;
}

function deleteParticipantFromMission(form){
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

</script>
<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox2" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconDelete" /></a> 
	</p> 
	|-include file="ActorsEditInclude.tpl"-|
</div> 
<h2>Tablero de Gestión</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Misión</h1>
<div id="div_mission">
	<p>Ingrese los datos del Misión</p>
		<p><a href="#" onClick="location.href='Main.php?do=panelMissionList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Misión guardada correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar la misión</div>
	|-/if-|

	<form name="form_edit_mission" id="form_edit_mission" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de una Misión">
			<legend>Formulario de Administración de Misiones</legend>
			<p>
				<label for="params[type]">Tipo</label>
				<select id="params[type]" name="params[type]" title="Tipo de Misión"> 
			<option value="">Seleccione tipo</option>
			|-html_options options=$types selected=$mission->getType()-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p> 
				<label for="params[startDate]">Fecha de Inicio</label>
				<input type="text" id="params[startDate]" name="params[startDate]" value="|-$mission->getstartDate()|date_format:"%d-%m-%Y"-|" title="Fecha del acto" />
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[startDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> </p> 
			<p> 
				<label for="params[finishDate]">Fecha de Finalización</label>
				<input type="text" id="params[finishDate]" name="params[finishDate]" value="|-$mission->getfinishDate()|date_format:"%d-%m-%Y"-|" title="Fecha del acto" />
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[finishDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> </p> 
			<p>
				<label for="params[policyGuidelineId]">Préstamo</label>
				<select id="params[policyGuidelineId]" name="params[policyGuidelineId]" title="Proyecto"> 
				<option value="">Seleccione préstamo</option>
				|-foreach from=$policyGuidelines item=policyGuideline key=key name=for_valores-|
        <option value="|-$policyGuideline->getId()-|" |-$mission->getpolicyGuidelineId()|selected:$policyGuideline->getId()-|>|-$policyGuideline->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      </select> 
			</p>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="70" rows="6" wrap="virtual" id="params[description]" title="Descripción">|-$mission->getdescription()|escape-|</textarea>
			</p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$mission->getid()-|" />
				|-else-|
			<p>* Para agregar información sobre participantes o anexar documentos, debe guardar primero el misión. </p>
				|-/if-|
			<p>
				|-include file="HiddenInputsInclude.tpl" action="$action" filters="$filters" page="$page"-|
				<input type="hidden" name="do" id="do" value="panelMissionDoEdit" />
				<input type="submit" id="button_edit_mission" name="button_edit_mission" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Volver al listado" value="Volver al listado" onClick="location.href='Main.php?do=panelMissionList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if isset($action) and $action neq 'create'-|
<fieldset title="Formulario de edición de participantes asociadas al misión">
	<legend>Participantes</legend>
<div id="PartyAdding"> <span id="partieMsgField"></span> 
  <form method="post"> 
		<p>
			<label>El participante es</label>
			<input type="radio" name="participant[type]" value="Actor" onclick="showParticipantType(this.value)" checked="checked" title="Si el participante no está en el listado de usuarios del sistema" />Actor
			<a class="tooltipWide" href="#"><span>Sólo podrá agregar Actores que estén cargados en el sistema.</span><img src="images/icon_info.gif"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#lightbox2" rel="lightbox2" class="lbOn addNew">Crear nuevo actor </a> <br />
			<input type="radio" name="participant[type]" value="User" onclick="showParticipantType(this.value)" title="Para incluir como participante a personas de la institución y con usuario del sistema" />Usuario
		</p>

		<div id="participantActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Actor" url="Main.php?do=actorsAutocompleteListX" hiddenName="participant[actorId]" disableSubmit="addParticipant"-|
		</div>
	
		<div id="participantUser" style="display:none; position: relative;z-index:10000">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_users" label="Usuario" url="Main.php?do=usersAutocompleteListX" hiddenName="participant[userId]" disableSubmit="addParticipant"-|
		</div>
	<p>
      <input type="hidden" name="do" id="do" value="panelMissionDoAddParticipantX" /> 
      <input type="hidden" name="missionId" id="missionId" value="|-$mission->getId()-|" /> 
      <input type="button" id="addParticipant" value="Agregar participante a misión" disabled onClick="javascript:addParticipantToMission(this.form)"/> 
    </p> 
  </form> 
	<h3>Participantes</h3>
  <div id="participantsList">
	|-include file="PanelMissionParticipantsInclude.tpl"-|
  </div>	
</div>
</fieldset>
<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconDelete" /></a> 
	</p> 
	|-include file="PanelMissionCommitmentForm.tpl"-|
</div> 
<fieldset title="Formulario de edición de compromisos asociadas al misión">
	<legend>Compromisos</legend>
|-assign var=commitments value=$mission->getMissionCommitments()-|
			<div id="commitmentInfo"></div>
		<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders" id="commitmentsList">
			<th colspan="6" class="thFillTitle"><div class="rightLink"><a href="#lightbox1" rel="lightbox1" class="lbOn addNew">Agregar compromiso</a></div></th>
			<tr class="thFillTitle">
			<th width="2%"></th>
			<th width="50%">Compromiso</th>
			<th width="20%">Responsable</th>
			<th width="20%">Fecha</th>
			<th width="5%">Cumplido</th>
			<th width="2%"></th>
			</tr>
			<tbody>
|-if $commitments|@count gt 0-|
     |-foreach from=$commitments item=commitment name=for_commitments-|
			<tr id="row_|-$commitment->getId()-|">
			<td></td>
			<td>|-$commitment->getCommitment()-|</td>
			 <td>|-$commitment->getResponsible()-|</td>
			 <td>|-$commitment->getDate()|date_format-|</td>
			 <td>|-$commitment->getAchieved()|yes_no|multilang_get_translation:"common"-|</td>
			 <td nowrap="nowrap">
			 <form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelMissionCommitmentEditX" /> 
					<input type="hidden" name="id" value="|-$commitment->getid()-|" />
					<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" name="submit_go_delete_mission" value="Borrar" onclick="editCommitment(this.form);" class="icon iconEdit" /></a>
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelMissionCommitmentDoDeleteX" /> 
					<input type="hidden" name="id" value="|-$commitment->getid()-|" /> 
					<input type="button" name="submit_go_delete_mission" value="Borrar" onclick="javascript: if (confirm('Seguro que desea eliminar este compromiso?')){deleteCommitment(this.form)}; return false" class="icon iconDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelMissionCommitmentDoDeleteX" /> 
					<input type="hidden" name="id" value="|-$commitment->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="button" name="submit_go_delete_mission" value="Borrar" onclick="javascript: if (confirm('Seguro que desea eliminar este compromiso definitivamente?')){deleteCommitment(this.form)}; return false" class="icon iconDelete" /> 
			</form>|-/if-|</td>
			 </tr>
    |-/foreach-|
|-/if-|
		</tbody>
		</table>
</fieldset>
	|-include file="DocumentsListInclude.tpl" entity="Mission" entityId=$mission->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="Mission" entityId=$mission->getId()-|
|-/if-| 