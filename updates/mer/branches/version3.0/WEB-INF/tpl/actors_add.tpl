<script>
function moreFields(cantidad)
{
	for (var itr=0;itr<cantidad;itr++) 
	{
		var newFields = document.getElementById('tr_add_in_category').cloneNode(true);
		var newField = newFields.childNodes[1];
		newField.childNodes[1].value = '';
		var insertHere = document.getElementById('tr_botones');
		insertHere.parentNode.insertBefore(newFields,insertHere);
	}
}
</script>
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
		<td class='fondotitulo'>##91,Ingreso de Actores## </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##92,En este formulario podrá ingresar los nombres de los actores con los que su organización mantiene algún tipo de relación. Puede optar por cargar los nombres solamente, en caso de tener a los actores categorizados, puede paras al formulario avanzado haciendo## <a href="#actoresycategorias">##93,click aquí##</a>.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<form name='form1' method='post' action='Main.php'>
	<table class='tablaborde' border='0' cellpadding='3' cellspacing='1' width='100%'>
		<tr>
			<th colspan='2'>##94,Nombre de los Actores## </th>
		</tr>
		<tr>
			<td colspan='2' class='celldato'><span class='texto'>##95,A continuación, ingrese los nombres de los Actores Clave de la Organización. Coloque un nombre en cada línea.##</span></td>
		</tr>
		<tr>
			<td class='celldato' valign='top' colspan='2'><textarea class='textodato' name='listadogrueso' cols='50' rows='15' wrap='VIRTUAL'></textarea>
			</td>
		</tr>
		<tr>
			<td class='celldato' colspan='2'> ##96,Al terminar de ingresar los nombres pulse Guardar para generar el listado inicial de Actores##</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoAddActors" />
				<input type='submit' name='guardarG' value='##97,Guardar##' class='boton' >
				&nbsp;&nbsp;
				<input type="reset" name='Borrar' value='##98,Borrar todo##' class='boton' >
			</td>
		</tr>
	</table>
</form>
<form method='post' action="Main.php">
	<table class='tablaborde' border='0' cellpadding='5' cellspacing='1' width="100%">
		<tr>
			<td class='celltitulo2' colspan='2'><a name='actoresycategorias'></a>##99,Formulario Avanzado##</td>
		</tr>
		<tr>
			<td colspan='2' class='celldato'><span class='texto'>##100,Utilice este formulario si tiene las categoras a asignar a cada uno de los Actores a ingresar. Ingrese un nombre en cada campo y asigne la categora correspondiente seleccionando de la lista, luego haga click en Guardar.##</span></td>
		</tr>
		<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
		</tr>
		|-section name=sectionCountActors loop=$countActors-|
		<tr>
			<td class='celldato'><input type='text' name='actors[]' value='' size='65' class='textodato'>
			</td>
			<td class='celldato'><select name="categories[]">
					<option value="0">##103,Seleccione una categoría##</option>
				|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
				|-/foreach-|
				</select>
			</td>
		</tr>
		|-/section-|
		<tr id="tr_add_in_category">
			<td class='celldato'><input type='text' name='actors[]' value='' size='65' class='textodato'>
			</td>
			<td class='celldato'><select name="categories[]">
					<option value="0">##103,Seleccione una categoría##</option>
				|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
				|-/foreach-|
				</select>
			</td>
		</tr>
		<tr id="tr_botones">
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoAddActorsWithCategory" />
				<input type='submit' value='##97,Guardar##' name='guardar'  class='boton' />
				<input type='button' value='##104,Regresar##' onClick='javascript:history.go(-1)'  class='boton' />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'> ##105,Ingresar##
				<select id="select_count">
					|-section name=addactors loop=29 start=1-|
					<option value="|-$smarty.section.addactors.index-|"> |-$smarty.section.addactors.index-| </option>
					|-/section-|
				</select>
				##106,actores más##&nbsp;&nbsp;
				<input type='button' value='##107,Agregar campos adicionales##' class='boton1' onClick="javascript:moreFields(document.getElementById('select_count').value)" />
			</td>
		</tr>
	</table>
</form>
