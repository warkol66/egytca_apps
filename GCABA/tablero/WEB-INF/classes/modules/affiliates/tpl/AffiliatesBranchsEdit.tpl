<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Oficinas|-if $action eq "edit"-| - |-$branch->getname()-||-/if-|</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $accion eq "edicion"-|
	<p class='paragraphEdit'>##180,Realice los cambios en la oficina y haga click en "Guardar Cambios" para guardar las modificaciones. ##</p>
|-else-|
	<p>A continuación podrá editar la información de las oficinas de las dependencias.</p>
|-/if-|
 <div id="div_branch"> 
	<form name="form_edit_branch" id="form_edit_branch" action="Main.php" method="post">
		|-if $action eq "edit"-|
			<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$branch->getid()-||-/if-|" />
		|-/if-|
		<input type="hidden" name="action" id="action" value="|-$action-|" /> 
		<input type="hidden" name="do" id="do" value="affiliatesBranchsDoEdit" /> 
 		|-if $message eq "error"-|<span class="errorMessage">Ha ocurrido un error al intentar guardar la sucursal</span>|-/if-|
		<p> Ingrese los datos de la Oficina.</p> 
	<table width="100%" border="0" cellspacing="0" cellpadding="5" class="tableTdBorders">
 		|-if $all eq "1"-|
	<tr>
		<td class="tdTitle">Dependencia</td>
		<td class="tdSize1"><select id="affiliateId" name="affiliateId"> 
				<option value="">Seleccionar Dependencia</option> 
									|-foreach from=$affiliates item=affiliate-|
				<option value="|-$affiliate->getId()-|"|-if $action eq "edit" and $branch->getAffiliateId() eq $affiliate->getId()-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option> 
									|-/foreach-|									
			</select> 
</td>
	</tr>
		|-/if-|
	<tr>
		<td class="tdTitle">Número de Oficina </td>
		<td class="tdSize1"><input type="text" id="number" name="number" value="|-if $action eq 'edit'-||-$branch->getnumber()-||-/if-|" size="15" title="number" /></td>
	</tr>
	<tr>
		<td class="tdTitle">Código de Oficina </td>
		<td class="tdSize1"><input type="text" id="code" name="code" value="|-if $action eq 'edit'-||-$branch->getCode()-||-/if-|" size="15" title="code" /></td>
	</tr>	
	<tr>
		<td class="tdTitle">Nombre de Oficina</td>
		<td class="tdSize1"><input type="text" id="name" name="name" value="|-if $action eq 'edit'-||-$branch->getname()-||-/if-|" title="name" size="45" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="tdTitle">Teléfono</td>
		<td class="tdSize1"><input type="text" id="phone" name="phone" value="|-if $action eq 'edit'-||-$branch->getphone()-||-/if-|" title="phone" size="45" maxlength="100" /></td>
	</tr>
	<tr>
		<td class="tdTitle">Contacto</td>
		<td class="tdSize1"><input type="text" id="contact" name="contact" value="|-if $action eq 'edit'-||-$branch->getcontact()-||-/if-|" title="contact" size="55" maxlength="50" /></td>
	</tr>
	<tr>
		<td class="tdTitle">Email contacto</td>
		<td class="tdSize1"><input type="text" id="contactEmail" name="contactEmail" value="|-if $action eq 'edit'-||-$branch->getcontactEmail()-||-/if-|" title="contactEmail" size="45" maxlength="100" /></td>
	</tr>
	<tr>
		<td class="tdTitle">Memo</td>
		<td class="tdSize1"><textarea name="memo" cols="60" rows="5" wrap="VIRTUAL" id="memo">|-if $action eq 'edit'-||-$branch->getmemo()-||-/if-|</textarea></td>
	</tr>
	<tr>
		<td colspan="2" class="buttonCell"><input type="submit" id="button_edit_branch" name="button_edit_branch" title="Aceptar" value="Aceptar" class="button" /></td>
		</tr>
</table>
	</form> 
</div>
