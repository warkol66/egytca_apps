<form action='Main.php' method='get'>
	<table class='tableTdBorders' cellspacing='0' cellpadding='0' border='0' width='100%'>
		<tr>
			<td nowrap="nowrap" width="35%" class="tdTitle2"><div class="textTitle2">##103,Seleccione una categoría##</div></td>
			<td width="65%"><select name="cat" onchange="if (this.options[this.selectedIndex].value) this.form.submit()">
					<option value="0">##103,Seleccione una categoría##</option>
					|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
					|-/foreach-|
				</select>
				<input type="hidden" name="do" value="|-$do-|" />
			</td>
		</tr>
		<tr>
			<td class='tdButton' colspan='2'><input type='submit' value='##150,Mostrar lista de Actores##' />
			</td>
		</tr>
	</table>
</form>
