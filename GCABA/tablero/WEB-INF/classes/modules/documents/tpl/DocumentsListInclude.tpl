<div id="documentList" |-if $documents|@count gt 0-|style="display: block;"|-else-|style="display: none;"|-/if-|>
<fieldset name="Listado de documentos disponibles">
	<legend>
	|-if $selectedCategory neq ''-|
		##documents,29,Documentos disponibles en la categoría## |-$selectedCategory->getName()-|
	|-elseif $filters neq ''-|
		##documents,27,Documentos obtenidos de la búsqueda##
	|-else-|
		##documents,28,Documentos disponibles##
	|-/if-|
	</legend>
	<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders">
		<tr>
			<th width="5%">##documents,11,Fecha##</th>
			<th width="25%">##documents,12,Título##</th>
			<th width="15%">##documents,13,Nombre##</th>
			<th width="30%">##documents,14,Descripción##</th>
			|-if $configModule->get('documents','useAuthors')-|				
				<th width="10%">##documents,15,Autor(es)##</th>
			|-/if-|
			|-if $configModule->get('documents','useKeywords')-|
				<th width="10%">##documents,16,Palabra clave##</th>
			|-/if-|
			<th width="5%">&nbsp;</th>
		</tr>
		|-if $documents|@count eq 0-|
			<tr id="noDocuments">
				<td colspan="7"> Aun no hay publicaciones en esta categoría</td>
			</tr>
		|-/if-|
		|-foreach from=$documents item=document name=document-|
			<tr id="row_|-$document->getId()-|"valign="top">	
				<td nowrap="nowrap">|-$document->getDocumentdate()|date_format:"%m-%Y"-|</td>
				<td>|-$document->getTitle()-|</td>
				<td>|-$document->getRealfilename()-||-if $document->getPassword() eq ""-||-else-|(*)|-/if-|</td>
				<td>|-$document->getDescription()-|</td>
				|-if $configModule->get('documents','useAuthors')-|
					<td>|-$document->getAuthor()-|</td>
				|-/if-|
				|-if $configModule->get('documents','useKeywords')-|
					<td>|-$document->getKeywords()-|</td>
				|-/if-|
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
						<input type=hidden name='entity' value='|-$entity-|' />
						<input type=hidden name='entityId' value='|-$entityId-|' />

						|-if $usePasswords && $document->getPassword() ne ''-|
						<input type='password' name='password' />
						|-/if-|
						<input type='submit' name='submit' value='##common,1,Editar##' title='##common,1,Editar##' class='buttonImageEdit' />
					</form>
					|-/capture-|
				|-if $usePasswords && $document->getPassword() ne ""-|
					<input type="button" |-popup sticky='true' caption='Ingresar contraseña' trigger='onClick' text=$smarty.capture.formEdit snapx='10' snapy='10' width='180' height='25' border='2' closetext='Cerrar'-| value="value='##common,1,Editar##'" class='buttonImageEdit' />
				|-else-|
					|-$smarty.capture.formEdit-|
				|-/if-|

				<!-- form de descargar -->
				|-capture name=formDownload-|
				<form name='documents' action='Main.php?do=documentsDoDownload' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					<input type=hidden name='category' value='|-$document->getCategoryid()-|'>
					|-if $usePasswords && $document->getPassword() ne ''-|
					<input type='password' name='password' />
					|-/if-|
					<input type='submit' name='submit' value='##documents,22,Descargar##' title='##documents,25,Descargar##' class='buttonImageDownload' />
				</form>
				|-/capture-|
				|-if $usePasswords && $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="##documents,26,Ingresar contraseña##" trigger="onClick" text=$smarty.capture.formDownload snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="##documents,25,Descargar##" title='##documents,25,Descargar##' class='buttonImageDownload' />
				|-else-|
					|-$smarty.capture.formDownload-|
				|-/if-|

				<!-- form de eliminar -->
				|-capture name=formDelete-|
				<form name='documents' action='Main.php?do=documentsDoDelete' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|' />
					<input type=hidden name='entity' value='|-$entity-|' />
					<input type=hidden name='entityId' value='|-$entityId-|' />
					<input type=hidden name='category' value='|-$document->getCategoryid()-|'>

					|-if $usePasswords && $document->getPassword() ne ''-|
						<input type='password' name='password' />
					|-/if-|
					<input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='buttonImageDelete' onclick='if (confirm("¿Seguro que desea eliminar este documento?")){new Ajax.Updater("documentOperationInfo", "Main.php?do=documentsDoDeleteX", { method: "post", parameters: { id: "|-$document->getId()-|", entity: "|-$entity-|", entityId: "|-$entityId-|", category: "|-$document->getCategoryid()-|"}, evalScripts: true})}return false;' alt="Eliminar" />
				</form>
				|-/capture-|
				|-if $usePasswords && $document->getPassword() ne ""-|
					<input type="button" |-popup sticky=true caption="##documents,26,Ingresar contraseña##" trigger="onClick" text=$smarty.capture.formDelete snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="##common,2,Eliminar##" title="##common,2,Eliminar##" class='buttonImageDelete' />
				|-else-|
					|-$smarty.capture.formDelete-|
				|-/if-|

				</td>
			</tr>
	|-/foreach-|
	</table>
</fieldset>
</div>