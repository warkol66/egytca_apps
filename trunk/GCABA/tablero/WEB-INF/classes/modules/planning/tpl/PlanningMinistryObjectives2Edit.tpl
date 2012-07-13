<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos Ministeriales - |-if !$ministryObjective->isNew()-|Editar|-else-|Crear|-/if-| Objetivo Ministerial</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Objetivo Ministerial.</p>
<div id="div_objective"> 
  |-include file="PlanningMinistryObjectives2Form.tpl"-|
</div> 
|-if !$ministryObjective->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningMinistryObjectivesLogTabs&id=|-$ministryObjective->getId()-|'" />
|-/if-|
