<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos de Impacto - |-if !$impactObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo de Impacto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo de Impacto.</p>
<div id="div_objective"> 
  |-include file="PlanningImpactObjectivesForm.tpl"-|
</div> 

