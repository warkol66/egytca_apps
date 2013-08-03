<h2>Newsletter</h2>
<h1>Listado de Envios Programados</h1>
<div id="div_newsletterschedules">
	|-if $message eq "ok"-|
		<div class="successMessage">Envío programado guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Envío programado eliminado correctamente</div>
	|-elseif $message eq "sent_ok"-|
		<div class="successMessage">Envío realizado enviado correctamente</div>
	|-elseif $message eq "sent_failed"-|
		<div class="failureMessage">El envío no se pudo realizar</div>
	|-/if-|

	<p>
	A continuación se presentan los envíos programados de newsletters disponibles en el sistema. Puede agregar uno nuevo, editar uno existente o eliminarlo.
	</p>
	<table width="100%" cellpadding="0" cellspacing="0" class="tableTdBorders" id="tabla-newsletterschedules">
		<col width="25%">
		<col width="40">
		<!--col width="15%"-->
		<col width="15%">
		<col width="5%">
			<thead>
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersSchedulesEdit" class="addLink">Agregar Envío Programado de Newsletter</a></div></th>
			</tr>
			<tr>
				<th>Plantilla</th>
				<th>Tipo de Envío</th>
				<!--th>Cluster</th-->
				<th>Estado</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newsletterschedules item=newsletterschedule name=for_newsletterschedules-|
			<tr>
				<td>|-assign var=template value=$newsletterschedule->getnewsletterTemplate()-||-if $template neq ''-||-$template->getName()-||-/if-|</td>
				<td>|-$newsletterschedule->getScheduleDescription()-|</td>
				<!--td>|- assign var=cluster value=$newsletterschedule->getSegmentationCluster()-||-if $cluster eq ''-|No Asignado|-else-||-$cluster->getName()-||-/if-|</td-->
				<td>|-if $newsletterschedule->getactive() eq 1-|Activo|-else-|Inactivo|-/if-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="newslettersSchedulesEdit" />
						<input type="hidden" name="id" value="|-$newsletterschedule->getid()-|" />
						<input type="submit" name="submit_go_edit_newsletterschedule" value="Editar" title="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="newslettersExecuteDelivery" />
						<input type="hidden" name="id" value="|-$newsletterschedule->getid()-|" />
						<input type="submit" name="submit_execute_delete_newsletterschedule" value="Enviar Ahora" title="Enviar Ahora" onclick="return confirm('Esta seguro que desear realizar el envio?')" class="icon iconEmail" />
					</form>					
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="newslettersSchedulesDoDelete" />
						<input type="hidden" name="id" value="|-$newsletterschedule->getid()-|" />
						<input type="submit" name="submit_go_delete_newsletterschedule" value="Eliminar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el newsletterschedule?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
		<tfoot>
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
		|-if $newsletterschedules|count gt 5-|
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersSchedulesEdit" class="addLink">Agregar Envío Programado de Newsletter</a></div></th>
			</tr>
		|-/if-|
		</tfoot>	
	</table>
</div>
