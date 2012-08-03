<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $positionVersion->getId() ne ""-|Editar|-else-|Crear|-/if-| Posición</h1>

|-if $message eq "corruptTree"-|
	<div class="failureMessage">El arbol de cargos esta corrupto. Contáctese con su administrador</div>
|-/if-|

<div id="positionsVersionEdit">
|-include file="PositionsIncludeVersionEdit.tpl"-|
</div>