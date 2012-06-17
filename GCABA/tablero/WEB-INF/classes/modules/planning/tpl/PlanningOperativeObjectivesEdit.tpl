<h2>Planificación
|-if isset($show)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos Operativos - |-if !$operativeObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo Operativo</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo Operativo.</p>
<div id="div_objective"> 
  |-include file="PlanningOperativeObjectivesForm.tpl" -|
</div> 

