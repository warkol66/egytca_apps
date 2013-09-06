<h2>Newsletter</h2>
<h1>Administrar Newsletters Enviados</h1>
<div id="div_newsletters">
	<p>
	A continuación se presentan los envíos programados de newsletters realizados por el sistema. Puede agregar uno nuevo, editar uno existente o eliminarlo.
	</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Newsletter guardado correctamente</div>
	|-/if-|
	|-if $message eq "deleted_ok"-|
		<div class="successMessage">Newsletter eliminado correctamente</div>
	|-/if-|
	<table width="100%" cellpadding="0" cellspacing="0" class="tableTdBorders" id="tabla-newsletters">
		<col width="60%">
		<col width="35%">
		<col width="5%">
			<thead>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersEdit" class="addLink">Agregar Newsletter</a></div></th>
			</tr>
			<tr>
				<th>Asunto</th>
				<th>Fecha de Envío</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newsletters item=newsletter name=for_newsletters-|
			<tr>
				<td>|-$newsletter->getsubject()-|</td>
				<td>|-$newsletter->getsentAt()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="newslettersView" />
						<input type="hidden" name="id" value="|-$newsletter->getid()-|" />
						<input type="submit" name="submit_go_edit_newsletter" value="Ver" class="icon iconView" />
					</form>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="newslettersEdit" />
						<input type="hidden" name="id" value="|-$newsletter->getid()-|" />
						<input type="submit" name="submit_go_edit_newsletter" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="newslettersDoDelete" />
						<input type="hidden" name="id" value="|-$newsletter->getid()-|" />
						<input type="submit" name="submit_go_delete_newsletter" value="Borrar" onclick="return confirm('Seguro que desea eliminar el newsletter?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersEdit" class="addLink">Agregar Newsletter</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
