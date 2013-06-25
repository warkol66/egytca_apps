<h2>Newsletters</h2>
<h1>Listado de Plantillas Externas de Newsletter</h1>
<div id="div_newslettertemplateexternals">
	<p>
	A continuación se presentan las plantillas externas para newsletter disponibles en el sistema. Puede agregar una nueva plantilla, editar una existente o eliminarla.
	</p>

|-if $message eq "ok"-|
	<div class="resultSuccess">Plantilla externa de Newsletter guardada correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="resultSuccess">Plantilla externa de Newsletter eliminad correctamente</div>
|-/if-|
	<table width="100%" class="tableTdBorders" id="tabla-newslettertemplateexternals">
		<col width="95%">
		<col width="5%">
			<thead>
			<tr>
				<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersTemplateExternalsEdit" class="addLink">Agregar Plantilla Externa de Newsletter</a></div></th>
			</tr>
			<tr>
				<th>Nombre Plantilla Externa</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newslettertemplateexternals item=newslettertemplateexternal name=for_newslettertemplateexternals-|
			<tr>
				<td>|-$newslettertemplateexternal->getname()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="newslettersTemplateExternalsEdit" />
						<input type="hidden" name="id" value="|-$newslettertemplateexternal->getid()-|" />
						<input type="submit" name="submit_go_edit_newslettertemplateexternal" value="Editar" class="buttonImageEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="newslettersTemplateExternalsDoDel" />
						<input type="hidden" name="id" value="|-$newslettertemplateexternal->getid()-|" />
						<input type="submit" name="submit_go_delete_newslettertemplateexternal" value="Borrar" onclick="return confirm('Seguro que desea eliminar el newslettertemplateexternal?')" class="buttonImageDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersTemplateExternalsEdit" class="addLink">Agregar Plantilla Externa de Newsletter</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
