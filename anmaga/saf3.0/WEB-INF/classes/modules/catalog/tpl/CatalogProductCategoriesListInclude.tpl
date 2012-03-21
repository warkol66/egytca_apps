|-if $product ne ''-|
  <table>
  |-foreach from=$product->getCategorys() item=category-|
    <tr>
      <td>
        <form action="Main.php" method="post" style="display:inline;"> 
          <input type="hidden" name="do" value="catalogProductsDoRemoveCategoriesX" /> 
          <input type="hidden" name="productId" value="|-$product->getid()-|" /> 
          <input type="hidden" name="categoryId" value="|-$category->getid()-|" /> 
          <input type="button" name="submit_go_remove_category" value="Borrar" onclick="if (confirm('Seguro que desea quitar la categoria?')) catalogProductsDoRemoveCategoriesX(this.form);" class="icon iconDelete" /> 
        </form>
      </td>
      <td>
        |-$category->getName()-|
      </td>
    </tr>
  |-/foreach-|
  </table>
|-/if-|
