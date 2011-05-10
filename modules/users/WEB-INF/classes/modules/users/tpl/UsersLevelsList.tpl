<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Niveles de Usuarios</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $accion eq "edicion"-|
	<p>Realice los cambios en el nivel de usuarios y haga click en "Aceptar" para guardar las modificaciones.</p>
|-else-|
	<p>A continuación podrá editar la lista de niveles de usuarios.</p>
|-/if-|
|-if $message eq "deleted"-|
	<div class='successMessage'>##181,Nivel de Usuarios eliminado##</div>
|-elseif $message eq "errorUpdate"-|
	<div class='failureMessage'>##182,Ha ocurrido un error al intentar guardar la información del nivel de usuarios##</div>
|-elseif $message eq "saved"-|
	<div class='successMessage'>##183,Nivel de Usuarios guardado##</div>
|-elseif $message eq "blankName"-|
	<div class='failureMessage'>##184,El Nivel de Usuarios debe tener un Nombre##</div>
|-/if-|
|-if $accion eq "edicion"-|
<fieldset title="Formulario de edición de niveles de usuarios del sistema">
<legend>Editar nivel de usuario</legend>
<form method='post' action='Main.php?do=usersLevelsDoEdit'>
	<input type='hidden' name='id' value='|-$currentLevel->getId()-|' />
	<p>##187,Editar nombre del Nivel ##</p>
	<p><label for="name">##196,Nombre##</label>
			<input name='name' type='text' value='|-$currentLevel->getName()-|' size="45" />
		</p>
		<p><input type="hidden" name="accion" value="edicion" />
				<input type='submit' name='guardar' value='##97,Guardar##'  class='button' />
				&nbsp;&nbsp;
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' class='button'  />
			</p>
</form>
</fieldset>
|-/if-|
<br />
<fieldset title="Lista de niveles de usuarios del sistema">
<legend>Niveles de Usuarios</legend>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th width="98%" nowrap="nowrap">##194,Niveles de Usuarios del Sistema ##</th>
		<th width="2%">&nbsp;</th>
	</tr>
	|-foreach from=$levels item=level name=for_levels-|
	<tr>
		<td>|-$level->getName()-|</td>
		<td nowrap='nowrap'><a href='Main.php?do=usersLevelsList&level=|-$level->getId()-|' alt='##114,Editar##' title='##114,Editar##'><img src="images/clear.png" class="iconEdit"></a>
			|-if $level->getId() gt 3-|
			<a href='Main.php?do=usersLevelsDoDelete&level=|-$level->getId()-|' title='##115,Eliminar##' alt='##115,Eliminar##' onclick="return confirm('##256,Esta opción elimina permanentemente a este Nivel. ¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="iconDelete"></a>
			|-else-|
			<img src="images/clear.png" class="iconDelete disabled" title="No se puede eliminar." alt="No se puede eliminar.">
			|-/if-|</td>
	</tr>
	|-/foreach-|
	<tr>
		<td colspan='2'><form action='Main.php' method='post'>
				##195,Agregar Nivel de Usuarios##&nbsp;&nbsp;
				<input type="hidden" name="do" value="usersLevelsDoEdit" />
				<input type="text" name="name" value="" />
				<input type='submit' value='##123,Agregar##' class='button' />
			</form></td>
	</tr>
</table>
</fieldset>
