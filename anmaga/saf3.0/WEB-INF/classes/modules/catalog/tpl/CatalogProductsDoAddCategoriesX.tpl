|-include file="CatalogProductCategoriesListInclude.tpl"-|
<script type="text/javascript" language="JavaScript" >
  |-if $message eq "failure"-|
    $('status_info').innerHTML = "Ha ocurrido un error al intentar agregar la categoría.";
    $('status_info').removeClassName("resultSuccess");
    $('status_info').addClassName("resultFailure");
  |-else if $message eq "success"-|
    $('status_info').innerHTML = "Categoría agregada exitosamente.";
    $('status_info').removeClassName("resultFailure");
    $('status_info').addClassName("resultSuccess");
		option = $('categoryOption|-$category->getId()-|');
		if (option != null) {
			Element.remove('categoryOption|-$category->getId()-|');
		}
	|-/if-|
   
</script>