<h2>##common,18,Configuración del Sistema##</h2>
<h1>##139,Editar categorías##</h1>
<p>A continuación podrá editar las propiedades de la categoría. Para cambiar el nombre modifique el texto y presione aceptar. 
|-if $category->isParent()-|
	Para modificar el módulo al que pertenece la categoría, seleccione el módulo en la lista y haga click en &quot;Aceptar&quot; para guardar los cambios.
|-elseif $category->isChildren()-|
	Para modificar la dependencia de la categoría, seleccione una de la lista y haga click en &quot;Aceptar&quot; para guardar los cambios.
|-/if-|
</p>
<fieldset title="Edición de categorías del sistema">
<legend>Editar Categoría</legend>
<form method='post'>
		<p>
			<label for="category[name]">Nombre</label>
		<input type="text" name="category[name]" id="name" value='|-$category->getName()-|' size="50" />
		</p>
	|-if $category->isParent()-|
		<p><label for="category[module]">Módulo</label>
		<select name="category[module]">
			<option value='' |-if $category->getModule() eq ''-|selected="selected"|-/if-|>|-"Global"|multilang_get_translation:"common"-|</option>
		|-foreach from=$modules item=module-|
			<option value="|-$module->getName()-|" |-if $category->getModule() eq $module->getName()-|selected="selected"|-/if-|>|-$module->getName()|multilang_get_translation:"common"-|</option>
		|-/foreach-|
		</select>
		</p>
	|-else-|
		<input type="hidden" name="category[module]" value="|-$category->getModule()-|" id="categoryModule">
	|-/if-|

	|-if $category->isChildren()-|
		<p><label for="category[parentId]">Categoría de </label>
		<select name="category[parentId]">
			<option value="" |-if !$category->isChildren()-|selected="selected"|-/if-|>Ninguna</option>
					|-include file="CategoriesOptionsInclude.tpl" categories=$parentUserCategories user=$user count='0' selected=$category->getParentId() actual=$category->getId()-|
		</select></p>
	|-else-|
		<input type="hidden" name="category[parentId]" value="|-$category->getParentId()-|" id="parentId">
	|-/if-|
		<p><label for="category[isPublic]">Pública</label>
		<input type="hidden" name="category[isPublic]" value="0" />
		<input type="checkbox" name="category[isPublic]" value="1" |-if $category->getIsPublic() eq 1-| checked="checked" |-/if-| />
		</p>
		<input type="hidden" name="id" id="id" value="|-$category->getId()-|" />
		<input type="hidden" name="accion" id="accion" value="edicion" />
		<input type="hidden" name="do" id="do" value="categoriesDoEdit" />
		<input type='submit' name="ncat" value="##149,Aceptar##" class='button' />
		<input type='button' name="ncat" value="Regresar" class='button' onClick="history.back();"/>
</form>

</fieldset>