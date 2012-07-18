<h2>Planificación
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Obras - |-if !$planningConstruction->isNew()-|Editar|-else-|Crear|-/if-| Obra</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Obra.</p>
<div id="div_project"> 
  |-include file="PlanningConstructionsForm.tpl"-|
</div> 
|-if !$planningConstruction->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningConstructionsLogTabs&id=|-$planningConstruction->getId()-|'" />
|-/if-|
