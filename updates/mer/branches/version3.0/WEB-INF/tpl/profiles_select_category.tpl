<form method="get" action="Main.php">
	<input type="hidden" name="do" value="profilesSelectActor" />
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td class="titulo">##197,Caracterización de Actores##</td>
		</tr>
		<tr>
			<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class="fondotitulo">##198,Edición de Perfiles##</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class="texto">##199,En este módulo podrá definir el perfil de los Actores completando un cuestionario de caracterización para cada uno. Seleccione una categoría y se mostrarán los Actores correspondientes a la misma, luego seleccione un Actor para realizar la caracterización del mismo.##</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table class="tableTdBorders" border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr>
			<td class="celltitulo2" nowrap="nowrap" width="35%">##103,Seleccione una categoría##</td>
			<td class="celldato"><input name="modulo" value="contacto" type="hidden">
				<select name="catID" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" >
					|-html_options options=$categories-|
					<option value="" selected="selected">##103,Seleccione una categoría##</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="cellboton" colspan="2"><input value="##120,Continuar##" type="submit">
				&nbsp;&nbsp;
				<input onclick="history.go(-1)" value="##104,Regresar##" type="button"></td>
		</tr>
	</table>
</form>
