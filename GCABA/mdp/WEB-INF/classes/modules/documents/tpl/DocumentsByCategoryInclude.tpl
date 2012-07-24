|-assign var=category value=$result.category-|
|-assign var=documents value=$result.documents-|

<script type="text/javascript" charset="utf-8">
	function submitForm(id) {
		var formName = 'file' + id;
		document.getElementById(formName).submit();
		return true;
	}
</script>

<div id="categoriesListPlaceHolder">
	<!--pedido de todos los módulos y categorías generales y documentos sin categorías -->
	<fieldset>
		<legend>Documentos en Categoría |-$category->getName()-|</legend>
		<ul>
		|-foreach from=$documents item=document name=for_documents-|
			|-if (not $document->isPasswordProtected())-|
			<li>
				<form id="file|-$document->getId()-|"action="Main.php?do=documentsDoDownload" method="post" >
					<input type="hidden" name="id" value="|-$document->getId()-|" id="do">
					<a onClick="javascript:submitForm(|-$document->getId()-|)">|-$document->getTitle()-|</a>
				</form>
			</li>
			
			|-/if-|
		|-/foreach-|
		</ul>
	</fieldset>
</div>
		