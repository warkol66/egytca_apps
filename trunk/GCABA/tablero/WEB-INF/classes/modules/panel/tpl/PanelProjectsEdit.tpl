<h2>Seguimiento
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($planningProject)-|
<h1>Seguimiento  de Proyectos - |-if !$planningProject->isNew()-|Editar|-else-|Crear|-/if-| Proyecto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>Responsable:</p>
<div id="div_project"> 
	|-include file="PannelActivitiesInclude.tpl" do="planningActivitiesList" list="planningActivityColl"-|
	|-include file="PanelConstructionsIncludeList.tpl" planningConstructionColl=$planningProject->getPlanningConstructions()-|
</div> 
|-if !$planningProject->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningProjectsLogTabs&id=|-$planningProject->getId()-|'" />
|-/if-|
|-else-|
	<h1>Administración de Proyectos</h1>
	<div class="errorMessage">El identificador del proyecto ingresado no es válido. Seleccione un proyecto de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
|-/if-|
