|-if $entity ne ""-|
	<tr id="row_|-$document->getId()-|" valign="top">
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
				<input type='submit' name='submit' value='##common,1,Editar##' title='##common,1,Editar##' class='icon iconEdit' />
			</form>
		|-/capture-|
		|-if $usePasswords && $document->getPassword() ne ""-|
			<input type="button" |-popup sticky='true' caption='Ingresar contraseña' trigger='onClick' text=$smarty.capture.formEdit snapx='10' snapy='10' width='180' height='25' border='2' closetext='Cerrar'-| value="value='##common,1,Editar##'" class='icon iconEdit' />
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
				<input type='submit' name='submit' value='##documents,22,Descargar##' title='##documents,25,Descargar##' class='icon iconDownload' />
			</form>
		|-/capture-|
		|-if $usePasswords && $document->getPassword() ne ""-|
			<input type="button" |-popup sticky=true caption="##documents,26,Ingresar contraseña##" trigger="onClick" text=$smarty.capture.formDownload snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="##documents,25,Descargar##" title='##documents,25,Descargar##' class='icon iconDownload' />
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
				<input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='icon iconDelete' onclick='if (confirm("¿Seguro que desea eliminar este documento?")){new Ajax.Updater("documentOperationInfo", "Main.php?do=documentsDoDeleteX", { method: "post", parameters: { id: "|-$document->getId()-|", entity: "|-$entity-|", entityId: "|-$entityId-|", category: "|-$document->getCategoryid()-|"}, evalScripts: true})}return false;' alt="Eliminar" />
			</form>
		|-/capture-|
		|-if $usePasswords && $document->getPassword() ne ""-|
			<input type="button" |-popup sticky=true caption="##documents,26,Ingresar contraseña##" trigger="onClick" text=$smarty.capture.formDelete snapx=10 snapy=10 width='180' closetext='Cerrar'-| value="##common,2,Eliminar##" title="##common,2,Eliminar##" class='icon iconDelete' />
		|-else-|
			|-$smarty.capture.formDelete-|
		|-/if-|
	
		</td>
	
	</tr>
|-else-|
	<p>
		|-$message-|
	</p>
|-/if-|
