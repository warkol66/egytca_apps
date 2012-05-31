<h2>Administrador de Obras</h2>
<h1>Lista de Obras</h1>
<p>A continuación se muestra el listado de obras disponibles en el sistema, ud. podrá agregar nuevas o editar las existentes.</p>
<div id="divMsgBox"></div>
	<div id="div_construction">
	|-if $message eq "ok"-|
		<div class="successMessage">Obra guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Obra eliminada correctamente</div>
	|-/if-|

	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsEdit" class="addLink">Agregar Obra</a></div></th>
			</tr>
			<tr>
				<th width="40%">Obra</th>
				<th width="8%">Fecha</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$constructions item=construction name=for_calendaEvents-|
			<tr>
				<td>|-$construction->getName()-|</td>
				<td>|-$construction->getEndDate()|date_format-|</td>
				<td nowrap>|-if "constructionsEdit"|security_user_has_access-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="constructionsEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="constructionsDoDelete" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('Seguro que desea eliminar la obra?')" class="icon iconDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsEdit" class="addLink">Agregar Obra</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
