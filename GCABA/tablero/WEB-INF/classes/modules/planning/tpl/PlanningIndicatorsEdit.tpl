<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($planningIndicator)-|
<h1>Administración de Indicadores - |-if !$planningIndicator->isNew()-|Editar|-else-|Crear|-/if-| Indicador</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Indicador.</p>
<div id="div_indicator"> 
  |-include file="PlanningIndicatorsForm.tpl"-|
</div> 
|-else-|
	<h1>Administración de Indicadores</h1>
	<div class="errorMessage">El identificador del indicador ingresado no es válido. Seleccione un indicador de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningIndicatorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Indicadores"/>
|-/if-|