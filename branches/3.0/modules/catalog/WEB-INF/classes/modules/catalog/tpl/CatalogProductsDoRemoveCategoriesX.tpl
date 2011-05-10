|-include file="CatalogProductCategoriesListInclude.tpl"-|
<script type="text/javascript" language="JavaScript" >

  |-if $message eq "failure"-|
    $('status_info').innerHTML = "Ha ocurrido un error al intentar remover la categoria.";
    $('status_info').removeClassName("message_ok");
    $('status_info').addClassName("message_error");
  |-else if $message eq "success"-|
    $('status_info').innerHTML = "Categoria removida exitosamente.";
    $('status_info').removeClassName("message_error");
    $('status_info').addClassName("message_ok");
  |-/if-|
    
</script>