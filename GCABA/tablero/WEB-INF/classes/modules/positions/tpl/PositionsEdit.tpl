<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Posición</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<script type="text/javascript" language="javascript">
function positionsGetAllParentsByPositionX(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'positionsMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('positionsMsgField').innerHTML = '<p><span class="inProgress">buscando padres...</span></p>';
	return true;
}
function addTenureToPosition(form) {
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

function deleteTenureToPosition(form){
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

function showTenureType(type) {
	if (type == "Actor") {
		$('tenureActor').show();
		$('tenureUser').hide();
	}
	if (type == "User") {
		$('tenureActor').hide();
		$('tenureUser').show();
	}	
}
</script>
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una posición.</p>
<div id="div_region">
	|-if $message eq "ok"-|
		<div class="successMessage">Posición guardada correctamente</div>
	|-/if-|
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la posición </div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de una posición">
     <legend>Ingrese los datos de la Posición</legend>
	<form action="Main.php" method="post" >
				<input type="hidden" name="do" value="positionsGetAllParentsByPositionX" />
<p>
      <label for="positionDataX[type]">Tipo</label>
|-if $action eq "edit"-|
	|-if $position->getKind() eq $staffKind -|
		|-$positionKinds[$staffKind]-|
	|-else-|
		|-$position->getPositionTypeTranslated()-|
	|-/if-|
|-else-|<select id="positionDataX[type]" name="positionDataX[type]" title="type" onChange="positionsGetAllParentsByPositionX(this.form);">
			<option value="0">Seleccione el tipo</option>
			<optgroup label="|-"Hierarchical"|multilang_get_translation:"positions"-|">
			|-foreach from=$positionTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get('positions','treeRootType')-|
        		<option value="|-$typeKey-|">|-section name=space loop=$typeKey start=$configModule->get('positions','treeRootType')-|&nbsp;&nbsp;|-/section-||-$type-|</option>
				|-/if-|
			|-/foreach-|
			</optgroup>
			<optgroup label="|-"Staff"|multilang_get_translation:"positions"-|">
			<option value="|-$staffKind-|">&nbsp;&nbsp;|-$positionKinds[$staffKind]-|</option>
			</optgroup>
      </select>|-/if-|</p>
		</form>
	<form name="form_edit_position" id="form_edit_position" action="Main.php" method="post">
<span id="positionsMsgField"></span>
|-if $action eq "edit"-|
	|-if $position->getType() eq $configModule->get('positions','treeRootType') || $positions|@count eq 0-|
	|-else-|
  <p><label for="positionData[parentId]">Reporta a</label>
  <select id="postionData[parentId]" name="positionData[parentId]" title="parentId"> 
	|-foreach from=$positions item=parent name=for_parent-|
   |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|" |-if $position->getParentId() eq $parent->getId()-|selected="selected" |-/if-|>|-section name=space loop=$level-|&nbsp;&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select></p>	|-/if-|

|-else-|
<!--<p>
  <select id="postionDataZ[parentId]" name="positionDataZ[parentId]" title="parentId"> 
	|-if $position->getType() eq $configModule->get('positions','treeRootType') or empty($positions)-|
    <option value="0" selected="selected">Ninguna</option> 
	|-/if-|
	|-foreach from=$positions item=parent name=for_parent-|
   |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|" |-if $position->getParentId() eq $parent->getId()-|selected="selected" |-/if-|>|-section name=space loop=$level-|&nbsp;&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>
-->
|-/if-|
	<p>
	  <label for="positionData_name">Dependencia</label>
				<input name="positionData[name]" type="text" id="positionData_name" title="name" value="|-$position->getName()|escape-|" size="60" maxlength="150" class="emptyValidation"  /> |-validation_msg_box idField="positionData_name"-|
	</p>			
	<p><label for="positionData_internalCode">Código de Dependencia/Cargo</label>
				<input name="positionData[internalCode]" type="text" id="positionData_internalCode" title="Código de Dependencia" value="|-$position->getInternalCode()-|" size="15" maxlength="15" class="emptyValidation" /> |-validation_msg_box idField="positionData_internalCode"-|
	</p>
	<p><label for="positionData_ownerName">Nombre del Cargo</label>
				<input name="positionData[ownerName]" type="text" id="positionData_ownerName" title="Nombre del Cargo" value="|-$position->getOwnerName()-|" size="60" maxlength="150" class="emptyValidation" /> |-validation_msg_box idField="positionData_ownerName"-|
	</p>
|-if $configModule->get("positions","useFemale") eq "true"-|					
	<p><label for="positionData_ownerNameFemale">Nombre del Cargo (fem.)</label>
				<input name="positionData[ownerNameFemale]" type="text" id="positionData_ownerNameFemale" title="Nombre del Cargo" value="|-$position->getOwnerNameFemale()-|" size="60" maxlength="150" class="emptyValidation" />  |-validation_msg_box idField="positionData_ownerNameFemale"-|
	</p>
|-/if-|						
	<p><label for="positionData[address]">Dirección</label>
				<textarea name="positionData[address]" cols="60" rows="3" wrap="virtual" id="positionData[address]" title="Dirección">|-$position->getAddress()-|</textarea>
	</p>
	<p><label for="positionData[telephone]">Teléfonos</label>
				<input name="positionData[telephone]" type="text" id="positionData[telephone]" title="Teléfonos" value="|-$position->getTelephone()-|" size="60" maxlength="150" />
	</p>
	<p><label for="positionData[email]">Correo electrónico</label>
				<input name="positionData[email]" type="text" id="positionData[email]" title="Correo electrónico" value="|-$position->getEmail()-|" size="60" maxlength="150" />
	</p>
	
	<div id="userGroupInfo"|-if $position->getType() ne 9-| style="display:none;"|-/if-|>
		<p>
			<label for="positionData_userGroupId">Grupo de usuarios</label>
			<select id="positionData_userGroupId" name="positionData[userGroupId]" title="Seleccione el grupo de usuarios del ministerio" >
				<option class="noneSelected" value="0">Seleccione</option>
				|-foreach from=$userGroups item=userGroup-|
        			<option value="|-$userGroup->getId()-|" |-if $userGroup->getId() eq $position->getUserGroupId()-|selected|-/if-|>|-$userGroup->getName()-|</option>
				|-/foreach-|
      		</select>
		</p>
	</div>
		|-if !$show && !$showLog -|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>|-/if-|
	<p>	
	|-if $action eq "edit"-|
		<input type="hidden" name="id" id="id" value="|-$position->getId()-|" />
	|-/if-|
		<input type="hidden" name="action" id="action" value="|-$action-|" />
		<input type="hidden" name="do" id="do" value="positionsDoEdit" />
		<br />
		|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
		<input type="button" id="button_return_position" name="button_return_position" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=positionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
		<input type="hidden" name="positionData[type]" id="positionData[type]" value="|-$position->getType()-|" />
	</p>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
	</form>
		</fieldset>
</div>

|-if $action eq "edit"-|
	|-include file="PositionsIncludeTenureList.tpl"-|

	|-if $addTenure or $positionTenure->getId() ne ""-|
		|-include file="PositionsIncludeTenureEdit.tpl"-|
	|-/if-|
|-/if-|