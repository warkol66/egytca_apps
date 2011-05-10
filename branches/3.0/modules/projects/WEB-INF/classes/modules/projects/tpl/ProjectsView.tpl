<script type="text/javascript" language="javascript" src="scripts/tablero.js"></script>
 <h2>Tablero de Gestión |-if ($show)-| - <a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a> > |-$objective->getName()-||-/if-|</h2> 
<h1>Detalle del  Proyecto: |-$project->getname()|escape-|</h1> 
<!-- Link VOLVER --> 
<!-- /Link VOLVER -->
<div id="div_project"> 
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
    <p><a href="#" onClick="javascript:history.go(-1)">Volver atras</a></p> 
    <fieldset title="Detalles del proyecto |-$project->getname()|escape-|"> 
     <legend>Proyecto</legend>
    <p>
      <label for="objectiveId">Objetivo</label> 
       |-$project->getObjective()-|</p> 
    <p> 
      <label for="name">Nombre</label>|-$project->getname()|escape-|
    </p> 
    <p> 
      <label for="description">Descripción</label>|-$project->getdescription()|escape-|
    </p> 
    <p> 
      <label for="impact">Impacto</label>|-$project->getimpact()|escape-|
    </p> 
    <p> 
      <label for="uniqueGoal">Meta</label>|-$project->getuniqueGoal()|escape-|
    </p> 
    <p> 
      <label for="goalExpirationDate">Vencimiento</label>|-$project->getgoalExpirationDate()|date_format:"%d-%m-%Y"-|
			</p> 
    <p> 
      <label for="budget">Presupuesto</label>|-$project->getbudget()-|
    </p> 
    <p> 
      <label for="coordinateNeed">Necesidad de Coordinación</label>|-$project->getcoordinateNeed()-|
    </p> 
    <p> 
      <label for="frequency">Frecuencia</label>|-$project->getfrequency()-|
    </p> 
    <p> 
      <label for="finished">Terminado</label> 
      <input type="checkbox" name="finished" readonly="readonly" value="1" |-if $project->getfinished() eq '1'-|checked="checked"|-/if-| /> </p> 
    </p> 
    <p> 
      <label for="notes">Notas</label>|-$project->getnotes()-|
    </p> 
|-if $moduleConfig.projects.useCoordinates.value == "YES"-|
    <p> 
      <label for="postalCode">Código Postal</label>|-$project->getpostalCode()-|
    </p> 
		<p>
			<label for="paramsProject[latitude]">Latitud</label>|-$project->getLatitude()|system_numeric_format:8-|
		</p>
		<p>
			<label for="paramsProject[longitude]">Longitud</label>|-$project->getLongitude()|system_numeric_format:8-|
		</p>
|-/if-|
    <p> 
      <label for="uniqueGoalNumeric">Meta Numérica</label>|-$project->getuniqueGoalNumeric()-|
    </p> 
    <p> 
      <label for="goalProgress">Progreso</label>|-$project->getgoalProgress()-|
    </p> 
    </fieldset> 
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
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteCommuneFromProject(this.form)" class="buttonImageDelete" /> 
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
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromProject(this.form)" class="buttonImageDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-| 
|-/if-| 
