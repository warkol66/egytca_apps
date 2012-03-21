<h2>##users,40,Configuración del Sistema##</h2>
<h1>##users,178,Administración de Grupos de Usuarios##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $accion eq "edicion"-|
	<p>##users,180,Realice los cambios en el grupo de usuarios y haga click en "Aceptar" para guardar las modificaciones. ##</p>
|-else-|
	<p>##users,179,A continuación podrá editar la lista de grupos de usuarios, permitiendo, al editar el grupo, modificar las categorías que pueden acceder los usuarios miembros del grupo.##</p>
|-/if-|
|-if $message eq "deleted"-|
	<div class='successMessage'>##users,181,Grupo de Usuarios eliminado##</div>
|-elseif $message eq "errorUpdate"-|
	<div class='failureMessage'>##users,182,Ha ocurrido un error al intentar guardar la información del grupo de usuarios##</div>
|-elseif $message eq "saved"-|
	<div class='successMessage'>##users,183,Grupo de Usuarios guardado##</div>
|-elseif $message eq "blankName"-|
	<div class='failureMessage'>##users,184,El Grupo de Usuarios debe tener un Nombre##</div>
|-elseif $message eq "notAddedToGroup"-|
	<div class='failureMessage'>##users,185,Ha ocurrido un error al intentar agregar la categoría al grupo##</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div class='failureMessage'>##users,186,Ha ocurrido un error al intentar eliminar la categoría del grupo##</div>
|-/if-|
|-if $accion eq "edicion"-|
<fieldset title="Formulario de edición de grupos de usuarios del sistema">
<legend>Editar grupos de usuario</legend>
<form method='post' action='Main.php?do=usersGroupsDoEdit'>
	<input type='hidden' name='id' value='|-$currentGroup->getId()-|' />
	<p>##users,187,Editar nombre del Grupo ##</p>
	<p><label for="name">##users,196,Nombre##</label>
			<input name='name' type='text' value='|-$currentGroup->getName()-|' size="45" />
	</p>
	<p><input type="hidden" name="accion" value="edicion" />
		 <input type='submit' name='guardar' value='##users,97,Guardar##'  />
			<input type='button' onClick='javascript:history.go(-1)' value='##users,104,Regresar##'  />
	</p>
</form>
</fieldset>

<fieldset title="Lista de grupos y categorías del sistema">
<legend>Acceso a categorías por grupos</legend>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th colspan="2">##users,188,El grupo## |-$currentGroup->getName()-| ##users,189,tiene acceso a las siguientes categorías:##</th>
	</tr>
	|-if $currentGroupCategories|@count eq 0-|
		<tr>
			<td colspan="2">##users,190,El grupo todavía no posee acceso a ninguna categoría.##</td>
		</tr>
		|-else-|
		<tr>
			<th width="98%">##users,191,Categorías##</th>
			<th width="2%">&nbsp;</th>
		</tr>
		|-foreach from=$currentGroupCategories item=groupCategory name=for_group_category-|
			|-assign var="category" value=$groupCategory->getCategory()-|
			<tr>
				<td>|-$category->getName()-|</td>
				<td nowrap><a href="Main.php?do=usersGroupsDoRemoveCatFromGroup&category=|-$category->getId()-|&group=|-$currentGroup->getId()-|" title='Eliminar acceso del grupo esta categoría' alt='Eliminar acceso del grupo esta categoría' onclick="return confirm('##users,257,Esta opción remueve el acceso del grupo a la categoría. ¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete"></a></td>
			</tr>
		|-/foreach-|
	|-/if-|
	<tr>
		<td colspan='2'>|-if $categories|@count eq 0 && $currentGroupCategories|@count neq 0-|
		El grupo ya tiene acceso a todas las cetegorías
		|-else-|
		<form action='Main.php' method='post'>
				##users,193,Agregar categoría##&nbsp;&nbsp;
				<input type="hidden" name="do" value="usersGroupsDoAddCategoryToGroup" />
				<select name="category">
					<option value="" selected="selected"></option>
					<option value="" selected="selected">##users,103,Seleccione una categoría##</option>
						|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
						|-/foreach-|
				</select>
				<input type="hidden" name="group" value="|-$currentGroup->getId()-|" />
				<input type='submit' value='##users,123,Agregar##' />
			</form>|-/if-|</td>
	</tr>
</table>
</fieldset>
|-/if-|
<br />
<fieldset title="Lista de grupos de usuarios del sistema">
<legend>Grupos de Usuarios</legend>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th width="98%">##users,194,Grupo de Usuarios del Sistema##</th>
		<th width="2%">&nbsp;</th>
	</tr>
	|-foreach from=$groups item=group name=for_groups-|
	<tr>
		<td>|-$group->getName()-|</td>
		<td nowrap><a href='Main.php?do=usersGroupsList&group=|-$group->getId()-|' alt='##users,114,Editar##' title='##users,114,Editar##'><img src="images/clear.png" class="icon iconEdit"></a>
		|-if $group->getId() lt 4-|
			<img src="images/clear.png" class="icon iconDeleteDisabled" title="Este grupo no se puede eliminar" alt="Este grupo no se puede eliminar">
		|-else-|
			<a href='Main.php?do=usersGroupsDoDelete&group=|-$group->getId()-|' title='##users,115,Eliminar##' alt='##users,115,Eliminar##' onclick="return confirm('##users,256,Esta opción eliminará permanentemente a este Grupo. ¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete"></a>
		|-/if-|</td>
	</tr>
	|-/foreach-|
	<tr>
		<td colspan='2'><form action='Main.php' method='post'>
				##users,195,Agregar Grupo de Usuarios##&nbsp;&nbsp;
				<input type="hidden" name="do" value="usersGroupsDoEdit" />
				<input type="text" name="name" value="" />
				<input type='submit' value='##users,123,Agregar##' />
			</form></td>
	</tr>
</table>
</fieldset>