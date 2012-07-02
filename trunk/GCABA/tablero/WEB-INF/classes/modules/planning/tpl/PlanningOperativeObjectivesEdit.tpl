<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos Operativos - |-if !$operativeObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo Operativo</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo Operativo.</p>
<div id="div_objective"> 
  |-include file="PlanningOperativeObjectivesForm.tpl"-|
</div> 
|-if !$operativeObjective->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningOperativeObjectivesLogTabs&id=|-$operativeObjective->getId()-|'" />
|-/if-|
