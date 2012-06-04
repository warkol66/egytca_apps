<h2>Planificación
|-if isset($show)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos Ministeriales - |-if !$impactObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo Ministerial</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo Ministerial.</p>
<div id="div_objective"> 
  |-include file="PlanningMinistryObjectivesForm.tpl" -|
</div> 

