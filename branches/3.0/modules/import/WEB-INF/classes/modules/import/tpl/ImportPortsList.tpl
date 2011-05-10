<h2>##40,Configuración del Sistema##</h2>
<h1>Administración de Puertos</h1>
<div id="div_ports">
	|-if $message eq "ok"-|
		<div class="successMessage">Port guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Port eliminado correctamente</div>
	|-elseif $message eq "activated_ok"-|
		<div class="successMessage">Port activado correctamente</div>
	|-/if-|
	<p>A continuación tiene el listado de los Puertos disponibles en el sistema. Si desea agregar uno nuevo, haga click en "Agregar Puerto", puede eliminar o agregar nuevos Puertos. Si elimina un Puerto, puede reactivarlo nuevamente.</p>
	<table id="tabla-ports" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="5%">
	<col width="20%">
	<col width="60%">
	<col width="15%">
		<thead>
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importPortsEdit" class="addLink">Agregar Puerto</a></div></th>
			</tr>
			<tr>
				<th class="thFillTitle">Id</th>
				<th class="thFillTitle">Código</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$ports item=port name=for_ports-|
			<tr>
				<td>|-$port->getId()-|</td>
				<td>|-$port->getcode()-|</td>
				<td>|-$port->getname()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="importPortsEdit" />
						<input type="hidden" name="id" value="|-$port->getid()-|" />
						<input type="submit" name="submit_go_edit_port" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importPortsDoDelete" />
						<input type="hidden" name="id" value="|-$port->getid()-|" />
						<input type="submit" name="submit_go_delete_port" value="Borrar" onclick="return confirm('Seguro que desea eliminar el port?')" class="iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
		<tr> 
				<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>			
			|-/if-|				
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importPortsEdit" class="addLink">Agregar Puerto</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

|-if $inactivePorts|@count gt 1-|
<br />
<h3>Inactivos</h3>
<div >
	<table id="tabla-ports-inactive" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="5%">
	<col width="20%">
	<col width="60%">
	<col width="15%">
		<thead>
			<tr>
				<th class="thFillTitle">Id</th>
				<th class="thFillTitle">Código</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inactivePorts item=port name=for_ports-|
			<tr>
				<td>|-$port->getId()-|</td>
				<td>|-$port->getcode()-|</td>
				<td>|-$port->getname()-|</td>
				<td>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importPortsDoActivate" />
						<input type="hidden" name="id" value="|-$port->getid()-|" />
						<input type="submit" name="submit_go_delete_port" value="Activar" class="iconActivate" />
					</form>
				</td>
			</tr>
		|-/foreach-|												
		</tbody>
	</table>

</div>
|-/if-|
