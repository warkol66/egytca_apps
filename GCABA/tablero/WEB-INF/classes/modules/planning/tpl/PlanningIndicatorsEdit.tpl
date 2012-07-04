<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Indicadores - |-if !$planningIndicator->isNew()-|Editar|-else-|Crear|-/if-| Indicador</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Indicador.</p>
<div id="div_indicator"> 
  |-include file="PlanningIndicatorsForm.tpl"-|
</div> 
