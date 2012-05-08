<script language="JavaScript" type="text/javascript">
function addRegionToProject(form) {
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
	$('regionMsgField').innerHTML = '<span class="inProgress">agregando región a ##projects,4,proyecto##...</span>';
	return true;
}

function deleteRegionFromProject(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('regionMsgField').innerHTML = '<span class="inProgress">eliminando región de ##projects,4,proyecto##...</span>';
	return true;
}
</script>
<h2>Tablero de Gestión |-if ($show)-| - <a href="Main.php?do=objectivesShow">|-$dependency->getName()-|</a> > |-$objective->getName()-||-/if-|</h2> 
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| ##projects,1,Proyecto##</h1> 
<!-- Link VOLVER --> 
<!-- /Link VOLVER --> 

|-if $action eq "showLog"-|
	<p class='paragraphEdit'>A continuación puede ver el historial de cambios del ##projects,4,proyecto##.</p>
|-else-|
	<p class='paragraphEdit'>A continuación puede |-if $action eq 'edit'-|editar|-else-|crear|-/if-| un ##projects,4,proyecto##.</p> 
|-/if-|

|-if $action eq "showLog"-|
	<div id="tabsLogs" class="tabs">
		|-include file="ProjectsLogTabs.tpl"-|
	</div>
|-/if-|

<div id="div_project"> 
  |-include file="ProjectsForm.tpl"-| 
</div> 

|-if $action ne "showLog"-|
|-if isset($action) and $action neq 'create'-|
|-if ($configModule->get("projects","useRegions"))-|
<fieldset title="Formulario de edición de regiones asociadas al ##projects,4,proyecto##">
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
      <input type="hidden" name="do" id="do" value="projectsDoAddRegionX" /> 
      <input type="hidden" name="projectId" id="projectId" value="|-$project->getId()-|" /> 
      <input type="button" value="Agregar región al proyecto" onClick="javascript:addRegionToProject(this.form)"/> 
    </p> 
  </form> 
  <ul id="regionList" class="optionDelete">
     |-foreach from=$actualRegions item=regionRel name=for_region-| |-assign var=region value=$regionRel->getRegion()-|
    <li id="regionListItem|-$region->getId()-|">
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="projectsDoDelRegionX" /> 
        <input type="hidden" name="projectId"  value="|-$project->getId()-|" /> 
        <input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
			  <input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar el vínculo con la región?')){deleteRegionFromProject(this.form)}; return false" class="icon iconDelete" /> 
     </form><span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$region->getName()-|</span>
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-|

<!-- Manejo de contratistas --> 
|-if $action eq 'edit' and $configModule->get("projects", "useContractors")-|
	|-include file="ProjectsContractorsListInclude.tpl"-|
|-/if-|

<!-- Manejo de documentos -->
|-if ($configModule->get("projects","useDocuments"))-|
	|-include file="DocumentsListInclude.tpl" entity="Project" entityId=$project->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="Project" entityId=$project->getId()-|
|-/if-| 
<!-- Fin manejo de documentos -->

<!-- Manejo de actos administrativos --> 
|-if $action eq 'edit' and $configModule->get("projects", "useAdministrativeActs")-|
	|-include file="ProjectsAdministrativeActsListInclude.tpl"-|
|-/if-|


|-/if-| 
|-/if-|
