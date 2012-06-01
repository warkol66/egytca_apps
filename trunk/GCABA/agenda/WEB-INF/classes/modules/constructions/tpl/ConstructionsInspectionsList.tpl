<h2>Administrador de Relevamientos</h2>
<h1>Lista de Relevamientos</h1>
<p>A continuación se muestra el listado de relevamientos disponibles en el sistema, ud. podrá agregar nuevas o editar las existentes.</p>
<div id="divMsgBox"></div>
	<div id="div_construction">
	|-if $message eq "ok"-|
		<div class="successMessage">Relevamiento guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Relevamiento eliminado correctamente</div>
	|-/if-|

	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsInspectionsEdit" class="addLink">Agregar Relevamiento</a></div></th>
			</tr>
			<tr>
			  <th width="40%">Obra</th>
				<th width="3%">Fecha</th>
				<th width="20%">Relevador</th>
				<th width="25%">Dependencia</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inspections item=inspection name=for_inspections-|
			<tr>
			  <td>|-assign var=construction value=$inspection->getConstruction()-||-$construction-|</td>
				<td align="center" nowrap="nowrap">|-$inspection->getVisitDate()|date_format-|</td>
				<td>|-$inspection->getInspector()-|</td>
				<td>|-if !empty($construction)-||-assign var=category value=$construction->getCategory()-||-$category-||-/if-|</td>
				<td nowrap>|-if "inspectionsInspectionsEdit"|security_user_has_access-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="constructionsInspectionsEdit" />
						<input type="hidden" name="id" value="|-$inspection->getid()-|" />
						<input type="submit" name="submit_go_edit_inspection" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="constructionsInspectionsDoDelete" />
						<input type="hidden" name="id" value="|-$inspection->getid()-|" />
						<input type="submit" name="submit_go_delete_inspection" value="Borrar" onclick="return confirm('Seguro que desea eliminar el relevamiento?')" class="icon iconDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="5" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsInspectionsEdit" class="addLink">Agregar Relevamiento</a></div></th>
			</tr>
	  </tbody>
	</table>
</div>
