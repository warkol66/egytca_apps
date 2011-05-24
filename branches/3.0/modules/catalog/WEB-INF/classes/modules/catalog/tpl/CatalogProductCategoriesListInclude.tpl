|-if $product ne ''-|
  <table>
  |-foreach from=$product->getCategorys() item=category-|
    <tr>
      <td>
        |-$category->getName()-|
      </td>
      <td>
        <form action="Main.php" method="post" style="display:inline;"> 
          <input type="hidden" name="do" value="catalogProductsDoRemoveCategoriesX" /> 
          <input type="hidden" name="productId" value="|-$product->getid()-|" /> 
          <input type="hidden" name="categoryId" value="|-$category->getid()-|" /> 
          <input type="button" name="submit_go_remove_category" value="Borrar" onclick="if (confirm('Seguro que desea quitar la categoria?')) catalogProductsDoRemoveCategoriesX(this.form);" class="icon iconDelete" /> 
        </form>
      </td>
    </tr>
  |-/foreach-|
  </table>
|-/if-|

<script type="text/javascript" language="JavaScript" >

  function catalogProductsDoRemoveCategoriesX(form) {
    var fields = form.serialize();

    var myAjax = new Ajax.Updater(
      {success: 'productCategoriesList'},
      '/Main.php?do=catalogProductsDoRemoveCategoriesX',
      {
        method: 'post',
        postBody: fields,
        evalScripts: true
      }
    );
    $('status_info').innerHTML = "Procesando...";
  }

</script>