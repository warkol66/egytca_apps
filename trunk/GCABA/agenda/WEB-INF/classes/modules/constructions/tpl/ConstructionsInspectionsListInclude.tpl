<h3>Relevamientos</h3>
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsInspectionsEdit&constructionId=|-$constructionId-|" class="addLink">Agregar Relevamiento</a></div></th>
			</tr>
			<tr>
				<th width="40%">Relevamiento</th>
				<th width="8%">Fecha</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inspections item=inspection name=for_inspections-|
			<tr>
				<td>|-$inspection->getVisitDate()|date_format-|</td>
				<td>|-assign var=inspector value=$inspection->getInspector()-||-$inspector-|</td>
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
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=constructionsInspectionsEdit&constructionId=|-$constructionId-|" class="addLink">Agregar Relevamiento</a></div></th>
			</tr>
		</tbody>
	</table>
