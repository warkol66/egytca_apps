<h2>Cuentas Bancarias</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Cuentas Bancaria</h1>
<div id="div_bankaccount">
	|-if $message eq "error"-|
		<div class="faulureMessage">Ha ocurrido un error al intentar guardar la cuenta bancaria</div>
	|-/if-|
	|-if $action eq "edit"-|
		<p>A continuación se muestra la información de la cuenta, modificar la información, ingrese los datos y haga click en "Aceptar" para guardar los cambios.</p>
	|-else-|
		<p>Para crear una cuenta, ingrese la información en el formulario y haga click en "Aceptar" para crear la cuenta.</p>
	|-/if-|
	<form name="form_edit_bankaccount" id="form_edit_bankaccount" action="Main.php" method="post">
		<fieldset title="Formulario de datos de cuenta bancaria">
			<legend>Información de la Cuenta</legend>
		<p>Ingrese los datos de la cuenta
		</p>
			<p>
				<label for="bankaccount_bank">Banco</label>
				<input name="bankaccount[bank]" type="text" id="bankaccount_bank" title="Banco" value="|-$bankaccount->getbank()-|" size="45" maxlength="255" />
			</p>						
			<p>
				<label for="bankaccount_accountNumber">Número de Cuenta</label>
				<input name="bankaccount[accountNumber]" type="text" id="bankaccount_accountNumber" title="Número de Cuenta" value="|-$bankaccount->getaccountNumber()-|" size="25" maxlength="255" />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="bankaccount[id]" id="bankaccount_id" value="|-$bankaccount->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="importBankAccountsDoEdit" />
				<input type="submit" id="button_edit_bankaccount" name="button_edit_bankaccount" title="Aceptar" value="Aceptar" class="boton" />
			</p>
				</fieldset>
	</form>
</div>
