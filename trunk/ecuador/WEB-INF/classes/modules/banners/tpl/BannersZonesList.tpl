<h2>Banners</h2>
<h1>Administrar de Zonas</h1>
|-if $message eq "saved"-|
	<div class="successMessage">La zona se guardó con éxito</div>
|-elseif $message eq "notsaved"-|
	<div class="failureMessage">Ocurrió un error al grabar los datos de la zona</div>
|-elseif $message eq "deleted"-|
	<div class="successMessage">Zona eliminada con éxito</div>
|-elseif $message eq "notdeleted"-|
	<div class="failureMessage">Ocurrió un error al tratar de eliminar la zona</div>
|-elseif $message eq "notget"-|
	<div class="failureMessage">Ocurrió un error al tratar de obtenet los datos de la zona</div>
|-/if-|
<p>A continuación encontrará el listado de zonas de banners disponibles en el sistema. Para agregar una nueva, haga click en "Agregar zona". Puede editar o eliminar una zona haciendo click en el ícono correspondiente. 
</p>
<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-bannerzones">
	<thead>
		<tr>
			<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersZonesEdit" class="addLink">Agregar Zona</a></div></th>
		</tr>
		<tr>
			<th width="95%">Zonas</th>
			<th width="5%">&nbsp;</th>
		</tr>
		|-foreach from=$bannerZoneColl item=zone name=for_zones-|
		<tr>
			<td><div class='titulo2'>|-$zone->getName()-|</div></td>
			<td nowrap="nowrap">
				<form action="Main.php" method="get">
					<input type="hidden" name="do" value="bannersZonesEdit" />
					<input type="hidden" name="id" value="|-$zone->getid()-|" />
					<input type="submit" name="submit_go_edit_bannerZone" value="Editar" class="buttonImageEdit" />
				</form>
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="bannersZonesDoDelete" />
					<input type="hidden" name="id" value="|-$zone->getid()-|" />
					<input type="submit" name="submit_go_delete_bannerZone" value="Borrar" onclick="return confirm('Seguro que desea eliminar la zona?')" class="buttonImageDelete" />
				</form>
				<a href='Main.php?do=bannersZonesDisplay&zoneId=|-$zone->getId()-|&mode=preview' target="_blank"><img src="images/clear.gif" class="linkImageView" title="Genera una vista de como se muestran los banners de la zona" /></a>
				|-if $zone->getRotationType() eq constant("BannerZone::ROTATION_WEIGHTED")-|<a href='Main.php?do=bannersWeightByZone&zoneId=|-$zone->getId()-|'><img src="images/clear.gif" class="linkImageWeight" title="Modificar los pesos relativos de los banners de la zona" /></a>
				|-elseif $zone->getRotationType() eq constant("BannerZone::ROTATION_ORDERED")-|<a href='Main.php?do=bannersOrderByZone&zoneId=|-$zone->getId()-|'><img src="images/clear.gif" class="linkImageOrder" title="Modificar el orden de los banners de la zona" /></a>
				|-/if-|
			</td>
		</tr>
		|-/foreach-|
		<tr>
			<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersZonesEdit" class="addLink">Agregar Zona</a></div></th>
		</tr>
</table>
