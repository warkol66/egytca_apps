<h2>Caracterización de Actores</h2>
<h1>Edición de Perfiles</h1>
<p>En este módulo podrá definir el perfil de los Actores completando un cuestionario de caracterización para cada uno. Seleccione una categoría y se mostrarán los Actores correspondientes a la misma, luego seleccione un Actor para realizar la caracterización del mismo.</p>
<form method="get" action="Main.php">
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
		<input type="hidden" name="do" value="profilesActorSelect" />
				&nbsp;&nbsp;
				<input onclick="history.go(-1)" value="##104,Regresar##" type="button"></td>
		</tr>
	</table>
</form>
