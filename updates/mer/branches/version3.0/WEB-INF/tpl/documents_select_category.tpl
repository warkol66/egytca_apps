
<form name="newDoc" method="get" action="Main.php" style="display:inline;">
                    Utilice este menu para ingresar a cada una de las diversas categorías existentes. Para subir un documento, haga click sobre &quot;Nuevo Documento&quot;
                    <br>
					<div align="center">
						<input type="hidden" name="do" value="documentsUpload">
						<input name="new" type="submit" class="botonchico" id="newButton" value="Nuevo Documento">
					</div>
</form>

<br><br>

<table width="750"  border="1" align="center" cellpadding="0" cellspacing="0">
	<tr><td>CATEGORIA</td><td></td></tr>
	|-foreach from=$categories item=category name=category-|
<form name="form" method="get" action="Main.php" style="display:inline;">
	<tr>
		<td>|-$category->getName()-|</td>		
		<td><input type="hidden" name="do" value="documentsList">
			<input type="hidden" name="id" value="|-$category->getId()-|">
			<a href="Main.php?do=documentsList&id=|-$category->getId()-|">Ingresar</a>
		</td>
	</tr>
</form>

					|-/foreach-|
</table>



            