
<form name="newDoc" method="post" action="Main.php?do=uploadFile" style="display:inline;">
                    Utilice este menu para ingresar a cada una de las diversas categorías existentes. Para subir un documento, haga click sobre &quot;Nuevo Documento&quot;
                    <br><div align="center">
					<input type=hidden name="id" value="0">
                    <input name="new" type="submit" class="botonchico" id="newButton" value="Nuevo Documento"></div></form>

<br><br>

<table width="750"  border="1" align="center" cellpadding="0" cellspacing="0">

                    Utilice este menu para ingresar a cada una de las diversas categorías existentes. Para subir un documento haga click sobre &quot;Nuevo Documento&quot;
                    <br><tr><td>CATEGORIA</td><td>Ingresar</td></tr>|-foreach from=$categories item=category name=category-|
<form name="form" method="post" action="Main.php?do=viewDocuments" style="display:inline;">
					<tr>
					<td>|-$category->getName()-|</td>
					<td><input type=hidden name="id" value="|-$category->getId()-|">
					<input type="submit" name="submit" value="Ingresar"></td>
					</form>

					|-/foreach-|
</table>



            