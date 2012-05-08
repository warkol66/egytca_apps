<script type="text/javascript" language="javascript" src="scripts/tablero.js"></script>
 <h2>Tablero de Control |-if ($show)-| - <a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a> > |-$objective->getName()-||-/if-|</h2> 
<h1>|-if $action eq 'edit'-|Edita|-else-|Crear|-/if-| Proyecto</h1> 
<!-- Link VOLVER --> 
<!-- /Link VOLVER --> 
<p class='paragraphEdit'>A continuación puede |-if $action eq 'edit'-|Edita|-else-|Crear|-/if-| un Proyecto.</p> 
<div id="div_project"> 
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
     |-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el project</span>|-/if-|
    <p><a href="#" onClick="javascript:history.go(-1)">Volver atras</a></p> 
    <p>Ingrese los datos del Projecto.</p> 
    <fieldset title="Formulario de edición de datos de un project"> 
     <legend>Proyecto</legend>
    <p> |-if $loginUser neq "" and $loginUser->isAdmin()-|
      <label for="objectiveId">Objetivo</label> 
      <select id="objectiveId" name="objectiveId" title="objectiveId" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|> 
				|-foreach from=$objectives item=objective name=for_valores-|
        <option value="|-$objective->getId()-|" |-if $project->getobjectiveId() eq $objective->getId()-|selected="selected" |-/if-|>|-$objective->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      </select> 
      |-/if-| |-if $loginAffiliateUser neq ""-|
      <input type="hidden" name="objectiveId" value="|-$project->getobjectiveId()-|" /> 
      |-assign var=objective value=$project->getTableroObjective()-| |-/if-| </p> 
    <p> 
      <label for="name">Nombre</label> 
      <input name="name" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$project->getname()|escape-||-/if-|" size="80" maxlength="255" /> 
    </p> 
    <p> 
      <label for="description">Descripción</label> 
      <textarea name="description" cols="70" rows="6" wrap="VIRTUAL">|-if $action eq 'edit'-||-$project->getdescription()|escape-||-/if-|</textarea> 
    </p> 
    <p> 
      <label for="impact">Impacto</label> 
      <textarea name="impact" cols="70" rows="3" wrap="VIRTUAL">|-if $action eq 'edit'-||-$project->getimpact()|escape-||-/if-|</textarea> 
    </p> 
    <p> 
      <label for="uniqueGoal">Meta</label> 
      <textarea name="uniqueGoal" cols="70" rows="4" wrap="VIRTUAL">|-if $action eq 'edit'-||-$project->getuniqueGoal()|escape-||-/if-|</textarea> 
    </p> 
    <p> 
      <label for="goalExpirationDate">Vencimiento</label> 
      <input type="text" id="goalExpirationDate" name="goalExpirationDate" value="|-if $action eq 'edit'-||-$project->getgoalExpirationDate()|date_format:"%d-%m-%Y"-||-/if-|" title="goalExpirationDate" /> 
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('goalExpirationDate', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
    <p> 
      <label for="budget">Presupuesto</label> 
      <input type="text" id="budget" name="budget" value="|-if $action eq 'edit'-||-$project->getbudget()-||-/if-|" title="budget" /> 
    </p> 
    <p> 
      <label for="coordinateNeed">Necesidad de Coordinaci&oacute;n </label> 
      <textarea name="coordinateNeed" rows="4" cols="70">|-if $action eq 'edit'-||-$project->getcoordinateNeed()-||-/if-|</textarea> 
    </p> 
    <p> 
      <label for="frequency">Frecuencia</label> 
      <textarea name="frequency" rows="4" cols="70">|-if $action eq 'edit'-||-$project->getfrequency()-||-/if-|</textarea> 
    </p> 
    <p> 
      <label for="finished">Terminado</label> 
      <input type="checkbox" name="finished" value="1" |-if $project->getfinished() eq '1'-|checked="checked"|-/if-| /> </p> 
    </p> 
    <p> 
      <label for="notes">Notas</label> 
      <textarea name="notes" cols="70" rows="6" wrap="VIRTUAL">|-if $action eq 'edit'-||-$project->getnotes()-||-/if-|</textarea> 
    </p> 
|-if $moduleConfig.projects.useCoordinates.value == "YES"-|
    <p> 
      <label for="postalCode">Código Postal</label> 
      <input type="text" id="postalCode" name="postalCode" title="postalCode" maxlength="8" value="|-if $action eq 'edit'-||-$project->getpostalCode()-||-/if-|" /> 
    </p> 
		<p>
			<label for="paramsProject[latitude]">Latitud</label>
			<input name="paramsProject[latitude]" type="text" id="paramsProject[latitude]" title="latitude" value="|-if $action eq 'edit'-||-$project->getLatitude()|system_numeric_format:8-||-/if-|" size="20" />
		</p>
		<p>
			<label for="paramsProject[longitude]">Longitud</label>
			<input name="paramsProject[longitude]" type="text" id="paramsProject[longitude]" title="longitude" value="|-if $action eq 'edit'-||-$project->getLongitude()|system_numeric_format:8-||-/if-|" size="20" />
		</p>
|-/if-|
    <p> 
      <label for="uniqueGoalNumeric">Meta Numérica</label> 
      <input type="text" id="uniqueGoalNumeric" name="uniqueGoalNumeric" value="|-if $action eq 'edit'-||-$project->getuniqueGoalNumeric()-||-/if-|" title="uniqueGoalNumeric" /> 
    </p> 
    <p> 
      <label for="goalProgress">Progreso</label> 
      <input type="text" id="goalProgress" name="goalProgress" value="|-if $action eq 'edit'-||-$project->getgoalProgress()-||-/if-|" title="goalProgress" /> 
    </p> 
    <p> |-if $action eq 'edit'-|
      <input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$project->getid()-||-/if-|" /> 
      |-/if-|
      <input type="hidden" name="action" id="action" value="|-$action-|" /> 
      <input type="hidden" name="do" id="do" value="tableroProjectsDoEdit" /> 
      <input type="submit" id="button_edit_project" name="button_edit_project" title="Aceptar" value="Aceptar" /> 
    </p> 
    </fieldset> 
    |-if isset($show)-|
    <input type="hidden" name="show" value="1" /> 
    |-/if-|
  </form> 
</div> 
|-if isset($action) and $action neq 'create'-|
|-if $moduleConfig.useCommunes.value == "YES"-|
<fieldset title="Formulario de edición de comunas">
	<legend>Comunas</legend>
<div id="CommuneAdding"> <span id="communeMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="communeId" name="communeId" title="communeId" > 
      <option value="">Seleccione una Comuna</option>
                	|-foreach from=$communes item=commune name=for_commune-|
        <option id="communeOption|-$commune->getId()-|" value="|-$commune->getId()-|" >|-$commune->getName()-|</option> 
                	|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="tableroProjectsDoAddCommuneX" /> 
      <input type="hidden" name="projectId" id="projectId" value="|-$project->getId()-|" /> 
      <input type="button" value="Agregar Comuna al Proyecto" onClick="javascript:tableroAddCommuneToProject(this.form)"/> 
    </p> 
  </form> 
  <p>  
  <ul id="communeList">
     |-foreach from=$actualCommunes item=communeRel name=for_commune-| |-assign var=commune value=$communeRel->getCommune()-|
    <li id="communeListItem|-$commune->getId()-|"> |-$commune->getName()-|
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="tableroProjectsDoDeleteCommuneX" /> 
        <input type="hidden" name="projectId"  value="|-$project->getId()-|" /> 
        <input type="hidden" name="communeId"  value="|-$commune->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteCommuneFromProject(this.form)" class="icon iconDelete" /> 
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
      <option value="">Seleccione una Region</option>
                	|-foreach from=$regions item=region name=for_region-|
        <option id="regionOption|-$region->getId()-|" value="|-$region->getId()-|" >|-$region->getName()-|</option> 
                	|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="tableroProjectsDoAddRegionX" /> 
      <input type="hidden" name="projectId" id="projectId" value="|-$project->getId()-|" /> 
      <input type="button" value="Agregar Barrio al Proyecto" onClick="javascript:tableroAddRegionToProject(this.form)"/> 
    </p> 
  </form> 
  <ul id="regionList">
     |-foreach from=$actualRegions item=regionRel name=for_region-| |-assign var=region value=$regionRel->getTableroRegion()-|
    <li id="regionListItem|-$region->getId()-|">|-$region->getName()-|
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="tableroProjectsDoDelRegionX" /> 
        <input type="hidden" name="projectId"  value="|-$project->getId()-|" /> 
        <input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromProject(this.form)" class="icon iconDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-| 
|-/if-| 
