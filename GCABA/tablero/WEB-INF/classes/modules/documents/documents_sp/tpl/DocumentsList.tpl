<h2>Documentos</h2>
<h1>Lista de documentos disponibles</h1>
|-popup_init src="scripts/overlib.js"-|
<script>
function checkPass(form){
	if (form.password.value == "1") {
		password=window.prompt("Ingrese contraseÃ±a",'');
		if (!password) 
			return false;
		form.password.value = password;
	}
	return true;
}
</script>

<script>
function checkPassDelete(form){
	deleting=window.confirm("¿Está seguro que desea eliminar este archivo?");		
	if (!deleting) 
		return false;

	if (form.password.value == "1")	{
		password=window.prompt("Ingrese contraseÃ±a",'');
		if (!password) 
			return false;
		form.password.value = password;
	}
	return true;
}

</script>

<p>Utilice este menu para ingresar a cada una de las diversas categorías existentes.	|-if $moduleParameters.usePasswords.value eq 'YES'-| El (*) indica archivos protegidos por contraseña.|-/if-|</p>
|-if $message eq "errorFound"-|
	<div class="failureMessage">Error: No se ha podido realizar su accion</div>
|-elseif $message eq "wrongPassword"-|
	<div class="failureMessage">Se ha introducido la contraseña incorrectamente</div>
|-elseif $message eq "uploaded"-|
	<div class="successMessage">El documento fue subido satisfactoriamente</div> 
|-elseif $message eq "edited"-|
	<div class="successMessage">El documento fue editado satisfactoriamente</div> 
|-/if-|
<!--<p style="text-align:right;"><a href="javascript:void(null);" onClick="switch_vis('searchOptions','block');" class="searchLink">Buscar Documentos</a></p>
|-include file='DocumentsSearchDialogInclude.tpl'-| -->

|-if $filters eq ''-|
	|-if (isset($module))-|
		|-include file='DocumentsCategoriesListInclude.tpl' user=$user selectedModule=$selectedModule selectedCategory=$selectedCategory-|
	|-else-|
		|-include file='DocumentsCategoriesListInclude.tpl' user=$user generalParentCategories=$generalParentCategories categoryId=$categoryId documentsWithoutCategoryCount=$documentsWithoutCategoryCount modules=$modules-|
	|-/if-|
|-/if-|

|-if $documents neq ''-|
	<fieldset name="Listado de documentos disponibles">
		<legend>|-if $selectedCategory neq ''-|
			Documentos disponibles en la categoría |-$selectedCategory->getName()-|
		|-elseif $filters neq ''-|
			Documentos obtenidos de la búsqueda
		|-else-|
			Documentos disponibles
		|-/if-|</legend>
		<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders">
			<tr>
				<th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=documentsEdit&id=|-$docscategory-|" class="addLink">Agregar Documento</a></div></th>
			</tr>
			<tr>
				<th width="5%">Id</th>
				<th width="5%">Fecha</th>
				<th width="25%">Título</th>
				<th width="15%">Nombre</th>
				<th width="40%">Descripción</th>
				<th width="5%">&nbsp;</th>
			</tr>
			|-if $documents|@count eq 0-|
			<tr>
				<td colspan="6"> Aun no hay documentos en esta categoría</td>
			</tr>
			|-/if-|
			|-foreach from=$documents item=document name=document-|

			<tr valign="top">	
				<td nowrap="nowrap">|-$document->getId()-|</td>
				<td nowrap="nowrap">|-$document->getDocumentdate()|date_format:"%d-%m-%Y"-|</td>
				<td>|-$document->getTitle()-|</td>
				<td>
					|-$document->getRealfilename()-|
					|-if $document->getPassword() eq ""-||-else-|(*)|-/if-|				</td>
				<td>|-$document->getDescription()-|</td>
				<td nowrap="nowrap">
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
						<input type='submit' name='submit' value='Editar' class='buttonImageEdit' />
					</form>
					|-/capture-|
				|-if $document->getPassword() ne ""-|
					<input type="button" |-popup sticky='true' caption='Ingresar contraseña' trigger='onClick' text=$smarty.capture.formEdit snapx='10' snapy='10' width='180' height='25' border='2' closetext='Cerrar'-| value="Editar" class='buttonImageEdit' />
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
					<input type='submit' name='submit' value='Descargar' class='buttonImageDownload' />
				</form>
				|-/capture-|
				|-if $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="Ingresar contraseña" trigger="onClick" text=$smarty.capture.formDownload snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="Descargar" class='buttonImageDownload' />
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
					<input type='submit' name='submit' value='Eliminar' class='buttonImageDelete' />
				</form>
				|-/capture-|
				|-if $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="Ingresar contraseña" trigger="onClick" text=$smarty.capture.formDelete snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="Eliminar" class='buttonImageDelete' />
				|-else-|
					|-$smarty.capture.formDelete-|
				|-/if-|

				</td>
			</tr>
		|-/foreach-|
			<tr>
				<th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=documentsEdit&id=|-$docscategory-|" class="addLink">Agregar Documento</a></div></th>
			</tr>
		</table>
	</fieldset>
|-/if-|