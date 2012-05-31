<h2>Administrador de Relevadores</h2>
<h1>Lista de Relevadores</h1>
<p>A continuación se muestra el listado de relevadores disponibles en el sistema, ud. podrá agregar nuevos o editar los existentes.</p>
<div id="divMsgBox"></div>
	<div id="div_construction">
	|-if $message eq "ok"-|
		<div class="successMessage">Relevador guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Relevador eliminado correctamente</div>
	|-/if-|

	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsInspectorsEdit" class="addLink">Agregar Relevador</a></div></th>
			</tr>
			<tr>
				<th width="40%">Relevador</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inspectors item=inspector name=for_calendaEvents-|
			<tr>
				<td>|-$inspector->getName()-|</td>
				<td nowrap>|-if "constructionsInspectorsEdit"|security_user_has_access-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="constructionsInspectorsEdit" />
						<input type="hidden" name="id" value="|-$inspector->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="constructionsDoDelete" />
						<input type="hidden" name="id" value="|-$inspector->getid()-|" />
						<input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('Seguro que desea eliminar la obra?')" class="icon iconDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="2" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsInspectorsEdit" class="addLink">Agregar Relevador</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
