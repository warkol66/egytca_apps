<h2>Configuración del Sistema</h2>
	<h1>Completar Actores por Categoría</h1>
	<p>Seleccione una categoría y agregue los Actores que considere completan cada categoría.</p>
<form  name='cats' method="get" action="Main.php">
	<table class='tableTdBorders' cellspacing='1' cellpadding='3' border='0' width='100%'>
		<tr>
			<td class='celltitulo' width='35%' nowrap><div class='titulo2'>##119,Seleccione la Categoría que desea completar##&nbsp;&nbsp;</div></td>
			<td><select name="cat" onChange="document.cats.submit();">
						|-if $currentCategory-|
					<option value="0">Seleccione otra categoría</option>
						|-else-|
					<option value="0">Seleccione una categoría</option>
						|-/if-|
						|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
						|-/foreach-|
				</select>
				<input type="hidden" name="do" value="actorsAddInCategory" />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##120,Continuar##' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##' /></td>
		</tr>
	</table>
	<br />
	|-if ($currentCategory ne "")-|
	<table class='tableTdBorders' border='0' cellspacing='1' cellpadding='3' width='60%'>
		<tr>
			<th colspan='2'>##121,Actores de la categoría## &quot;|-$currentCategory->getName()-|&quot;</th>
		</tr>
		|-foreach from=$actors item=actor name=for_actors-|
		<tr>
			<td width="5%" align="right"><span class='titulo2'> |-$smarty.foreach.for_actors.iteration-| </span></td>
			<td width="95%"><span class='titulo2'> |-$actor->getName()-| </span></td>
		</tr>
		|-/foreach-|
	</table>
</form>
<form method='post' action="Main.php">
	<input type='hidden' name='cat' value='|-$currentCategory->getId()-|' />
	<h3>Agregar Actores a la Categoría &quot;|-$currentCategory->getName()-|&quot;</h3>
	<table class='tableTdBorders' border='0' cellspacing='1' cellpadding='3' width='100%'>
		<tr>
			<td class='celltitulo'><div class='titulo2'>Nombre del actor </div></td>
			<td><input type="text" name='anombre' size='75' class='textodato' /></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' name='abut' value='##123,Agregar##' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##' />
				<input type="hidden" name="do" value="actorsDoAddInCategory" />
			</td>
		</tr>
	</table>
</form>
|-/if-|