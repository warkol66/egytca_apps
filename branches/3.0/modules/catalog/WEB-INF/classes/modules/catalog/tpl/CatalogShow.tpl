<h2>Catálogo de Productos</h2>
	<h1>Ver Catálogo</h1>
	<p>A continuación podrá ver los productos disponibles en el sistema </p>
|-if $productCategories|@count neq 0-|<div id="div_productcategories">
		<form action="Main.php" method="get"> 
				<label for="categoryId">Ver productos de</label> 
				<select name="categoryId" id="categoryId" onchange="this.form.submit();"> 
					<option value="">Seleccione una categoría</option> 
					<option value="">Sin categoría</option> 
						|-include file="CatalogProductCategoriesIncludeOptions.tpl" productCategories=$productCategories-|
				</select> 
				<input type="hidden" name="do" value="catalogShow" /> 
		</form> 
		|-if $category-|
			<h3>Catálogo de "|-$category->getName()-|"</h3>
		|-else-|
			<h3>Productos del Catálogo</h3>
		|-/if-|
	|-/if-|
	|-include file="CatalogShowIncludeProducts.tpl" products=$products-|
</div>