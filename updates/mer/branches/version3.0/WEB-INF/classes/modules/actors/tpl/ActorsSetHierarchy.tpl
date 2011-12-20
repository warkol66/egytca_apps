<h2>Configuración del Sistema</h2>
<h1>Jerarquización de Actores por Categoría</h1>
<p>Seleccione cada una de las categorías de Actores y defina con la ayuda del sistema los más importantes mediante la metodología de jerarquización propuesta. Una vez completado el cálculo debe guardar el resultado para utilizar los Actores resultantes en los gráficos y análisis.</p>
<form name='cats'>
	<table class='tableTdBorders' cellspacing='1' cellpadding='3' border='0' width='100%'>
		<tr>
			<td width='35%' nowrap>##130,Seleccione una categoría a jerarquizar##</td>
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
				<input type="hidden" name="do" value="actorsSetHierarchy" />
				&nbsp;<a href="javascript:void(null)" onClick="alert('##137,Recorra las filas de la siguiente tabla y seleccionando sobre las filas qué Actor es más importante que el expresado en la columna. Al finalizar, pulse el botón &quot;Calcular jerarquía&quot; y en la columna total aparecerá el órden de importancia.##')">##38,Ayuda##</a></td>
		</tr>
		<tr>
			<td colspan='2'><input type='submit' value='##120,Continuar##' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##' /></td>
		</tr>
	</table>
</form>
<p>&nbsp;</p>
|-if $currentCategory ne ""-|
	|-if $manual-| 
	<form name='hierarchy' method='post' action="Main.php">
	<input type='hidden' name='category' value='|-$currentCategory->getId()-|' />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class='tableTdBorders'>
		<tr>
			<th colspan='2'>Jerarquización de Actores de la categoría: "|-$currentCategory->getName()-|"</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align='center'>##138,Orden##</td>
		</tr>
			|-foreach from=$actors item=actor name=for_actors-|
		<tr>
			<td width='30%' nowrap>|-$actor->getName()-|</td>
			<td align='center'><input type='text' name='r[|-$smarty.foreach.for_actors.iteration-|]' size='3' value="" />
				<input type='hidden' name='rel[|-$smarty.foreach.for_actors.iteration-|]' value='|-$actor->getId()-|' />
			</td>
		</tr>
		|-/foreach-|
		<tr>
			<td colspan='2'><input type="hidden" name="do" value="actorsDoSetManualHierarchy" />
				<input type='submit' value='##132,Guardar Resultado##' />&nbsp;&nbsp;
				<input type='button' onClick='resetForm(|-$actorsCountPlus1-|)' value='##98,Borrar todo##' />
			</td>
		</tr>
	</table>
	</form>
	<script>
	 	function resetForm(total) {
			for (var i=1; i < total; i++) {
				document.forms["hierarchy"].elements["r\["+i+"\]"].value = " ";
			}
		}
	</script>
	<p>&nbsp;</p>
	<p>
		<img src="images/clear.png" class="icon iconUnordered" /> <a href="Main.php?do=actorsSetHierarchy&amp;cat=|-$currentCategory->getId()-|" class="noDecoration">##133,Jerarquización Asistida##</a></p>
|-else-|
	<form name='hierarchy' method='post' onSubmit='calculate(|-$actorsCountPlus1-|)' action="Main.php">
	<input type='hidden' name='category' value='|-$currentCategory->getId()-|' />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class='tableTdBorders'>
		<tr>
			<th colspan='|-$actorsCountPlus3-|'>Jerarquización de Actores de la categoría: "|-$currentCategory->getName()-|"</th>
		</tr>
		<tr>
			<td colspan='2'>&nbsp;</td>
			|-foreach from=$actors item=actor name=for_actors-|
			<td align='center'>|-$smarty.foreach.for_actors.iteration-|</td>
			|-/foreach-|
			<td align='center'>##135,Total##</td>
		</tr>
		|-foreach from=$actors item=actor name=for_actors-|
		<tr>
			<td width='5%'>|-$smarty.foreach.for_actors.iteration-|</td>
			<td width='30%' nowrap>|-$actor->getName()-|</td>
			|-foreach from=$actors item=actorb name=for_actorsb-|
			|-if $smarty.foreach.for_actors.iteration ne $smarty.foreach.for_actorsb.iteration-|
			<td><input type='checkbox' name='c[|-$smarty.foreach.for_actors.iteration-|][|-$smarty.foreach.for_actorsb.iteration-|]' value='1' onClick='document.forms[1].elements["c[|-$smarty.foreach.for_actorsb.iteration-|][|-$smarty.foreach.for_actors.iteration-|]"].checked=0;' /></td>
			|-else-|
			<td>&nbsp;</td>
			|-/if-|
			|-/foreach-|
			<td align='center'><input type='text' name='r[|-$smarty.foreach.for_actors.iteration-|]' size='3' />
							<input type='hidden' name='rel[|-$smarty.foreach.for_actors.iteration-|]' value='|-$actor->getId()-|' />
			</td>
		</tr>
					|-/foreach-|
					<tr>
			<td colspan='|-$actorsCountPlus3-|'><input type='button' onClick='calculate(|-$actorsCountPlus1-|)' value='##136,Calcular jerarquía##' />
							&nbsp;&nbsp;
							<input type='button' onClick='resetForm(|-$actorsCountPlus1-|)' value='##98,Borrar todo##' />
							&nbsp;&nbsp;
							<input type="hidden" name="do" value="actorsDoSetHierarchy" />
							<input type='submit' value='##132,Guardar Resultado##' />
						</td>
		</tr>
	</table>
	</form>
<script>
	function resetForm(total) {
		var k=new String();
		for (var i=1; i<total; i++) {
			for (var b=1; b<total; b++) {
				if (b != i){
					k="c\["+i+"\]\["+b+"\]";
					document.forms["hierarchy"].elements[k].checked=0;
				}
			}
			document.forms["hierarchy"].elements["r\["+i+"\]"].value = "";
		}
	}
	function calculate(total) {
		var k=new String();
		for (var i=1; i<total; i++) {
			var count = 0;
			for (var b=1; b<total; b++) {
				if (b != i) {
					k="c\["+i+"\]\["+b+"\]";
					if (document.forms["hierarchy"].elements[k].checked) {
						count++
					}
				}
			}
			document.forms["hierarchy"].elements["r\["+i+"\]"].value = count;
		}
	return 1;
	}
	</script>
		<p>&nbsp;</p>
	<p>
	<img src="images/clear.png" class="icon iconSort" /> <a href="Main.php?do=actorsSetHierarchy&amp;cat=|-$currentCategory->getId()-|&amp;manual=1" class="noDecoration">##131,Jerarquización Manual##</a></p>
	|-/if-|
|-/if-|
|-if $principalActors|count ne 0-| 
<h4>##121,Actores de la categoría## &quot;|-$currentCategory->getName()-|&quot;</h4>
<table class='tableTdBorders' border='0' width='70%' cellspacing='1' cellpadding='4'>
	<tr>
		<th>Orden</th>
	<th>Nombre</th>
	</tr>
	|-foreach from=$principalActors item=principal name=for_principal-|
		<tr>
			<td width='10%' align="center">|-$smarty.foreach.for_principal.iteration-|</td>
			<td>|-$principal->getName()-|</td>
		</tr>
	|-/foreach-|
</table>
|-/if-|
