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
		$('categoryMsgField').innerHTML = '<span class="inProgress">agregando dependencia...</span>';
		$('name').value = "";
	}
</script>
<h2>##common,18,Configuración del Sistema##</h2>
<h1>Editar Dependencias </h1>
<div id="categoriesResultMsg">
|-if $message eq "ok"-|
	<div class="successMessage">Dependencia modificada correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Dependencia eliminada correctamente</div>
|-elseif $message eq "notdeleted"-|
	<div class="failureMessage">##140,No se pudo eliminar la dependencia porque posee datos asociados##.</div>
|-/if-|
</div>
<p>##141,A continuación podrá editar la lista de dependencias disponibles. Podrá Agregar, Modificar o Eliminar dependencias de la lista de dependencias disponibles. Sólo podrá eliminar las dependencias que no tengan ningún dato asignado.##</p>
<form method='get' action="Main.php" id="form_category_list" style="display:inline;">
	<input type="hidden" name="do" value="categoriesList" />
	<fieldset title="Edición de dependencias del sistema">
	<legend>Dependencias del Sistema</legend>
			<div id="categoriesListPlaceHolder">
		|-if $parentUserCategories|@count gt 0-|		
			|-include file="CategoriesListInclude.tpl" categories=$parentUserCategories-|
		|-else-|
			<ul>
				<li>El sistema no tiene dependencias asociadas</li>
		</ul>
		|-/if-|
		</div>
	</fieldset>
</form>

<form method='post' action="Main.php" id="form_category_add" style="display:inline;">
<fieldset title="Formulario de dependencias del sistema">
	<legend>Agregar Dependencias</legend>
		<p>##143,Agregar Nueva Dependencia##</p>
		<p><label for="category[name]">Nombre Dependencia</label>
		<input type="text" name="category[name]" id="name" value='' size="50" />
		</p>
		<input type="hidden" name="category[module]" value="|-$filters.searchModule-|" id="selectedModule">
		<p>
			<label for="category_responsible]">Funcionario a cargo</label>
			<input name="category[responsible]" type="text" id="category_responsible" title="Responsable a cargo" value="" size="80" />
		</p>
		<p>
		<label for="category[parentId]">Dentro de</label>
		<select name="category[parentId]" id="selectAddCategory">
			<option value="0">Ninguna</option>
			|-include file="CategoriesOptionsInclude.tpl" categories=$parentUserCategories user=$user count='0'-|
		</select></p>
		<p><input type="hidden" name="do" value="categoriesDoEditX" />
		<input type='button' onclick="categoriesDoEditX(this.form)" name="ncat" value="##143,Agregar##" class='button' /> <span id="categoryMsgField"></span>
		</p>
	</fieldset>
</form>
|-if $userCategories|@count gt 0-|

<fieldset title="Formulario para modificar o eliminar de dependencias del sistema">
<legend>##144,Modificar o Eliminar Dependencia##</legend>
			<form method='get' action="Main.php" style="display:inline;">
		<label for="id">Dependencias disponibles</label>
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
				<input type='submit' name="dcat" value="##115,Eliminar##" class='button' onclick="return confirm('##255,Esta opción elimina permanentemente esta Dependencia. ¿Está seguro que desea eliminarla?##');" />
				<input type="hidden" name="do" value="categoriesDoDelete" />
				<input type="hidden" name="categoryModule" value="|-if isset($categoryModule) and $selectedModule neq ''-||-$selectedModule->getName()-||-else-||-/if-|" id="categoryModule">
		</form>
</fieldset>
|-/if-|
