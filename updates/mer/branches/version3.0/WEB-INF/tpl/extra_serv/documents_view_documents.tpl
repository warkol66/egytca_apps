<form name="newDoc" method="post" action="Main.php?do=uploadFile" style="display:inline;">
                    Utilice este menu para ingresar a cada una de las diversas categorías existentes. Para subir un documento <b>dentro de esta categoria</b>, haga click sobre &quot;Nuevo Documento&quot;
                    <br><div align="center">
					<input type=hidden name="id" value="|-$docscategory-|">
                    <input name="new" type="submit" class="botonchico" id="newButton" value="Nuevo Documento"></div></form>

<br><br>

<table width="750"  border="1" align="center" cellpadding="0" cellspacing="0">

                <tr><td>Fecha</td><td>Descripcion del archivo</td>
                <tr> |-foreach from=$documents item=document name=document-|
				<tr>	
			<form name="documents" action="Main.php?do=viewFile" method="POST">				
					<td>|-$document->getDocumentdate()-|</td>
					<td>|-$document->getDescription()-|</td>
					<td><a href="|-$document->getFilename()-|">Ver archivo</a></td>
						<input type=hidden name="id" value="|-$document->getId()-|">
						<input type=hidden name="type" value="|-$document->getCategoryid()-|">
					<td>	<input type="submit" name="submit" value="Editar"></td>
			</form>
			<form name="documents" action="Main.php?do=doDeleteFile" method="POST">	
			<input type=hidden name="id" value="|-$document->getId()-|">
			<td><input type="submit" name="submit" value="Eliminar"></td></tr>
			</form>
			|-/foreach-|
</table>
