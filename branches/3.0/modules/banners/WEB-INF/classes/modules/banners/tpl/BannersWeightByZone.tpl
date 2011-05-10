<h2>Banners</h2>
<h1>Ponderación de banners de la Zona</h1>
<p>A continuación encontrará los banners que se incluyen el la Zona "|-$zone->getName()-|". Puede con este formulario determinar la relación de impresión de un banner versus los demás colocando peso a cada banner. El peso relativo de cada banner se calculará en función de la suma total del peso de todos los banners.<br /> 
	Para guardar los cambios haga click en "Guardar".</p>
<form action="Main.php" method="post" name="form1">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-bannerzoneweight">
		<tr>
			<th>Banner</th>
			<th>Peso</th>
		</tr>
		|-foreach from=$banners item=banner name=for_banners-|
		<tr>
			<td>|-$banner->getName()-|</td>
			<td><input name="banners[|-$smarty.foreach.for_banners.iteration-|][id]" type="hidden" value="|-$banner->getId()-|" />
				<input type="text" name="banners[|-$smarty.foreach.for_banners.iteration-|][weight]" value="|-$banner->weight-|" size="5" />
			</td>
		</tr>
		|-/foreach-|
		<tr>
			<td colspan="2">
				<input type="submit" value="##5,Guardar##" />
				<input type="button" value="##6,Regresar##" onClick="history.go(-1)" />
			</td>
		</tr>
	</table>    
	<input type="hidden" name="zoneId" value="|-$zoneId-|" />
	<input type="hidden" name="do" value="bannersDoWeightByZone" />
</form>
