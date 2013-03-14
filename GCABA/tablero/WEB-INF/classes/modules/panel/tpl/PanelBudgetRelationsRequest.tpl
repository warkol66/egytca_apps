<h2>Actualizar Partidas Presupuestarias</h2>

|-if $message eq "ok"-|
	<div id="successMessage">Partidas actualizadas correctamente</div>
|-/if-|

<!--form action="Main.php" method="post">
	<input type="hidden" name="do" value="panelBudgetRelationsDoRequest" />
	<input type="submit" name="submit_go_update" value="Actualizar" title="Actualizar partidas presupuestarias"/>
</form-->

<input type='button' onClick="location.href='Main.php?do=panelBudgetRelationsDoRequest'" value="Actualizar" title="Actualizar partidas presupuestarias"/>
