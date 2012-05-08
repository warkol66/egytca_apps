<script type="text/javascript" language="javascript" src="scripts/tablero.js"></script>
<h2>Tablero de Gestión
|-if isset($show)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de ##objectives,4,Ejes de Gestión## - |-if $action eq "edit"-|Editar|-else-|Crear|-/if-| ##objectives,1,Eje de Gestión##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el ##objectives,1,Eje de Gestión##.</p>
<div id="div_objective"> 
  |-include file="ObjectivesPolicyGuidelinesForm.tpl" -|
</div> 

