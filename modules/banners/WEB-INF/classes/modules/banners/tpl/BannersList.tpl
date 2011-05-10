<h2>Banners</h2>
<h1>Administración de Banners</h1>
|-if $message eq "saved"-|
	<div class="successMessage">El banner se guardó con éxito</div>
|-elseif $message eq "notsaved"-|
	<div class="failureMessage">Ocurrió un error al grabar los datos del banner</div>
|-elseif $message eq "deleted"-|
	<div class="successMessage">Banner eliminado con éxito</div>
|-elseif $message eq "notdeleted"-|
	<div class="failureMessage">Ocurrió un error al tratar de eliminar el banner</div>
|-elseif $message eq "notget"-|
	<div class="failureMessage">Ocurrió un error al tratar de obtenet los datos del banner</div>
|-/if-|
<p>A continuación encontrará el listado de banners disponibles en el sistema. Para agregar uno nuevo, haga click en "Agregar Banner". Puede editar o eliminar un banner haciendo click en el ícono correspondiente. 
</p>
<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-banners">
	<thead>
		<tr>
			<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersEdit" class="addLink">Agregar Banner</a></div></th>
		</tr>
	</thead>
	<tr>
		<th width="95%">Banners del sistema</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$banners item=banner name=for_banners-|
	<tr>
		<td>|-$banner->getName()-|</td>
		<td nowrap="nowrap"><a href='Main.php?do=bannersEdit&bannerId=|-$banner->getId()-|'><img src="images/clear.gif" class="linkImageEdit" /></a>
			<a href='Main.php?do=bannersDoDelete&bannerId=|-$banner->getId()-|'
			onclick="return confirm('##256, ¿Está seguro que desea eliminar de forma permanente este Banner?##');"><img src="images/clear.gif" class="linkImageDelete" /></a>
			<a href='Main.php?do=bannersPreview&bannerId=|-$banner->getId()-|' target="_blank"><img src="images/clear.gif" class="linkImageView" /></a>
		</td>
	</tr>
	|-/foreach-|
	<tr>
		<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersEdit" class="addLink">Agregar Banner</a></div></th>
	</tr>
</table>
