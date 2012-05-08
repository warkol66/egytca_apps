<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Niveles de Usuarios</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $accion eq "edicion"-|
	<p class='paragraphEdit'>Realice los cambios en el nivel de usuarios y haga click en "Aceptar" para guardar las modificaciones.</p>
|-else-|
	<p>A continuación podrá editar la lista de niveles de usuarios.</p>
|-/if-|
|-if $message eq "deleted"-|
<div align='center' class='successMessage'>##181,Nivel de Usuarios eliminado##</div>
|-/if-|
|-if $message eq "errorUpdate"-|
<div align='center' class='errorMessage'>##182,Ha ocurrido un error al intentar guardar la información del nivel de usuarios##</div>
|-/if-|
|-if $message eq "saved"-|
<div align='center' class='successMessage'>##183,Nivel de Usuarios guardado##</div>
|-/if-|
|-if $message eq "blankName"-|
<div align='center' class='errorMessage'>##184,El Nivel de Usuarios debe tener un Nombre##</div>
|-/if-|
|-if $accion eq "edicion"-|
<form method='post' action='Main.php?do=affiliatesUsersLevelsDoEdit'>
	<input type='hidden' name='id' value='|-$currentLevel->getId()-|' />
	<table class='tablaborde' cellpadding='5' cellspacing='1'>
		<tr>
			<th colspan="2">##187,Editar nombre del Nivel ##</th>
		</tr>
		<tr>
			<td nowrap="nowrap" class='titulodato1'>##196,Nombre del Nivel##</td>
			<td><input name='name' type='text'  class='textodato' value='|-$currentLevel->getName()-|' size="70" /></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="accion" value="edicion" />
				<input type='submit' name='guardar' value='##97,Guardar##'  />
				&nbsp;&nbsp;
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##'  />
			</td>
		</tr>
	</table>
</form>
|-/if-| <br />
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<th width="90%" nowrap="nowrap">##194,Niveles de Usuarios del Sistema ##</th>
		<th width="10%" nowrap="nowrap">&nbsp;</th>
	</tr>
	|-foreach from=$levels item=level name=for_levels-|
	<tr>
		<td><div class='titulo2'>|-$level->getName()-|</div></td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=affiliatesUsersLevelsList&level=|-$level->getId()-|' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=affiliatesUsersLevelsDoDelete&level=|-$level->getId()-|' class='elim' onclick="return confirm('##256,Esta opción elimina permanentemente a este Nivel. ¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ] </td>
	</tr>
	|-/foreach-|
	<tr>
		<td colspan='2'><form action='Main.php' method='post'>
				##195,Agregar Nivel de Usuarios##&nbsp;&nbsp;
				<input type="hidden" name="do" value="affiliatesUsersLevelsDoEdit" />
				<input type="text" name="name" value="" />
				<input type='submit' value='##123,Agregar##' />
			</form></td>
	</tr>
</table>
