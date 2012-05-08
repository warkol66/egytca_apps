<h2>Tablero de Gestión</h2>
<h1>|-if $action eq 'edit'-|Edit|-else-|Create|-/if-| Contratista</h1>
<div id="div_contractor">
	<p>Ingrese los datos del Contratista</p>
		<p><a href="#" onClick="location.href='Main.php?do=panelContractorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el contratista</span>|-/if-|
	<form name="form_edit_contractor" id="form_edit_contractor" action="Main.php" method="post">
	<legend>Formulario de Administración de Contratistas</legend>
		<fieldset title="Formulario de edición de datos de un contratista">
			<p>
				<label for="params[name]">Razón Social</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$contractor->getname()|escape-|" title="Razón Social de la Empresa" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[cuit]">CUIT</label>
				<input type="text" id="params[cuit]" name="params[cuit]" size="15" value="|-$contractor->getcuit()|escape-|" title="Número de CUIT" /><a class="tooltipWide" href="#"><span>Ingrese el CUIT sin espacios ni guiones.<br />(11 carracteres.)</span><img src="images/icon_info.gif"></a><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[address]">Dirección</label>
				<input type="text" id="params[address]" name="params[address]" size="70" value="|-$contractor->getaddress()|escape-|" title="Dirección" />
			</p>
			<p>
				<label for="params[phone]">Teléfono</label>
				<input type="text" id="params[phone]" name="params[phone]" size="40" value="|-$contractor->getphone()|escape-|" title="Teléfono" />
			</p>
			<p>
				<label for="params[contact]">Contacto</label>
				<input type="text" id="params[contact]" name="params[contact]" size="50" value="|-$contractor->getcontact()|escape-|" title="Contacto" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$contractor->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="panelContractorsDoEdit" />
				<input type="submit" id="button_edit_contractor" name="button_edit_contractor" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=panelContractorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
		</fieldset>
	</form>
</div>
