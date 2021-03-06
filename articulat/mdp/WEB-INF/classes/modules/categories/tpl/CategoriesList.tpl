<script language="JavaScript" type="text/JavaScript">
	function categoriesDoEditX() {
		var pars = 'do=categoriesDoEditX';
		var fields = Form.serialize('form_category_add');
	
		var myAjax = new Ajax.Updater(
					{success: 'categoriesListPlaceHolder'},
					'Main.php?do=categoriesDoEditX',
					{
						method: 'post',
						parameters: pars,
						evalScripts: true,
						postBody: fields,
						insertion: Insertion.Bottom
					});
		$('categoryMsgField').innerHTML = '<span class="inProgress">agregando categoría...</span>';
		$('name').value = "";
	}
</script>
<h2>##common,18,Configuración del Sistema##</h2>
<h1>##139,Editar categorías##</h1>
<div id="categoriesResultMsg">
|-if $message eq "ok"-|
	<div class="successMessage">Categoría modificada correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Categoría eliminada correctamente</div>
|-elseif $message eq "notdeleted"-|
	<div class="failureMessage">##140,No se pudo eliminar la categoría porque posee datos asociados##.</div>
|-/if-|
</div>
<p>##141,A continuación podrá editar la lista de categorías disponibles. Podrá Agregar, Modificar o Eliminar categorías de la lista de categorías disponibles. Sólo podrá eliminar las categorías que no tengan ningún dato asignado.##</p>
<form method='get' action="Main.php" id="form_category_list" style="display:inline;">
	<input type="hidden" name="do" value="categoriesList" />
	<fieldset title="Edición de categorías del sistema">
	<legend>Categorías del Sistema</legend>
			<p><label for="filters[searchModule]">Módulo</label>
			<select name="filters[searchModule]">
				<option value='' selected="selected">|-"Global"|multilang_get_translation:"common"-|</option>
			|-foreach from=$modules item=moduleObj-|
				<option value="|-$moduleObj->getName()-|" |-$moduleObj->getName()|selected:$filters.searchModule-|>|-$moduleObj->getName()|multilang_get_translation:"common"-|</option>
			|-/foreach-|
			</select>
			<input type="submit" value="Mostrar categorías" />
			</p>
			<h3>Categorías del módulo</h3>
			<div id="categoriesListPlaceHolder">
		|-if $parentUserCategories|@count gt 0-|		
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
		<input type="hidden" name="category[module]" value="|-$filters.searchModule-|" id="selectedModule">
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
		<input type='button' onclick="categoriesDoEditX(this.form)" name="ncat" value="##143,Agregar##" class='button' /> <span id="categoryMsgField"></span>
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
				<input type="submit" value="##145,Modificar##" />
				<input type="hidden" name="do" value="categoriesEdit" />
			</form>
				&nbsp;&nbsp;
			<form method='post' action="Main.php" style="display:inline;">
				<input type="hidden" name="id" value="|-$userCategories[0]->getId()-|" id="select_modificar_categoria" />
				<input type='submit' name="dcat" value="##115,Eliminar##" class='button' onclick="return confirm('##255,Esta opción elimina permanentemente esta Categoría. ¿Está seguro que desea eliminarla?##');" />
				<input type="hidden" name="do" value="categoriesDoDelete" />
				<input type="hidden" name="categoryModule" value="|-if isset($categoryModule) and $selectedModule neq ''-||-$selectedModule->getName()-||-else-||-/if-|" id="categoryModule">
		</form>
</fieldset>
|-/if-|
