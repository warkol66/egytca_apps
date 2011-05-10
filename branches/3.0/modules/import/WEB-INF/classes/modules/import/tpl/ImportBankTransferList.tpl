<h2>Exportaciones</h2>
<h1>Transferencias Bancarias</h1>
<p></p>

<div id="div_messages">
	|-if $message eq "ok"-|
		<div class="successMessage">Se han guardado con exito la transferencia bancaria.</div>
	|-/if-|
</div>

<div id="div_transfers">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-bank-transfers">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importBankTransferEdit" class="addLink">Agregar Transferencia Bancaria</a></div></th>
			</tr>
			<tr>
				<th>Id</th>
				<th>Cuenta Origen</th>
				<th>Numero de Transferencia</th>
				<th>Monto</th>
				<th>Orden de Proveedor Relacionada</th>
				<th>Fecha</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$transfers item=transfer name=for_transfer-|
			<tr>
				<td>|-$transfer->getId()-|</td>
				<td>|-assign var=account value=$transfer->getBankAccount()-||-$account->getDescription()-|</td>
				<td>|-$transfer->getBankTransferNumber()-|</td>
				<td>|-$transfer->getAmount()-|</td>
				<td>|-$transfer->getSupplierPurchaseOrderId()-|</td>
				<td>|-$transfer->getCreatedAt()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importBankTransferEdit" />
						<input type="hidden" name="id" value="|-$transfer->getid()-|" />
						<input type="submit" name="submit_go_edit_transfer" value="Editar" class="iconEdit" title="Editar" alt="Editar" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
		</tbody>
	</table>
</div>
