<form method='get' name='sel'>
	<table class='tablaborde' cellspacing='1' cellpadding='0' border='0' width='100%'>
		<tr>
			<td class='celltitulo' width='35%' nowrap><div class='titulo2'>##103,Seleccione una categoría##</div></td>
			<td class='celldato'><select name="category" onChange="document.sel.submit();">
					<option value="0">##103,Seleccione una categoría##</option>
								|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
								|-/foreach-|
				</select>
				<input type="hidden" name="do" value="|-$do-|" />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##120,Continuar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##'  class='boton' />
			</td>
		</tr>
	</table>
</form>
