<h2>##common,18,Configuración del Sistema##</h2>
<h1>##139,Editar dependencias##</h1>
<p>A continuación podrá editar las propiedades de la dependencia. Para cambiar el nombre modifique el texto y presione aceptar. 
|-if $category->isParent()-|
	Para modificar el módulo al que pertenece la dependencia, seleccione el módulo en la lista y haga click en &quot;Aceptar&quot; para guardar los cambios.
|-elseif $category->isChildren()-|
	Para modificar la dependencia de la dependencia, seleccione una de la lista y haga click en &quot;Aceptar&quot; para guardar los cambios.
|-/if-|
</p>
<fieldset title="Edición de dependencias del sistema">
<legend>Editar Dependencia</legend>
<form method='post'>
		<p>
			<label for="category[name]">Nombre</label>
		<input type="text" name="category[name]" id="name" value='|-$category->getName()-|' size="50" />
		</p>
		<p>
			<label for="category_responsible]">Funcionario a cargo</label>
			<input name="category[responsible]" type="text" id="category_responsible" title="Responsable a cargo" value="|-$category->getResponsible()-|" size="80" />
		</p>

	|-if $category->isChildren()-|
		<p><label for="category[parentId]">Dependencia de </label>
		<select name="category[parentId]">
			<option value="" |-if !$category->isChildren()-|selected="selected"|-/if-|>Ninguna</option>
					|-include file="CategoriesOptionsInclude.tpl" categories=$parentUserCategories user=$user count='0' selected=$category->getParentId() actual=$category->getId()-|
		</select></p>
	|-else-|
		<input type="hidden" name="category[parentId]" value="|-$category->getParentId()-|" id="parentId">
	|-/if-|
		<p>
		|-include file="HiddenInputsInclude.tpl" action="$action" filters="$filters" page="$page"-|
		<input type="hidden" name="id" id="id" value="|-$category->getId()-|" />
		<input type="hidden" name="action" id="action" value="|-$action-|" />
		<input type="hidden" name="do" id="do" value="categoriesDoEdit" />
		<input type="submit" value="##149,Aceptar##" />
		<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=categoriesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
		</p>
</form>

</fieldset>