<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##117,Completar Actores por Categoría##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##118,Seleccione una categoría y agregue los Actores que considere completan cada categoría##.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<form  name='cats' method="get" action="Main.php">
	<table class='tablaborde' cellspacing='1' cellpadding='3' border='0' width='100%'>
		<tr>
			<td class='celltitulo' width='35%' nowrap><div class='titulo2'>##119,Seleccione la Categoría que desea completar##&nbsp;&nbsp;</div></td>
			<td class='celldato'><select name="cat" onChange="document.cats.submit();">
					<option value="0">##103,Seleccione una categoría##</option>
						|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
						|-/foreach-|
				</select>
				<input type="hidden" name="do" value="actorsAddActorInCategory" />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##120,Continuar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##'  class='boton' /></td>
		</tr>
	</table>
	<br />
	|-if ($currentCategory ne "")-|
	<table class='tablaborde' border='0' cellspacing='1' cellpadding='3' width='60%'>
		<tr>
			<th colspan='2'>##121,Actores de la categoría## &quot;|-$currentCategory->getName()-|&quot;</th>
		</tr>
		|-foreach from=$actors item=actor name=for_actors-|
		<tr>
			<td width="5%" align="right" class='celldato'><span class='titulo2'> |-$smarty.foreach.for_actors.iteration-| </span></td>
			<td width="95%" class='celldato'><span class='titulo2'> |-$actor->getName()-| </span></td>
		</tr>
		|-/foreach-|
	</table>
</form>
<form method='post' action="Main.php">
	<input type='hidden' name='cat' value='|-$currentCategory->getId()-|' />
	<table class='tablaborde' border='0' cellspacing='1' cellpadding='3' width='100%'>
		<tr>
			<th colspan='2'>##122,Agregar Actores a la Categoría ## &quot;|-$currentCategory->getName()-|&quot;</th>
		</tr>
		<tr>
			<td class='celltitulo'><div class='titulo2'>Nombre de la Ciudad </div></td>
			<td class='celldato'><input type="text" name='anombre' size='75' class='textodato' /></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' name='abut' value='##123,Agregar##' class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##' class='boton' />
				<input type="hidden" name="do" value="actorsDoAddActorInCategory" />
			</td>
		</tr>
	</table>
</form>
|-/if-|