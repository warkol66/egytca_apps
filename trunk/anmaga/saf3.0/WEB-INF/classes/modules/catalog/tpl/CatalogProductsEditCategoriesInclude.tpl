<div id="div_productCategories"> 
  <fieldset title="Agregar categorías al producto">
    <form name="form_edit_product_categories" id="form_edit_product_categories" action="Main.php" method="post" enctype="multipart/form-data">
      <p> 
        <label for="categoryId">Categoría</label> 
        <select name="categoryId" id="categoryId"> 
          <option value="">Seleccione Categoría</option> 
    	|-foreach from=$categoryCandidates item=category name=for_categories-|
        <option id="categoryOption|-$category->getId()-|" value="|-$category->getId()-|">|-$category->getName()-|</option> 
    	|-/foreach-|
        </select>
        <input type="button" id="button_edit_product_add_category" name="button_edit_product_add_category" title="Agregar" value="Agregar" onClick="javascript: catalogProductsDoAddCategoriesX(this.form)" /> 
        <span id="status_info"></span>
      </p>
      <p>
        <input type="hidden" id="productId" name="productId" value="|-$product->getId()-|" />
        <input type="hidden" id="do" name="do" value="catalogProductsDoAddCategoriesX" />
      </p>
    </form>
    <div id="productCategoriesList">
      |-include file="CatalogProductCategoriesListInclude.tpl"-|
    </div> 
  </fieldset> 
</div>


<script type="text/javascript" language="JavaScript" >

  function catalogProductsDoAddCategoriesX(form) {
    var fields = form.serialize();

    var myAjax = new Ajax.Updater(
      {success: 'productCategoriesList'},
      'Main.php?do=catalogProductsDoAddCategoriesX',
      {
        method: 'post',
        postBody: fields,
        evalScripts: true
      }
    );
    $('status_info').innerHTML = "<span class='inProgress'>Agregando a la categoría ...</span>";
  }

  function catalogProductsDoRemoveCategoriesX(form) {
    var fields = form.serialize();
    var myAjax = new Ajax.Updater(
      {success: 'productCategoriesList'},
      'Main.php?do=catalogProductsDoRemoveCategoriesX',
      {
        method: 'post',
        postBody: fields,
        evalScripts: true
      }
    );
    $('status_info').innerHTML = '<span class="inProgress">Eliminando de la categoría ...</span>';
  }
</script>