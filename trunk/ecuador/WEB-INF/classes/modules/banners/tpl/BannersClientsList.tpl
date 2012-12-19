<h2>Banners</h2>
<h1>Administrar de Clientes de Banners</h1>
|-if $message eq "saved"-|
	<div class="successMessage">El cliente se guardó con éxito</div>
|-elseif $message eq "notsaved"-|
	<div class="failureMessage">Ocurrió un error al grabar los datos del cliente</div>
|-elseif $message eq "deleted"-|
	<div class="successMessage">Cliente eliminado con éxito</div>
|-elseif $message eq "notdeleted"-|
	<div class="failureMessage">Ocurrió un error al tratar de eliminar el cliente</div>
|-elseif $message eq "notget"-|
	<div class="failureMessage">Ocurrió un error al tratar de obtenet los datos del cliente</div>
|-/if-|
<p>A continuación encontrará el listado de clientes de banners disponibles en el sistema. Para agregar uno nuevo, haga click en "Agregar clientes". Puede editar o eliminar un cliente haciendo click en el ícono correspondiente. 
</p>
<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-bannerclients">
	<thead>
		<tr>
			<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersClientsEdit" class="addLink">Agregar Clientes</a></div></th>
		</tr>
	</thead>
	<tr>
		<th width="95%">Clientes de Banners</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$bannerClient item=client name=for_clients-|
	<tr>
		<td>|-$client->getName()-|</td>
		<td nowrap="nowrap"><a href='Main.php?do=bannersClientsEdit&clientId=|-$client->getId()-|'><img src="images/clear.gif" class="linkImageEdit" /></a>
			<a href='Main.php?do=bannersClientsDoDelete&clientId=|-$client->getId()-|' onclick="return confirm('##256, ¿Está seguro que desea eliminar de forma permanente este Cliente?##');"><img src="images/clear.gif" class="linkImageDelete" /></a></td>
	</tr>
	|-/foreach-|
	<tr>
		<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersClientsEdit" class="addLink">Agregar Clientes</a></div></th>
	</tr>
</table>
