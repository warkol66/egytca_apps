<script type="text/javascript" >
	function createContractor(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('operationInfo',
					"Main.php?do=panelContractorsDoEditX",
					{
						method: 'post',
						parameters: { action: "panelContractorsDoEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('operationInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />'
		return false;
	}
</script>
	
<form name="form_edit_contractor" id="form_edit_contractor" action="Main.php" method="post">
	<legend>Formulario de Administración de Contratistas</legend>
			<div id="operationInfo"></div>
		<fieldset title="Formulario de edición de datos de un contratista">
			<p>
				<label for="params[name]">Razón Social</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="" title="Razón Social de la Empresa" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[cuit]">CUIT</label>
				<input type="text" id="params[cuit]" name="params[cuit]" size="15" value="" title="Número de CUIT" /><a class="tooltipWide" href="#"><span>Ingrese el CUIT sin espacios ni guiones.<br />(11 carracteres.)</span><img src="images/icon_info.gif"></a><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[address]">Dirección</label>
				<input type="text" id="params[address]" name="params[address]" size="70" value="" title="Dirección" />
			</p>
			<p>
				<label for="params[phone]">Teléfono</label>
				<input type="text" id="params[phone]" name="params[phone]" size="40" value="" title="Teléfono" />
			</p>
			<p>
				<label for="params[contact]">Contacto</label>
				<input type="text" id="params[contact]" name="params[contact]" size="50" value="" title="Contacto" />
			</p>
			<p>
				<input type="hidden" name="do" id="do" value="panelContractorsDoEditX" />
				<input type="button" id="button_edit_actor" name="button_edit_actor" title="Aceptar" value="Agregar" onClick="javascript:createContractor(this.form)"/>
				<a href="#" class="lbAction" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>
