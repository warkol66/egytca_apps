<h2>Catálogo de Productos </h2>
<h1>Administrar Productos y Categorías de Productos </h1>
<p>A continuación podrá editar los productos disponibles en el sistema </p>
<div id="div_productcategories"> |-if $message eq "ok"-|
  <div class="successMessage">Categoría de producto guardada correctamente</div> 
  |-elseif $message eq "deleted_ok"-|
  <div class="successMessage">Categoría de producto eliminada correctamente</div> 
  |-/if-| |-if $loaded ne ""-|
  <div class="successMessage">Se han cargado |-$loaded-| productos</div> 
  |-/if-|
  <form name="form_load_products" id="form_load_products" action="Main.php" method="post" enctype="multipart/form-data"> 
    <fieldset title="Formulario de actualización de productos de catálogo"> 
    <legend>Admininstración de Catálogo de Productos</legend> 
    <p> 
      <label for="csv">Cargar Archivo CSV </label> 
      <input name="csv" type="file" id="csv" size="45" /> 
    </p> 
    <ul> 
      <input type="radio" name="mode" value="1" /> 
      <strong>Reemplazar Catálogo</strong> <span class="alert">(Reemplaza el catálogo completo!!!!!)</span> 
      <li>Formato de los datos debe ser (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)</li> 
    </ul> 
    <br /> 
    <ul> 
      <input type="radio" name="mode" value="2" /> 
      <strong>Reemplazar Información de Productos con Códigos Existentes</strong> 
      <li>Formato de los datos debe ser (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)</li> 
    </ul> 
    <br /> 
    <ul> 
      <input type="radio" name="mode" value="3" checked="checked" /> 
      <strong>Solo Agregar Productos Nuevos</strong> 
      <li>Formato de los datos debe ser (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)</li> 
    </ul> 
    <br /> 
    <ul> 
      <input type="radio" name="mode" value="4" /> 
      <strong>Solo Actualizar Precios</strong> 
      <li>(Código; precio[Separador decimal .])</li> 
    </ul> 
    <p>&nbsp;</p> 
    <p> 
      <input type="hidden" name="do" id="do" value="catalogProductsDoLoadWithCategory" /> 
      <input type="submit" value="Cargar" /> 
    </p> 
    </fieldset> 
  </form> 
  <table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
    <tr> 
      <th><div class="rightLink"><a href="Main.php?do=catalogProductCategoriesEdit" class="addLink">Agregar Categoría de Producto</a></div></th> 
    </tr> 
  </table> 
  |-if $productCategories|@count gt 0-| |-include file="CatalogProductCategoriesIncludeList.tpl" productCategories=$productCategories-| |-/if-| </div>
