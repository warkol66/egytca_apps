<script language="JavaScript" type="text/javascript">
function addRegionToObjective(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('regionMsgField').innerHTML = '<span class="inProgress">agregando región a ##objectives,3,Objetivo##...</span>';
	return true;
}

function deleteRegionFromObjective(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('regionMsgField').innerHTML = '<span class="inProgress">eliminando región de ##objectives,3,Objetivo##...</span>';
	return true;
}
function selectTab(anchorElement) {
	$$('#tabsLogs ul li.activeTab').each(function(e) {
		e.className = 'unactiveTab';
	});
	anchorElement.parentNode.className = 'activeTab';
}
</script>
<h2>Tablero de Gestión
|-if isset($show)-|
 - <a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de ##objectives,6,Objetivos## - |-if $action eq "edit"-|Editar|-elseif $action eq "showLog"-|Ver Historial del|-else-|Crear|-/if-| ##objectives,3,Objetivo##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $action eq "showLog"-|
	<p class='paragraphEdit'>A continuación puede ver el historial de cambios del ##objectives,3,Objetivo##.</p>
|-else-|
	<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el ##objectives,3,Objetivo##.</p>
|-/if-|
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el ##objectives,3,Objetivo##</div>
|-/if-|
<p><a href="#" onClick="javascript:history.go(-1)">Regresar</a></p>
|-if $action eq "showLog"-|
	<div id="tabsLogs" class="tabs">
		|-include file="ObjectivesLogTabs.tpl"-|
	</div>
|-/if-|
<div id="div_objective"> 
	|-include file="ObjectivesForm.tpl"-|
</div>

|-if $action ne "showLog"-| 
|-if isset($action) && ($action neq 'create')-|
|-if $moduleConfig.useCommunes.value == "YES"-|
<fieldset title="Formulario de edición de comunas">
	<legend>Comunas</legend>
<div id="CommuneAdding"> <span id="communeMsgField"></span> <br/>
  <form method="post"> 
      <select id="communeId" name="communeId" title="communeId" > 
	<option value="">Seleccione una Comuna</option>
				|-foreach from=$communes item=commune name=for_commune-|
        <option id="communeOption|-$commune->getId()-|" value="|-$commune->getId()-|" >|-$commune->getName()-|</option> 
				|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="tableroObjectivesDoAddCommuneX" /> 
      <input type="hidden" name="objectiveId" id="objectiveId" value="|-$objective->getId()-|" /> 
      <input type="button" value="Agregar Comuna al Proyecto" onClick="javascript:tableroAddCommuneToObjective(this.form)"/> 
  </form> 
  <p>
  <ul id="communeList">
     |-foreach from=$actualCommunes item=communeRel name=for_commune-| |-assign var=commune value=$communeRel->getTableroCommune()-|
    <li id="communeListItem|-$commune->getId()-|"> |-$commune->getName()-|
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="tableroObjectivesDoDeleteCommuneX" /> 
        <input type="hidden" name="objectiveId"  value="|-$objective->getId()-|" /> 
        <input type="hidden" name="communeId"  value="|-$commune->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteCommuneFromObjective(this.form)" class="buttonImageDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
  </p> 
</div>
</fieldset>
|-/if-|
|-if $moduleConfig.useRegions.value == "YES"-|
<fieldset title="Formulario de edición de barrios">
	<legend>Barrios</legend>
<div id="RegionAdding"> <span id="regionMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="regionId" name="regionId" title="regionId" > 
	<option value="">Seleccione una Región</option>
				|-foreach from=$regions item=region name=for_region-|
        <option id="regionOption|-$region->getId()-|" value="|-$region->getId()-|" >|-$region->getName()-|</option> 
				|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="tableroObjectivesDoAddRegionX" /> 
      <input type="hidden" name="objectiveId" id="objectiveId" value="|-$objective->getId()-|" /> 
      <input type="button" value="Agregar Barrio al Proyecto" onClick="javascript:tableroAddRegionToObjective(this.form)"/> 
    </p> 
  </form> 
  <ul id="regionList">
     |-foreach from=$actualRegions item=regionRel name=for_region-| |-assign var=region value=$regionRel->getTableroRegion()-|
    <li id="regionListItem|-$region->getId()-|">|-$region->getName()-|
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="tableroObjectivesDoDelRegionX" /> 
        <input type="hidden" name="objectiveId"  value="|-$objective->getId()-|" /> 
        <input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromObjective(this.form)" class="buttonImageDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-|

|-if $moduleConfig.useRegions.value == "YES"-|
<fieldset title="Formulario de edición de barrios">
	<legend>Localidades</legend>
<div id="RegionAdding"> <span id="regionMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="regionId" name="regionId" title="regionId" > 
	<option value="">Seleccione una Localidad</option>
				|-foreach from=$regionsN item=region name=for_region-|
        <option id="regionOption|-$region->getId()-|" value="|-$region->getId()-|" >|-$region->getName()-|</option> 
				|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="tableroObjectivesDoAddRegionX" /> 
      <input type="hidden" name="objectiveId" id="objectiveId" value="|-$objective->getId()-|" /> 
      <input type="button" value="Agregar Localidad al Proyecto" onClick="javascript:tableroAddRegionToObjective(this.form)"/> 
    </p> 
  </form> 
  <ul id="regionList">
     |-foreach from=$actualRegions item=regionRel name=for_region-| |-assign var=region value=$regionRel->getTableroRegion()-|
    <li id="regionListItem|-$region->getId()-|">|-$region->getName()-|
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="tableroObjectivesDoDelRegionX" /> 
        <input type="hidden" name="objectiveId"  value="|-$objective->getId()-|" /> 
        <input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromObjective(this.form)" class="buttonImageDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-|



|-if ($configModule->get("objectives","useRegions"))-|
<fieldset title="Formulario de edición de regiones asociadas al proyecto">
	<legend>Regiones</legend>
<div id="RegionAdding"> <span id="regionMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="regionId" name="regionId" title="regionId" > 
      <option value="">Seleccione una región</option>
				|-foreach from=$regions item=region name=for_region-|
        <option id="regionOption|-$region->getId()-|" value="|-$region->getId()-|" >|-section name=space loop=$region->getLevel()-|&nbsp; |-/section-||-$region->getName()-|</option> 
				|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="objectivesDoAddRegionX" /> 
      <input type="hidden" name="objectiveId" id="objectiveId" value="|-$objective->getId()-|" /> 
      <input type="button" value="Agregar región al proyecto" onClick="javascript:addRegionToObjective(this.form)"/> 
    </p> 
  </form> 
  <ul id="regionList">
     |-foreach from=$actualRegions item=regionRel name=for_region-| |-assign var=region value=$regionRel->getRegion()-|
    <li id="regionListItem|-$region->getId()-|">|-$region->getName()-|
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="objectivesDoDelRegionX" /> 
        <input type="hidden" name="objectiveId"  value="|-$objective->getId()-|" /> 
        <input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:deleteRegionFromObjective(this.form)" class="buttonImageDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-| 
|-/if-|


|-/if-| 
