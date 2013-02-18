<script type="text/javascript" src="scripts/lightbox.js"></script>

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
	<fieldset>
	<h1>Proyecto: |-$planningProject->getName()-|</h1>
	<h3>Listado y Gantt de actividades</h3>
	|-include file="PlanningActivitiesInclude.tpl" activities=$planningProject->getActivities() margin="false" add="false" -|
	<h3>Listado de obras</h3>
	|-include file="PanelConstructionsInclude.tpl" constructions=$planningProject->getPlanningConstructions()-|
	</fieldset>
</div>
|-else-|
	<h1>Administración de Proyectos</h1>
	<div class="errorMessage">El identificador del proyecto ingresado no es válido. Seleccione un proyecto de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
|-/if-|
