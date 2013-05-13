|-popup_init src="scripts/overlib.js"-|
<div id="contentBody">
	<div id=titleContent>
		<h1>##documents,5,Documentos##</h1>
	</div>
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
<p>En esta sección encontrará los documentos de trabajo de las sesiones desarrolladas en Seminarios y encuentros de líderes de parroquias rurales. |-if $usePasswords-|El (*) indica archivos protegidos por contraseña.|-/if-|</p>
<p style="text-align:right;"><a href="javascript:void(null);" onClick="switch_vis('searchOptions','block');" class="searchLink">Buscar Documentos</a></p>
|-include file='DocumentsSearchDialogInclude.tpl' do="documentsShow"-|
|-if $filters eq ''-|
	|-if (isset($module))-|
		|-*include file='DocumentsShowCategoriesInclude.tpl' user=$user selectedModule=$selectedModule selectedCategory=$selectedCategory*-|
					|-if $parentCategories|count gt 0-|<form action="Main.php" method="get"><p><label for="category">Categoría</label>
				<select name="categoryId" onchange="this.form.submit();">
					<option value=''>Sin Categoría</option>
				|-include file="DocumentsCategoriesListSelectInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
					</select>
						<input type="hidden" name="do" value="documentsShow" />
			</p></form>|-/if-|
	|-else-|
		|-*include file='DocumentsShowCategoriesInclude.tpl' user=$user generalParentCategories=$generalParentCategories categoryId=$categoryId documentsWithoutCategoryCount=$documentsWithoutCategoryCount*-|
					|-if $parentCategories|count gt 0-|<form action="Main.php" method="get"><p><label for="category">Categoría</label>
				<select name="categoryId" onchange="this.form.submit();">
					<option value=''>Sin Categoría</option>
				|-include file="DocumentsCategoriesListSelectInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
					</select>
						<input type="hidden" name="do" value="documentsShow" />
			</p></form>|-/if-|
	|-/if-|
|-/if-|
|-if $documents neq ''-|
		<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders">
			<tr>
			<th colspan="6" class="thFillTitle">|-if $selectedCategory neq ''-|
			Documentos disponibles en la categoría |-$selectedCategory->getName()-|
		|-elseif $filters neq ''-|
			Documentos obtenidos de la búsqueda
		|-else-|
			Documentos disponibles
		|-/if-|</th>
			</tr>
			<tr>
				<th width="3%">##documents,11,Fecha##</th>
				<th width="25%">##documents,12,Título##</th>
				<th width="56%">##documents,14,Descripción##</th>
				<th width="15%">##documents,15,Autor(es)##</th>
				<th width="1%">&nbsp;</th>
			</tr>
			|-if $documents|@count eq 0-|
			<tr>
				<td colspan="5"> Aun no hay documentos en esta categoría</td>
			</tr>
			|-/if-|
			|-foreach from=$documents item=document name=document-|
			<tr valign="top">	
				<td nowrap="nowrap">|-$document->getDocumentdate()|date_format:"%m-%Y"-|</td>
				<td>|-$document->getTitle()-|</td>
				<td>|-$document->getDescription()-|</td>
				<td>|-$document->getAuthor()-|</td>
				<td nowrap="nowrap">
					|-assign var="documentId" value=$document->getId()-|
					|-assign var="documentCategoryId" value=$document->getCategoryId()-|
					|-if $document->getPassword() eq ""-|
					 |-assign var="documentPassword" value=0-|
					|-else-|
					 (*)|-assign var="documentPassword" value=1-|
					|-/if-|
				<!-- form de descargar -->
				|-capture name=formDownload-|
				<form name='documents' action='Main.php?do=documentsDoDownload' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					<input type=hidden name='category' value='|-$document->getCategoryid()-|'>
					|-if $document->getPassword() ne ''-|
					<input type='password' name='password' title='Ingrese la contraseña para descargar' />
					|-/if-|
					<input type='submit' name='submit' value='Descargar' class='icon iconDownload' title='descargar' />
				</form>
				|-/capture-|
				|-if $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="Ingresar contraseña" trigger="onClick" text=$smarty.capture.formDownload snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="Descargar" class='icon iconDownload' title='descargar' />
				|-else-|
					|-$smarty.capture.formDownload-|
				|-/if-|
				</td>
			</tr>
		|-/foreach-|
		</table>
|-/if-|
</div>