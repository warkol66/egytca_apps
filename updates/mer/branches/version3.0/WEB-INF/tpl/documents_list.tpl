|-popup_init src="scripts/overlib.js"-|
<script>
	function checkPass(form){
			if (form.password.value == "1")
			{
			password=window.prompt("Ingrese contraseña",'');
			if (!password) 
				return false;
			form.password.value = password;
	

			}
			return true;
	}
</script>


<script>
	function checkPassDelete(form){
			deleting=window.confirm("Esta seguro que desea eliminar este archivo?");		
			if (!deleting) 
				return false;

			if (form.password.value == "1")
			{
			password=window.prompt("Ingrese contraseña",'');
			if (!password) 
				return false;
			form.password.value = password;
			}
			return true;
	}


</script>

<form name="index"  method="get" action="Main.php" style="display:inline;">
                    Utilice este menu para ingresar a cada una de las diversas categorías existentes. Para subir un documento <b>dentro de esta categoria</b>, haga click sobre &quot;Nuevo Documento&quot;
					<br>(*)archivos protegidos por contraseña.
					|-if $message eq "errorFound"-|
						<br><br><b>Error: No se ha podido realizar su accion</b><br>
					|-elseif $message eq "wrongPassword"-|
						<br><br><b>Se ha introducido la contraseña incorrectamente</b><br>
					|-elseif $message eq "noError"-|
						<br><br><b>Se ha realizado su accion satisfactoriamente</b><br> 
					|-/if-|
                    <br>
					<div align="center">
						<input type="hidden" name="do" value="documentsUpload">
						<input type=hidden name="id" value="|-$docscategory-|">
						<input name="new" type="submit" class="botonchico" id="newButton" value="Nuevo Documento">
					</div>
</form>

<br><br>

<table width="750"  border="1" align="center" cellpadding="0" cellspacing="0">

                <tr><td>Fecha</td><td>Nombre del archivo</td><td>Descripcion del archivo</td><td></td></tr>
				|-foreach from=$documents item=document name=document-|
				
				<tr>	
					<td>|-$document->getDocumentdate()-|</td>
					<td>|-if $document->getPassword() eq ""-||-else-|(*)|-/if-|
						|-$document->getRealfilename()-|
					</td>
					<td>|-$document->getDescription()-|</td>
					<td>
					      |-assign var="documentId" value=$document->getId()-|
						  					      |-assign var="documentCategoryId" value=$document->getCategoryId()-|
												  					     |-if $document->getPassword() eq ""-|
																		 |-assign var="documentPassword" value=0-|
																		 |-else-|
																		 |-assign var="documentPassword" value=1-|

																		 |-/if-|

<!-- form de editar -->
						|-capture name=formEdit-|
						<form name='documents' action='Main.php?do=documentsEdit' style='display:inline;' method='POST'>
							<input type=hidden name='id' value='|-$document->getId()-|'>
							<input type=hidden name='category' value='|-$document->getCategoryid()-|'>

							|-if $document->getPassword() ne ''-|
							<input type='password' name='password' />
							|-/if-|
							<input type='submit' name='submit' value='Editar'>
						</form>
						|-/capture-|
|-if $document->getPassword() ne ""-|
						<input type="button" |-popup sticky=true caption="Ingresar contraseña" trigger="onClick" text=$smarty.capture.formEdit snapx=10 snapy=10-| value="Editar" />
|-else-|
|-$smarty.capture.formEdit-|
|-/if-|

<!-- form de descargar -->
						|-capture name=formDownload-|
						<form name='documents' action='Main.php?do=documentsDoDownload' style='display:inline;' method='POST'>
							<input type=hidden name='id' value='|-$document->getId()-|'>
							<input type=hidden name='category' value='|-$document->getCategoryid()-|'>

							|-if $document->getPassword() ne ''-|
							<input type='password' name='password' />
							|-/if-|
							<input type='submit' name='submit' value='Descargar'>
						</form>
						|-/capture-|
|-if $document->getPassword() ne ""-|
						<input type="button" |-popup sticky=true caption="Ingresar contraseña" trigger="onClick" text=$smarty.capture.formDownload snapx=10 snapy=10-| value="Descargar" />
|-else-|
|-$smarty.capture.formDownload-|
|-/if-|

<!-- form de eliminar -->
						|-capture name=formDelete-|
						<form name='documents' action='Main.php?do=documentsDoDelete' style='display:inline;' method='POST'>
							<input type=hidden name='id' value='|-$document->getId()-|'>
							<input type=hidden name='category' value='|-$document->getCategoryid()-|'>

							|-if $document->getPassword() ne ''-|
							<input type='password' name='password' />
							|-/if-|
							<input type='submit' name='submit' value='Eliminar'>
						</form>
						|-/capture-|
|-if $document->getPassword() ne ""-|
						<input type="button" |-popup sticky=true caption="Ingresar contraseña" trigger="onClick" text=$smarty.capture.formDelete snapx=10 snapy=10-| value="Eliminar" />
|-else-|
|-$smarty.capture.formDelete-|
|-/if-|

					</td>
				</tr>
			|-/foreach-|
</table>
