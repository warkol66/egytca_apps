<h2>##documents,5,Documentos##</h2>
<h1>##documents,6,Lista de documentos disponibles##</h1>
|-popup_init src="scripts/overlib.js"-|
|-if ($configModule->get("documents","usePasswords"))-|<script>
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

</script>|-/if-|

<p>##documents,7,Utilice este menu para ingresar a cada una de las diversas categorías existentes.## |-if ($configModule->get("documents","usePasswords"))-|##documents,8,El (*) indica archivos protegidos por contraseña.##|-/if-|</p>
|-if $configModule->get('documents','useKeywords')-|<p>Para editar el listado de palabras clave, ingrese <a href="Main.php?do=documentsKeyWordList">aquí</a></p>|-/if-|
<div id="documentOperationInfo">
|-if $message eq "errorFound"-|
	<div class="failureMessage">Error: No se ha podido realizar su accion</div>
|-elseif $message eq "wrongPassword"-|
	<div class="failureMessage">Se ha introducido la contraseña incorrectamente</div>
|-elseif $message eq "uploaded"-|
	<div class="successMessage">El documento fue subido satisfactoriamente</div> 
|-elseif $message eq "edited"-|
	<div class="successMessage">El documento fue editado satisfactoriamente</div> 
|-/if-|
</div>
<p style="text-align:right;"><a href="javascript:void(null);" onClick="switch_vis('searchOptions','block');" class="searchLink">##documents,9,Buscar Documentos##</a></p>
|-include file='DocumentsSearchDialogInclude.tpl' do="documentsList"-|

|-if $filters eq ''-|
	|-if (isset($selectedModule))-|
		|-*include file='DocumentsCategoriesListInclude.tpl' user=$user selectedModule=$selectedModule selectedCategory=$selectedCategory*-|
			<form action="Main.php" method="get"><p><label for="category">Categoría</label>
				<select name="categoryId" onchange="this.form.submit();">
					<option value=''>Sin Categoría</option>
				|-include file="DocumentsCategoriesListSelectInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
					</select>
						<input type="hidden" name="do" value="documentsList" />
			</p></form>
	|-else-|
		|-*include file='DocumentsCategoriesListInclude.tpl' user=$user generalParentCategories=$generalParentCategories categoryId=$categoryId documentsWithoutCategoryCount=$documentsWithoutCategoryCount*-|
			<form action="Main.php" method="get"><p><label for="category">Categoría</label>
				<select name="categoryId" onchange="this.form.submit();">
					<option value=''>Sin Categoría</option>
				|-include file="DocumentsCategoriesListSelectInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
					</select>
						<input type="hidden" name="do" value="documentsList" />
			</p></form>
	|-/if-|
|-/if-|

|-if $documents neq ''-|
	<fieldset name="Listado de documentos disponibles">
		<legend>|-if $selectedCategory neq ''-|
			##documents,29,Documentos disponibles en la categoría## |-$selectedCategory->getName()-|
		|-elseif $filters neq ''-|
			##documents,27,Documentos obtenidos de la búsqueda##
		|-else-|
			##documents,28,Documentos disponibles##
		|-/if-|</legend>
		<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders">
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=documentsEdit&id=|-$docscategory-|" class="addLink" title="##documents,10,Agregar Documento##">##documents,10,Agregar Documento##</a></div></th>
			</tr>
			<tr>
				<th width="5%">##documents,11,Fecha##</th>
				<th width="25%">##documents,12,Título##</th>
				<th width="15%">##documents,13,Nombre##</th>
				<th width="30%">##documents,14,Descripción##</th>
|-if $configModule->get('documents','useAuthors')-|				<th width="10%">##documents,15,Autor(es)##</th>|-/if-|
|-if $configModule->get('documents','useKeywords')-|				<th width="10%">##documents,16,Palabra clave##</th>|-/if-|
				<th width="5%">&nbsp;</th>
			</tr>
			|-if $documents|@count eq 0-|
			<tr>
				<td colspan="7"> Aun no hay publicaciones en esta categoría</td>
			</tr>
			|-/if-|
			|-foreach from=$documents item=document name=document-|

			<tr id="row_|-$document->getId()-|"valign="top">	
				<td nowrap="nowrap">|-$document->getDocumentdate()|date_format:"%m-%Y"-|</td>
				<td>|-$document->getTitle()-|</td>
				<td>|-$document->getRealfilename()-||-if $document->getPassword() eq ""-||-else-|(*)|-/if-|</td>
				<td>|-$document->getDescription()-|</td>
|-if $configModule->get('documents','useAuthors')-|				<td>|-$document->getAuthor()-|</td>|-/if-|
|-if $configModule->get('documents','useKeywords')-|				<td>|-$document->getKeywords()-|</td>|-/if-|
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

						|-if ($configModule->get("documents","usePasswords")) && $document->getPassword() ne ''-|
						<input type='password' name='password' />
						|-/if-|
						<input type='submit' name='submit' value='##common,1,Editar##' title='##common,1,Editar##' class='iconEdit' />
					</form>
					|-/capture-|
				|-if ($configModule->get("documents","usePasswords")) && $document->getPassword() ne ""-|
					<input type="button" |-popup sticky='true' caption='Ingresar contraseña' trigger='onClick' text=$smarty.capture.formEdit snapx='10' snapy='10' width='180' height='25' border='2' closetext='Cerrar'-| value="value='##common,1,Editar##'" class='iconEdit' />
				|-else-|
					|-$smarty.capture.formEdit-|
				|-/if-|

				<!-- form de descargar -->
				|-capture name=formDownload-|
				<form name='documents' action='Main.php?do=documentsDoDownload' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					<input type=hidden name='category' value='|-$document->getCategoryid()-|'>
					|-if ($configModule->get("documents","usePasswords")) && $document->getPassword() ne ''-|
					<input type='password' name='password' />
					|-/if-|
					<input type='submit' name='submit' value='##documents,22,Descargar##' title='##documents,25,Descargar##' class='iconDownload' />
				</form>
				|-/capture-|
				|-if ($configModule->get("documents","usePasswords")) && $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="##documents,26,Ingresar contraseña##" trigger="onClick" text=$smarty.capture.formDownload snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="##documents,25,Descargar##" title='##documents,25,Descargar##' class='iconDownload' />
				|-else-|
					|-$smarty.capture.formDownload-|
				|-/if-|

				<!-- form de eliminar -->
				|-capture name=formDelete-|
				<form name='documents' action='Main.php?do=documentsDoDelete' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					<input type=hidden name='category' value='|-$document->getCategoryid()-|'>
					|-if ($configModule->get("documents","usePasswords")) && $document->getPassword() ne ''-|
						<input type='password' name='password' />
					|-/if-|
					<input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='iconDelete' onclick='if(confirm('¿Seguro que desea eliminar este documento?'))
					{new Ajax.Updater('documentOperationInfo', 'Main.php?do=documentsDoDeleteX', 
					{method: 'post', parameters: 
					{id: '|-$document->getId()-|', category: '|-$document->getCategoryid()-|'}, evalScripts: true})}return false;' alt='Eliminar' />
				</form>
				|-/capture-|
				|-if ($configModule->get("documents","usePasswords")) && $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="##documents,26,Ingresar contraseña##" trigger="onClick" text=$smarty.capture.formDelete snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="##common,2,Eliminar##" title="##common,2,Eliminar##" class='iconDelete' />
				|-else-|
					|-$smarty.capture.formDelete-|
				|-/if-|

				</td>
			</tr>
		|-/foreach-|
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=documentsEdit&id=|-$docscategory-|" class="addLink" title="##documents,10,Agregar Documento##">##documents,10,Agregar Documento##</a></div></th>
			</tr>
		</table>
	</fieldset>
|-/if-|