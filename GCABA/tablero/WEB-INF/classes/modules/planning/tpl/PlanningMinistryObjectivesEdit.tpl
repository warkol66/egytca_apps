<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($ministryObjective)-|
<h1>Administración de Objetivos Ministeriales - |-if !$ministryObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo Ministerial</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo Ministerial.</p>
<div id="div_objective"> 
  |-include file="PlanningMinistryObjectivesForm.tpl"-|
</div> 
|-if !$ministryObjective->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningMinistryObjectivesLogTabs&id=|-$ministryObjective->getId()-|'" />
|-/if-|
|-else-|
	<h1>Administración de Objetivos Ministeriales</h1>
	<div class="errorMessage">El identificador del objetivo ingresado no es válido. Seleccione un objetivo de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningMinistryObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos"/>
|-/if-|