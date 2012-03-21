<h2>##common,18,Configuración del Sistema##</h2>
<h1>##139,Editar categorías##</h1>
|-if $message eq "notdeleted"-|<div class='errorMessage'>##140,No se pudo eliminar la categoría porque posee datos asociados##.</div>|-/if-|
<p>##141,A continuación podrá editar la lista de categorías disponibles. Podrá Agregar, Modificar o Eliminar categorías de la lista de categorías disponibles. Sólo podrá eliminar las categorías que no tengan ningún dato asignado.##</p>
<form method='get' action="Main.php" id="form_category_list" style="display:inline;">
	<input type="hidden" name="do" value="categoriesList" />
	<fieldset title="Edición de categorías del sistema">
	<legend>Categorías del Sistema</legend>
			<p><label for="filters[searchModule]">Módulo</label>
			<select name="filters[searchModule]">
				<option value="all" |-if isset($filters.searchModule) and ($filters.searchModule eq 'all')-| selected="selected" |-/if-|>|-"-- Seleccione uno --"|multilang_get_translation:"common"-|</option>
				<option value="" |-if isset($filters.searchModule) and $filters.searchModule eq ''-| selected="selected" |-/if-|>|-"Global"|multilang_get_translation:"common"-|</option>
			|-foreach from=$modules item=moduleObj-|
				<option value="|-$moduleObj->getName()-|" |-if isset($filters.searchModule) and ($moduleObj->getName() eq $filters.searchModule)-|selected="selected"|-/if-|>|-$moduleObj->getName()|multilang_get_translation:"common"-|</option>
			|-/foreach-|
			</select>
			<input type='submit' name="ncat" value="Mostrar categorías" />
			</p>
<br />

		<div id="categoriesListPlaceHolder">
		|-if $parentUserCategories|@count gt 0-|
			<p>Categorías del módulo</p>
			|-include file="CategoriesListInclude.tpl" categories=$parentUserCategories-|
		|-else-|
			<ul>
				<li>El módulo no tiene categorías asociadas</li>
			</ul>
		|-/if-|
		</div>
	</fieldset>
</form>

<form method='post' action="Main.php" id="form_category_add" style="display:inline;">
<fieldset title="Formulario de categorías del sistema">
	<legend>Agregar Categorías</legend>
		<p>##143,Agregar Nueva Categoría##</p>
		<p><label for="category[name]">Nombre Categoría</label>
		<input type="text" name="category[name]" id="name" value='' size="50" />
		</p>
		|-include file="FiltersRedirectInclude.tpl"-|
		<input type="hidden" name="category[module]" value="|-if isset($filters.searchModule) and $filters.searchModule ne 'all'-||-$filters.searchModule-||-/if-|" id="selectedModule">
		<p><label for="category[parentId]">Dentro de</label>
		<select name="category[parentId]" id="selectAddCategory">
			<option value="0">Ninguna</option>
			|-include file="CategoriesOptionsInclude.tpl" categories=$parentUserCategories user=$user count='0'-|
		</select></p>
		<p>
			<label for="category[isPublic]">Pública</label>
			<input type="checkbox" name="category[isPublic]" value="1" />
		</p>
		<p><input type="hidden" name="do" value="categoriesDoEditX" />
		<input type='button' onclick="categoriesDoEditX(this.form)" name="ncat" value="##143,Agregar##" /><span id="systemWorking" style="display:none;" class="inProgress">...Agregando Categoría...</span>
		</p>
	</fieldset>
</form>
|-if $userCategories|@count gt 0-|

<fieldset title="Formulario para modificar o eliminar de categorías del sistema">
<legend>##144,Modificar o Eliminar Categoría##</legend>
			<form method='get' action="Main.php" style="display:inline;">
		<label for="id">Categorías disponibles</label>
				<select name='id' id="selectModifyCategory" onchange="javascript:document.getElementById('select_modificar_categoria').value=this.value">
 					<option value='0' selected>Seleccione ...</option>
					|-include file="CategoriesOptionsInclude.tpl" categories=$parentUserCategories user=$user count='0'-|
				</select>
				&nbsp;&nbsp;
				<input type='submit' name="mcat" value="##145,Modificar##" />
				<input type="hidden" name="do" value="categoriesEdit" />
			</form>
				&nbsp;&nbsp;
			<form method='post' action="Main.php" style="display:inline;">
				<input type="hidden" name="id" value="|-$userCategories[0]->getId()-|" id="select_modificar_categoria" />
				<input type='submit' name="dcat" value="##115,Eliminar##" onclick="return confirm('##255,Esta opción elimina permanentemente esta Categoría. ¿Está seguro que desea eliminarla?##');" />
				<input type="hidden" name="do" value="categoriesDoDelete" />
				<input type="hidden" name="categoryModule" value="|-if isset($categoryModule) and $selectedModule neq ''-||-$selectedModule->getName()-||-else-||-/if-|" id="categoryModule">
		</form>
</fieldset>
|-/if-|
