<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Administración de Niveles de Usuarios</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>A continuación podrá editar la lista de niveles de usuarios.</td>
	</tr>
	<tr>
		<td class='texto'>&nbsp;</td>
	</tr>
	|-if $accion eq "edicion"-|
	<tr>
		<td class='texto'>Realice los cambios en el nivel de usuarios y haga click en "Aceptar" para guardar las modificaciones.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	|-/if-|
</table>
|-if $message eq "deleted"-|
<div align='center' class='textoerror'>##181,Nivel de Usuarios eliminado##</div>
|-/if-|
|-if $message eq "errorUpdate"-|
<div align='center' class='textoerror'>##182,Ha ocurrido un error al intentar guardar la información del nivel de usuarios##</div>
|-/if-|
|-if $message eq "saved"-|
<div align='center' class='textoerror'>##183,Nivel de Usuarios guardado##</div>
|-/if-|
|-if $message eq "blankName"-|
<div align='center' class='textoerror'>##184,El Nivel de Usuarios debe tener un Nombre##</div>
|-/if-|
|-if $accion eq "edicion"-|
<form method='post' action='Main.php?do=levelsDoEdit'>
	<input type='hidden' name='id' value='|-$currentLevel->getId()-|' />
	<table class='tablaborde' cellpadding='5' cellspacing='1'>
		<tr>
			<th colspan="2">##187,Editar nombre del Nivel ##</th>
		</tr>
		<tr>
			<td nowrap="nowrap" class='titulodato1'>##196,Nombre del Nivel##</td>
			<td class='celldato'><input name='name' type='text'  class='textodato' value='|-$currentLevel->getName()-|' size="70" /></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="accion" value="edicion" />
				<input type='submit' name='guardar' value='##97,Guardar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' class='boton'  />
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
		<td class='celldato'><div class='titulo2'>|-$level->getName()-|</div></td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=levelsList&level=|-$level->getId()-|' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=levelsDoDelete&level=|-$level->getId()-|' class='elim' onclick="return confirm('##256,Esta opción elimina permanentemente a este Nivel. ¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ] </td>
	</tr>
	|-/foreach-|
	<tr>
		<td class='celldato' colspan='2'><form action='Main.php' method='post'>
				##195,Agregar Nivel de Usuarios##&nbsp;&nbsp;
				<input type="hidden" name="do" value="levelsDoEdit" />
				<input type="text" name="name" value="" />
				<input type='submit' value='##123,Agregar##' class='boton' />
			</form></td>
	</tr>
</table>
