|-if !$notValidId-|
|-if $do eq "profilesView"-|
<h2>Configuración del Sistema</h2>
	<h1>Visualización de perfiles</h1>
	<p>En esta sección podrá vel el perfil del Actor.</p>
|-elseif $do eq "profilesEdit"-|
<h2>Configuración del Sistema</h2>
	<h1>Edición de Perfiles</h1>
	<p>En esta sección podrá modificar la información de caracterización del Actor.</p>|-/if-|
<form method="get" action="Main.php">
	<input type="hidden" name="do" value="|-$do-|" />
	|-if $actor ne ""-|
	<input type="hidden" name="actor" value="|-$actor->getId()-|" />
	|-/if-|
	|-if $actor1 ne ""-|
	<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
	|-/if-|
	|-if $actor2 ne ""-|
	<input type="hidden" name="actor2" value="|-$actor2->getId()-|" />
	|-/if-|
	<table class="tableTdBorders" border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr>
			<td class="celltitulo2" nowrap="nowrap" width="35%">Seleccione un formulario</td>
			<td class="celldato">
				<select name="form" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" >
					|-foreach from=$forms item=form-|
					<option value="|-$form->getId()-|">|-$form->getName()-|</option>
					|-/foreach-|
					<option value="" selected="selected">Seleccione un formulario</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="cellboton" colspan="2"><input value="##120,Continuar##" type="submit">
				&nbsp;&nbsp;
				<input onclick="history.go(-1)" value="##104,Regresar##" type="button"></td>
		</tr>
	</table>
</form>
|-else-|
<div class="errorMessage">El identificador del actor ingresado no es válido. Seleccione un item del listado.</div>
<input onclick="history.go(-1)" value="##104,Regresar##" type="button">|-/if-|