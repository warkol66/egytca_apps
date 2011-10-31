<script>
function moreFields(cantidad) {
	for (var itr=0;itr<cantidad;itr++) {
		var newFields = document.getElementById('tr_add_in_category').cloneNode(true);
		var newField = newFields.childNodes[1];
		newField.childNodes[1].value = '';
		var insertHere = document.getElementById('tr_botones');
		insertHere.parentNode.insertBefore(newFields,insertHere);
	}
}
</script>
<h2>Configuración del Sistema</h2>
	<h1>Ingreso de Actores</h1>
	<p>En este formulario podrá ingresar los nombres de los actores con los que su organización mantiene algún tipo de relación. Puede optar por cargar los nombres solamente, en caso de tener a los actores categorizados, puede paras al formulario avanzado haciendo<a href="#actoresycategorias">click aquí</a>.</p>

<form name='form1' method='post' action='Main.php'>
<h3>Nombre de los Actores</h3>
<p>A continuación, ingrese los nombres de los Actores Clave de la Organización. Coloque un nombre en cada línea.</p>
	<table class='tableTdBorders' border='0' cellpadding='3' cellspacing='1' width='100%'>
		<tr>
			<td valign='top' colspan='2'><textarea class='textodato' name='listadogrueso' cols='50' rows='15' wrap='VIRTUAL'></textarea>
			</td>
		</tr>
		<tr>
			<td colspan='2'>Al terminar de ingresar los nombres pulse Guardar para generar el listado inicial de Actores</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoAddActors" />
				<input type='submit' name='guardarG' value='##97,Guardar##' >
				&nbsp;&nbsp;
				<input type="reset" name='Borrar' value='##98,Borrar todo##' >
			</td>
		</tr>
	</table>
</form>
<form method='post' action="Main.php">
<h3><a name='actoresycategorias'></a>Formulario Avanzado</h3>
<p>Utilice este formulario si tiene las categoras a asignar a cada uno de los Actores a ingresar. Ingrese un nombre en cada campo y asigne la categora correspondiente seleccionando de la lista, luego haga click en Guardar.</p>
	<table class='tableTdBorders' border='0' cellpadding='5' cellspacing='1' width="100%">
		<tr>
			<th>Nombre del Actor</th>
			<th>Categoría</th>
		</tr>
		|-section name=sectionCountActors loop=$countActors-|
		<tr>
			<td><input type='text' name='actors[]' value='' size='65' class='textodato'>
			</td>
			<td><select name="categories[]">
					<option value="0">Seleccione una categoría</option>
				|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
				|-/foreach-|
				</select>
			</td>
		</tr>
		|-/section-|
		<tr id="tr_add_in_category">
			<td><input type='text' name='actors[]' value='' size='65' class='textodato'>
			</td>
			<td><select name="categories[]">
					<option value="0">##103,Seleccione una categoría##</option>
				|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
				|-/foreach-|
				</select>
			</td>
		</tr>
		<tr id="tr_botones">
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoAddActorsWithCategory" />
				<input type='submit' value='##97,Guardar##' name='guardar' />
				<input type='button' value='##104,Regresar##' onClick='javascript:history.go(-1)' />
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
				<input type='button' value='##107,Agregar campos adicionales##' onClick="javascript:moreFields(document.getElementById('select_count').value)" />
			</td>
		</tr>
	</table>
</form>
