<h2>Seguimiento
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($planningConstruction)-|
<h1>Seguimiento de Obras - |-if !$planningConstruction->isNew()-|Editar|-else-|Crear|-/if-| Obra</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el Obra.</p>
<div id="div_project"> 
  |-include file="PlanningConstructionsForm.tpl" do="panelConstructionsDoEdit" list="panelConstructionsList"-|
	</div> 
|-if !$planningConstruction->isNew() && $readonly ne "readonly"-|
	<input type="button" title="Ver Historial de cambios" value="Ver Historia" onClick="location.href='Main.php?do=planningConstructionsLogTabs&id=|-$planningConstruction->getId()-|'" />
|-/if-|
|-else-|
	<h1>Administración de Obras</h1>
	<div class="errorMessage">El identificador de la obra ingresado no es válido. Seleccione una obra de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-/if-|
