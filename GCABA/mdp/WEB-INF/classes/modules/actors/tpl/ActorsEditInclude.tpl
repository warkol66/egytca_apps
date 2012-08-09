<script type="text/javascript" >
	function createActor(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('operationInfo',
					"Main.php?do=actorsDoEditX",
					{
						method: 'post',
						parameters: { action: "actorsDoEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('operationInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />'
		return false;
	}
	function createActorAfterValidateFormClienSide(form) {
		var success = validationValidateFormClienSide(form, false);
		if (success) {
			createActor(form);
			clearFormFieldsFormat(form);
		}
	}
</script>
	
	<form name="form_edit_actor" id="form_edit_actor" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un ##actors,2,Actor##">
			<legend>Formulario de Creación de ##actors,1,Actores##</legend>
			<div id="operationInfo"></div>
			|-include file='ActorsForm.tpl'-|
			<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
			<p>
				<input type="hidden" name="do" id="do" value="actorsDoEditX" />
				<input type="button" id="button_edit_actor" name="button_edit_actor" title="Aceptar" value="Agregar nuevo" onClick="javascript:createActorAfterValidateFormClienSide(this.form)"/>
				<a href="#" class="lbAction noDecoration" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>