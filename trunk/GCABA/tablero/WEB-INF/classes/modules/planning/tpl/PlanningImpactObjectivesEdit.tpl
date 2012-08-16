<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($impactObjective)-|
<h1>Administración de Objetivos de Impacto - |-if !$impactObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo de Impacto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo de Impacto.</p>
<div id="div_objective"> 
  |-include file="PlanningImpactObjectivesForm.tpl"-|
</div> 
|-if !$impactObjective->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningImpactObjectivesLogTabs&id=|-$impactObjective->getId()-|'" />
|-/if-|
|-else-|
	<h1>Administración de Objetivos de Impacto</h1>
	<div class="errorMessage">El identificador del objetivo ingresado no es válido. Seleccione un objetivo de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningImpactObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-/if-|