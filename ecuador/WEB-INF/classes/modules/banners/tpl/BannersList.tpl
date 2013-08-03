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
	<tr>
		<th width="95%">Banners del sistema</th>
		<th width="5%">&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	|-foreach from=$bannerColl item=banner name=for_banners-|
	<tr>
		<td>|-$banner->getName()-|</td>
		<td nowrap="nowrap">
			<form action="Main.php" method="get">
				<input type="hidden" name="do" value="bannersEdit" />
				<input type="hidden" name="id" value="|-$banner->getid()-|" />
				<input type="submit" name="submit_go_edit_banner" value="Editar" class="icon iconEdit" />
			</form>
			<form action="Main.php" method="post">
				<input type="hidden" name="do" value="bannersDoDelete" />
				<input type="hidden" name="id" value="|-$banner->getid()-|" />
				<input type="submit" name="submit_go_delete_banner" value="Borrar" onclick="return confirm('Seguro que desea eliminar el banner?')" class="icon iconDelete" />
			</form>
		</td>
	</tr>
	|-/foreach-|
	</tbody>
	<tfoot>
	<tr>
		<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=bannersEdit" class="addLink">Agregar Banner</a></div></th>
	</tr></tfoot>
</table>
