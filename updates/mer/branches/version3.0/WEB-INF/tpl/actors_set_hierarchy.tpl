<h2>Configuración del Sistema</h2>
	<h1>Jerarquización de Actores por Categoría</h1>
	<p>Seleccione cada una de las categorías de Actores y defina con la ayuda del sistema los más importantes mediante la metodología de jerarquización propuesta. Una vez completado el cálculo debe guardar el resultado para utilizar los Actores resultantes en los gráficos y análisis.</p>
<form name='cats'>
	<table class='tableTdBorders' cellspacing='1' cellpadding='3' border='0' width='100%'>
		<tr>
			<td class='titulodato1' width='35%' nowrap>##130,Seleccione una categoría a jerarquizar##</td>
			<td><select name="cat" onChange="document.cats.submit();">
					<option value="0">##103,Seleccione una categoría##</option>
						|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
						|-/foreach-|
				</select>
				<input type="hidden" name="do" value="actorsSetActorsHierarchy" />
				&nbsp;<a href="javascript:void(null)" onClick="alert('##137,Recorra las filas de la siguiente tabla y seleccionando sobre las filas qué Actor es más importante que el expresado en la columna. Al finalizar, pulse el botón &quot;Calcular jerarquía&quot; y en la columna total aparecerá el órden de importancia.##')">##38,Ayuda##</a></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##120,Continuar##' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##' /></td>
		</tr>
	</table>
</form>
|-if ($currentCategory ne "")-|
	|-if ($manual eq "1")-| 
	<form name='j' method='post' action="Main.php">
	<input type='hidden' name='category' value='|-$currentCategory->getId()-|' />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class='tableTdBorders'>
		<tr>
			<td class='titulodato1' colspan='2'>##131,Jerarquización Manual##</td>
		</tr>
		<tr>
			<td colspan='1' class='titulodato'>&nbsp;</td>
			<td class='titulodato' align='center'>##138,Orden##</td>
		</tr>
			|-foreach from=$actors item=actor name=for_actors-|
		<tr>
			<td class='tcol1b' width='30%' nowrap>|-$actor->getName()-|</td>
			<td class='titulodato' align='center'><input class='textodato' type='text' name='r[|-$smarty.foreach.for_actors.iteration-|]' size='3' value="0" />
				<input type='hidden' name='rel[|-$smarty.foreach.for_actors.iteration-|]' value='|-$actor->getId()-|' />
			</td>
		</tr>
		|-/foreach-|
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoSetManualActorsHierarchy" />
				<input type='submit' name='guardar' value='##132,Guardar Resultado##' />&nbsp;&nbsp;
				<input type='button' onClick='limpiar(|-$actorsCountPlus1-|)' name='Button' value='##98,Borrar todo##' />
			</td>
		</tr>
	</table>
	<script>
	 	function limpiar(an)
		{
			var k=new String();
			for (var i=1; i<an; i++)
			{
				var total=0;
				document.forms[1].elements["r\["+i+"\]"].value=total;
//			return 1;
			}
		}
	</script>
</form>
			<a href="Main.php?do=actorsSetActorsHierarchy&amp;cat=|-$currentCategory->getId()-|">##133,Jerarquización Asistida##</a> |-else-|
			<form name='j' method='post' onSubmit='calcular(|-$actorsCountPlus1-|)' action="Main.php">
	<input type='hidden' name='category' value='|-$currentCategory->getId()-|' />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class='tableTdBorders'>
					<tr>
			<td class='titulodato1' colspan='|-$actorsCountPlus3-|'>##134,Jerarquización x Categoría##</td>
		</tr>
					<tr>
			<td colspan='2' class='titulodato'>&nbsp;</td>
			|-foreach from=$actors item=actor name=for_actors-|
			<td class='titulodato' align='center'>|-$smarty.foreach.for_actors.iteration-|</td>
			|-/foreach-|
			<td class='titulodato' align='center'>##135,Total##</td>
		</tr>
					|-foreach from=$actors item=actor name=for_actors-|
					<tr>
			<td class='tcol1b' width='5%'>|-$smarty.foreach.for_actors.iteration-|</td>
			<td class='tcol1b' width='30%' nowrap>|-$actor->getName()-|</td>
			|-foreach from=$actors item=actorb name=for_actorsb-|
			|-if $smarty.foreach.for_actors.iteration ne $smarty.foreach.for_actorsb.iteration-|
			<td class='tcol1cen'><input type='checkbox' name='c[|-$smarty.foreach.for_actors.iteration-|][|-$smarty.foreach.for_actorsb.iteration-|]' value='1' onClick='document.forms[1].elements["c[|-$smarty.foreach.for_actorsb.iteration-|][|-$smarty.foreach.for_actors.iteration-|]"].checked=0;' /></td>
			|-else-|
			<td class='menu2back2'>&nbsp;</td>
			|-/if-|
			|-/foreach-|
			<td class='titulodato' align='center'><input class='textodato' type='text' name='r[|-$smarty.foreach.for_actors.iteration-|]' size='3' />
							<input type='hidden' name='rel[|-$smarty.foreach.for_actors.iteration-|]' value='|-$actor->getId()-|' />
						</td>
		</tr>
					|-/foreach-|
					<tr>
			<td class='cellboton' colspan='|-$actorsCountPlus3-|'><input type='button' name='Button3' onClick='calcular(|-$actorsCountPlus1-|)' value='##136,Calcular jerarquía##' />
							&nbsp;&nbsp;
							<input type='button' onClick='limpiar(|-$actorsCountPlus1-|)' name='Button' value='##98,Borrar todo##' />
							&nbsp;&nbsp;
							<input type="hidden" name="do" value="actorsDoSetActorsHierarchy" />
							<input type='submit' name='guardar' value='##132,Guardar Resultado##' />
						</td>
		</tr>
				</table>
	<script>
			  	function limpiar(an){
					var k=new String();
					for (var i=1; i<an; i++){
						var total=0;
						for (var b=1; b<an; b++){
							if (b != i){
								k="c\["+i+"\]\["+b+"\]";
								document.forms[1].elements[k].checked=0;
							}
						}
						document.forms[1].elements["r\["+i+"\]"].value=total;
//					return 1;
					}
				}
			  	function calcular(an){
					var k=new String();
					for (var i=1; i<an; i++){
						var total=0;
						for (var b=1; b<an; b++){
							if (b != i){
								k="c\["+i+"\]\["+b+"\]";
								if (document.forms[1].elements[k].checked){total++}
//								else{total++;}
//							alert(k+": "+document.forms[1].elements[k].checked+" total:"+total);
							}
						}
						document.forms[1].elements["r\["+i+"\]"].value=total;
//					return 1;
					}
				return 1;
				}

			  </script>
</form>
			<a href="Main.php?do=actorsSetActorsHierarchy&amp;cat=|-$currentCategory->getId()-|&amp;manual=1">##131,Jerarquización Manual##</a> |-/if-|
			|-/if-|
			|-if $principalActors|count ne 0-| <br />
			<br />
			<h2>##121,Actores de la categoría## &quot;|-$currentCategory->getName()-|&quot;</h2>
			<table class='tableTdBorders' border='0' width='70%' cellspacing='1' cellpadding='4'>
	<tr>
					<th colspan='2'>##101,Nombre del Actor##</th>
				</tr>
	|-foreach from=$principalActors item=principal name=for_principal-|
	<tr>
					<td class='titulodato1' width='10%'>|-$smarty.foreach.for_principal.iteration-|</td>
					<td><span class='titulo2'>|-$principal->getName()-|</span></td>
				</tr>
	|-/foreach-|
</table>
			|-/if-| <br />
			<br />
|-if ($manual ne "1")-|
<Script>
				calcular(<?=count($acts)+1?>)
	  </script>
|-/if-| 