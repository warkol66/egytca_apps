<h2>Cuentas bancarias</h2>
<h1>Administración de Cuentas Bancarias</h1>
<div id="div_bankaccounts">
	|-if $message eq "ok"-|
		<div class="successMessage">Cuentas bancaria guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Cuentas bancaria eliminada correctamente</div>
	|-/if-|
<p>A continuación se muestra el listado de cuentas bancarias que están disponibles en el sistema, estas información se utiliza para relacionar las transferencias de pago a proveedores. Puede agregar un nueva cuenta, o modificar o eliminar una existe.
	<table id="tabla-bankaccounts" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
		<thead>
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importBankAccountsEdit" class="addLink" title="Agregar Cuentas Bancaria">Agregar Cuenta Bancaria</a></div></th>
			</tr>
			<tr>
				<th>ID</th>
				<th>Banco</th>                				
				<th>Número de Cuenta</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$bankaccounts item=bankaccount name=for_bankaccounts-|
			<tr>
				<td>|-$bankaccount->getid()-|</td>
				<td>|-$bankaccount->getbank()-|</td>
				<td>|-$bankaccount->getaccountNumber()-|</td>
				<td>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="importBankAccountsEdit" />
						<input type="hidden" name="id" value="|-$bankaccount->getid()-|" />
						<input type="submit" name="submit_go_edit_bankaccount" value="Editar" class="iconEdit" title="Editar"/>
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importBankAccountsDoDelete" />
						<input type="hidden" name="id" value="|-$bankaccount->getid()-|" />
						<input type="submit" name="submit_go_delete_bankaccount" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar la cuenta?')" class="iconDelete" title="Eliminar" />
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
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importBankAccountsEdit" class="addLink" title="Agregar Cuentas Bancaria">Agregar Cuenta Bancaria</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
