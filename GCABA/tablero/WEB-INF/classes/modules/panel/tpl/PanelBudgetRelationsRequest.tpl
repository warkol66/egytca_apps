<h2>Actualizar Partidas Presupuestarias</h2>

|-if $message eq "ok"-|
	<div id="successMessage">Partidas actualizadas correctamente</div>
|-/if-|

<input type='button' onClick="location.href='Main.php?do=panelBudgetRelationsDoRequest'" value="Actualizar" title="Actualizar partidas presupuestarias"/>
