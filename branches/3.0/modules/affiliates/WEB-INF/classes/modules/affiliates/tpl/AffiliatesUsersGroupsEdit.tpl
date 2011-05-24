<h2>##40,Configuración del Sistema##</h2>
	<h1>##178,Administración de Grupos de Usuarios##</h1>
	|-if $currentGroup->getId() ne ''-|
		<p>##180,Realice los cambios en el grupo de usuarios y haga click en "Guardar" para guardar las modificaciones. ##</p>
	|-else-|
		<p>Ingrese los datos del nuevo grupo de usuarios y haga click en "Guardar".</p>
	|-/if-|
|-if $message eq "errorUpdate"-|
<div align='center' class='errorMessage'>##182,Ha ocurrido un error al intentar guardar la información del grupo de usuarios##</div>
|-/if-|
|-if $message eq "notAddedToGroup"-|
<div align='center' class='errorMessage'>##185,Ha ocurrido un error al intentar agregar la categoría al grupo##</div>
|-/if-|
|-if $message eq "notRemovedFromGroup"-|
<div align='center' class='errorMessage'>##186,Ha ocurrido un error al intentar eliminar la categoría del grupo##</div>
|-/if-|

|-if $currentGroup->getValidationFailures()|@count > 0-|
	<div class="errorMessage">
		<ul>
			|-foreach from=$currentGroup->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
		</ul>
	</div>
|-/if-|

<form method='post' action='Main.php?do=affiliatesUsersGroupsDoEdit'>
	<fieldset title="Formulario de edición de grupo de usuario">
	<legend>Grupo de Usuarios por Afiliados</legend>
		<input type="hidden" name="id" value="|-$currentGroup->getId()-|" />
		<input type="hidden" name="do" value="affiliatesUsersGroupsDoEdit" />
		<p>
			<label for="params[name]">##196,Nombre del Grupo##</label>
			<input name="params[name]" type="text" value="|-$currentGroup->getName()-|" size="60">
		</p>
		<p>
			<input name="save" type="submit" class="botonchico" value="##97,Guardar##"> 
			<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' class='botonchico' />
		</p>
	</fieldset>
</form>

|-if $currentGroup->getId() ne ''-|
<fieldset title="Formulario de edición de categorias de grupo de usuario">
	<legend>##188,El grupo## |-$currentGroup->getName()-| ##189,tiene acceso a las siguientes categorías:##</legend>
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class="tableTdBorders">
	|-if $currentGroupCategories|@count eq 0-|
	<tr>
		<td colspan="2"><div class='titulo2'>##190,El grupo todavía no posee acceso a ninguna categoría.##</div></th>
	</tr>
	|-else-|
	<tr>
		<th width="95%">##191,Categorías##</th>
		<th width="5%" nowrap="nowrap">&nbsp;</th>
	</tr>
	|-foreach from=$currentGroupCategories item=category name=for_group_category-|
	<tr>
		<td width="95%"><div class='titulo2'>|-$category->getName()-|</div></td>
		<td width="5%" nowrap>
		<form action="Main.php" method="post" style="display:inline;"> 
			<input type="hidden" name="do" value="affiliatesUsersGroupsDoRemCategory" /> 
			<input type="hidden" name="group" value="|-$currentGroup->getId()-|" /> 
			<input type="hidden" name="category" value="|-$category->getId()-|" /> 
			<input type="submit" name="submit_go_delete_affiliate_group" value="##192,Eliminar acceso##" title="Eliminar" class="icon iconDelete" onclick="return confirm('##257,Esta opción remueve el acceso del grupo a la categoría. ¿Está seguro que desea eliminarlo?##');"  /> 
		</form>
		</td>
	</tr>
	|-/foreach-|
	|-/if-|
	</table>
	<p>
		<form action='Main.php' method='post'>
			<label for="category">##193,Agregar categoría##&nbsp;&nbsp;</label>
			<select name="category">
				<option value="" selected="selected">##103,Seleccione una categoría##</option>
				|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
				|-/foreach-|
			</select>
			<input type="hidden" name="do" value="affiliatesUsersGroupsDoAddCategory" />
			<input type="hidden" name="group" value="|-$currentGroup->getId()-|" />
			<input type='submit' value='##123,Agregar##' class='boton' />
		</form>
	</p>
</fieldset>
|-/if-|
