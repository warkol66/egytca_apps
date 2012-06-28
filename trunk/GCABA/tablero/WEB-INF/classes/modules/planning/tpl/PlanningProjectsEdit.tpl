<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Proyectos - |-if !$planningProject->isNew()-|Editar|-else-|Crear|-/if-| Proyecto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Proyecto.</p>
<div id="div_project"> 
  |-include file="PlanningProjectsForm.tpl"-|
</div> 
|-if !$planningProject->isNew()-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningProjectsLogTabs&id=|-$planningProject->getId()-|'" />
|-/if-|
