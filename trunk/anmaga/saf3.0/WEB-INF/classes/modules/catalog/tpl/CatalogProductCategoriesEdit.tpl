<h2>Catálogo de Productos </h2>
	<h1>Administrar Categorías de Productos </h1>
	<p>A continuación podrá editar las categorías de productos disponibles en el sistema </p>
<div id="div_productcategory">
	<form name="form_edit_productcategory" id="form_edit_productcategory" action="Main.php" method="post" enctype="multipart/form-data">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la categoría de producto</span>|-/if-|
		|-if $loaded ne ""-|<span class="message_ok">Se han cargado |-$loaded-| productos en esta categoría</span>|-/if-|
		<p>Ingrese los datos de la categoría de producto</p>
		<fieldset title="Formulario de edición de datos de una categoria de producto">
     <legend>Categoría de Producto</legend>
		 		<p>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Categorías de Productos</p>
			<p>
				<label for="name">Categoría</label>
				<input type="text" id="name" name="category[name]" value="|-$category->getName()|escape-|" title="name" size="45" maxlength="255" />
			</p>
			<p>
				<label for="description">Descripción</label>
				<textarea name="category[description]" cols="45" rows="5" wrap="virtual" id="description">|-$category->getDescription()|escape-|</textarea>
			</p>
		<p>
			<label for="category[code]">Código</label>
		<input type="text" name="category[code]" id="code" value='|-$category->getCode()|escape-|' size="5" />
		</p>
			|-if $action eq "edit"-|
			<label for="actualImage">Imagen</label> 
		<div id="actualImage"> <img src="Main.php?do=catalogProductCategoriesGetImage&id=|-$category->getId()-|" alt="|-$category->getname()-|" />
		</div>
			|-/if-|
			<p>
				<label for="image">Cargar Imagen</label>
				<input type="file" id="image" name="image" title="image" />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$category->getid()-|" />
				|-/if-|
				<input type="hidden" name="category[module]" id="module" value="|-$category->getModule()-|" />
				<input type="hidden" name="category[scope]" id="scope" value="|-$category->getScope()-|" />
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="catalogProductCategoriesDoEdit" />
				<input type="submit" id="button_edit_productcategory" name="button_edit_productcategory" title="Aceptar" value="Aceptar" />
				<input type="button" id="return" name="return" title="Regresar" value="Regresar" onclick="location.href='Main.php?do=catalogProductCategoriesList'" />
			</p>
		</fieldset>
	</form>
	
	
	|-if $action eq "edit"-|
	<fieldset title="Administración de productos de la categoría">
     <legend>Admininstrar Productos de la Categoría</legend>
<form name="form_load_products" id="form_load_products" action="Main.php" method="post" enctype="multipart/form-data">
<p>
			<label for="csv">Cargar Archivo CSV en esta categoría:</label>
			<input type="file" name="csv" id="csv" />
</p>
<p>&nbsp;</p>
<p>
			<label>Opciones&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="radio" name="mode" value="1" title="Reemplaza los productos existentes con los que estén en el archivo ingresado" /> Reemplazar Catálogo de la Categoría
		<br>
    <em>&nbsp; &nbsp; &nbsp; &nbsp; (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)
    </em> </p>
		<p>
			<label>&nbsp;&nbsp;</label><input type="radio" name="mode" value="2" title="Actualiza la información de los productos existentes con la información presente en el archivo ingresado"/> Reemplazar Información de Productos con Códigos Existentes
		<br>
    <em>&nbsp; &nbsp; &nbsp; &nbsp; (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)
    </em> </p>
		<p>
			<label>&nbsp;&nbsp;</label><input type="radio" name="mode" value="3" checked="checked" title="Agrega sólo los productos nuevos que estén en el archivo ingresado sin afectar los anteriores"/> Solo Agregar Nuevos
		<br>
    <em>&nbsp; &nbsp; &nbsp; &nbsp; (Código; Nombre; Descripción; Precio[Separador decimal .]; Cateogría; Unidad)
    </em> </p>
		<p>
		<label>&nbsp;&nbsp;</label><input type="radio" name="mode" value="4" title="Actualiza el precio en los productos existentes con la información proveniente del archivo ingresado"/> Solo Actualizar Precios
			<br>
      <em>&nbsp; &nbsp; &nbsp; &nbsp; (Código; precio[Separador decimal .])</em></p>
		<p>
			<input type="hidden" name="parentCategoryId" id="parentCategoryId" value="|-$category->getId()-|" />
			<input type="hidden" name="do" id="do" value="catalogProductsDoLoadInCategory" />
			<input type="submit" value="Cargar" />
		</p>
	</form></fieldset>
	|-/if-|

</div>


