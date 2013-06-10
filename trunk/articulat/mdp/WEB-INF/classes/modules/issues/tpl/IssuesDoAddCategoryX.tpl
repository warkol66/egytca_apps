<script type="text/javascript" language="javascript" >
	$('categoryMsgField').innerHTML = '<span class="resultSuccess">Categoría Agregada</span>';
	option = $('categoryOption|-$category->getId()-|');
	if (option != null) {
		Element.remove('categoryOption|-$category->getId()-|');
	}
</script>

<li id="categoryListItem|-$category->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="issuesDoRemoveCategoryX" />
		<input type="hidden" name="issueId"  value="|-$issue->getId()-|" />
		<input type="hidden" name="categoryId"  value="|-$category->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:issuesRemoveCategory(this.form)" class="icon iconDelete" />
	</form>	|-$category->getName()-|
</li>
