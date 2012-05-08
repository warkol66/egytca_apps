<script type="text/javascript" language="javascript" src="scripts/tablero.js"></script>
<h2>Tablero de Control
|-if isset($show)-|
 - <a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos - |-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Objetivo</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el objetivo.</p>
<div id="div_objective"> 
  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el objetivo</div>
		|-/if-|
    <p><a href="#" onClick="javascript:history.go(-1)">Regresar</a></p> 
    <fieldset title="Formulario de edición de datos de un objetivo">
     <legend>Ingrese los datos del objetivo</legend>
      <p>
        <label for="name">Nombre</label>
      <input name="name" type="text" id="name" size="80" value="|-if $action eq 'edit'-||-$objective->getname()-||-/if-|" title="name" maxlength="255" /> 
      </p>
     |-if ($loginUser neq "" and $loginUser->isAdmin() && $moduleConfig.useDependencies.value == "YES")-|<p>
      <label for="dependencyId">Dependencia</label>
      <select id="dependencyId" name="dependencyId" title="dependencyId" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|> 
				|-foreach from=$dependencies item=dependency name=for_valores-|
        <option value="|-$dependency->getId()-|" |-if $objective->getAffiliateId() eq $dependency->getId()-|selected="selected" |-/if-|>|-$dependency->getName()|truncate:75:"...":false-|</option> 
			|-/foreach-|
      </select> </p>
      |-elseif ($loginAffiliateUser neq "" || $useDependencies == "NO")-|
      <input type="hidden" name="dependencyId" value="|-$dependency->getId()-|"/> 
      |-/if-|  
     |-if ($strategicObjectives|@count) gt 0-|<p>
      <label for="strategicObjectiveId">Objetivo Estratégico</label>
      <select id="strategicObjectiveId" name="strategicObjectiveId" title="strategicObjectiveId"> 
			|-foreach from=$strategicObjectives item=strategicObjective name=for_strategicObjectives-|
        <option value="|-$strategicObjective->getId()-|" |-if $objective->getStrategicObjectiveId() eq $strategicObjective->getId()-|selected="selected" |-/if-|>|-$strategicObjective->getName()|truncate:75:"...":false-|</option> 
			|-/foreach-|
      </select> </p>
			|-/if-|
      <p><label for="description">Descripción</label>
      <textarea name="description" cols="70" rows="6" wrap="VIRTUAL" id="description" type="text">|-if $action eq "edit"-||-$objective->getdescription()|escape-||-/if-|</textarea> 
    </p> 
    <p> 
      <label for="date">Fecha</label> 
      <input name="date" type="text" id="date" title="date" value="|-if $action eq 'edit'-||-$objective->getdate()|date_format:"%d-%m-%Y"-||-/if-|" size="12" /> 
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
    <p> 
      <label for="expirationDate">Vencimiento</label> 
      <input type="text" id="expirationDate" name="expirationDate" value="|-if $action eq 'edit'-||-$objective->getexpirationDate()|date_format:"%d-%m-%Y"-||-/if-|" title="expirationDate" size="12" /> 
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('expirationDate', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
    <p>
      <label>Logrado</label> 
	<input type="checkbox" name="achieved" value="1" |-if $objective->getachieved() eq '1'-|checked="checked"|-/if-| />	
	
    </p> 
      <p>
        <label for="notes">Notas</label>
      <textarea name="notes" cols="70" rows="6" wrap="VIRTUAL" id="notes" type="text"  >|-$objective->getnotes()|escape-|</textarea> 
      </p>
    |-if $action eq "edit"-|
    <input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$objective->getid()-||-/if-|" /> 
    |-/if-|
    <input type="hidden" name="action" id="action" value="|-$action-|" /> 
    <input type="hidden" name="do" id="do" value="tableroObjectivesDoEdit" /> 
    <input type="submit" id="button_edit_objective" name="button_edit_objective" title="Aceptar" value="Aceptar" /> 
    </fieldset> 
    |-if isset($show)-|
    <input type="hidden" name="show" value="1"  /> 
    |-/if-|
  </form> 
</div> 
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
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteCommuneFromObjective(this.form)" class="icon iconDelete" /> 
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
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromObjective(this.form)" class="icon iconDelete" /> 
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
        <input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromObjective(this.form)" class="icon iconDelete" /> 
      </form> 
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-|

|-/if-| 
