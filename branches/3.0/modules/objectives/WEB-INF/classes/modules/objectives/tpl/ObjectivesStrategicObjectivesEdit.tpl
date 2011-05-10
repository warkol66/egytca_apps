<script type="text/javascript" language="javascript" src="scripts/tablero.js"></script>
<h2>Tablero de Gestión
|-if isset($show)-|
 - <a href="Main.php?do=tableroStrategicObjectivesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de ##objectives,5,Objetivos Etratégicos## - |-if $action eq "edit"-|Editar|-else-|Crear|-/if-| ##objectives,2,Objetivo Etratégico##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->

|-if $action eq "showLog"-|
	<p class='paragraphEdit'>A continuación puede ver el historial de cambios del ##objectives,2,Objetivo Etratégico##.</p>
|-else-|
	<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el ##objectives,2,Objetivo Etratégico##.</p>
|-/if-|

|-if $action eq "showLog"-|
	<div id="tabsLogs" class="tabs">
		|-include file="ObjectivesStrategicObjectivesLogTabs.tpl"-|
	</div>
|-/if-|

<div id="div_objective"> 
	|-include file="ObjectivesStrategicObjectivesForm.tpl"-|
</div> 

