<h2>Catálogo de Productos </h2>
	<h1>Administrar Productos y Categorías de Productos </h1>
	<p>A continuación podrá editar los productos disponibles en el sistema </p>

<div id="div_productcategories">
	|-if $message eq "ok"-|<span class="message_ok">Product Category guardado correctamente</span>|-/if-|
	|-if $message eq "deleted_ok"-|<span class="message_ok">Product Category eliminado correctamente</span>|-/if-|
	|-if $loaded ne ""-|<span class="message_ok">Se han cargado |-$loaded-| productos</span>|-/if-|
	<h3><a href="Main.php?do=catalogProductCategoriesEdit">Agregar Categoría de Producto</a></h3>
<br>
	<form name="form_load_products" id="form_load_products" action="Main.php" method="post" enctype="multipart/form-data">
	<fieldset>
		<p>
			<label for="csv">Cargar Archivo CSV </label>
			<input name="csv" type="file" id="csv" size="45" />
</p>
			<ul><input type="radio" name="mode" value="1" />
				<strong>Reemplazar Catálogo</strong> (Reemplaza el catálogo completo!!!!!)
			<li>Formato de los datos debe ser (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)</li></ul>
<br />

			<ul><input type="radio" name="mode" value="2" />
			<strong>Reemplazar Información de Productos con Códigos Existentes</strong><br />
			<li>Formato de los datos debe ser (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)</li></ul>
<br />
			<ul><input type="radio" name="mode" value="3" checked="checked" />
			<strong>Solo Agregar Productos Nuevos</strong>
			<li>Formato de los datos debe ser (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)</li></ul>
<br />
			<ul><input type="radio" name="mode" value="4" /><strong>Solo Actualizar Precios</strong>
			<li>(Código; precio[Separador decimal .])</li></ul>
		<p>
			<input type="hidden" name="do" id="do" value="catalogProductsDoLoadWithCategory" />
			<input type="submit" value="Cargar" class="button" />
		</p>
	</fieldset>
	</form>
	|-if $productCategories|@count gt 0-|
	|-include file="CatalogProductCategoriesIncludeList.tpl" productCategories=$productCategories-|
	|-/if-|
</div>
