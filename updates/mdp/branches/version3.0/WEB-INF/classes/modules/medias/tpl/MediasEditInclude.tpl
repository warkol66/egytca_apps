<script type="text/javascript" >
	function createActor(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('operationInfo',
					"Main.php?do=mediasDoEditX",
					{
						method: 'post',
						parameters: { action: "mediasDoEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('operationInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />'
		return false;
	}
</script>
	
	<form name="form_edit_media" id="form_edit_media" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un ##medias,2,Medio##">
			<legend>Formulario de Creación de ##medias,1,Medios##</legend>
			<div id="operationInfo"></div>
			<p>
				<label for="params[title]">Título</label>
				<input type="text" id="params[title]" name="params[title]" size="20" value="" title="title" />
			</p>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="" title="Nombre" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[surname]">Apellido</label>
				<input type="text" id="params[surname]" name="params[surname]" size="50" value="" title="Apellido" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[institution]">##medias,3,Institución##</label>
				<input type="text" id="params[institution]" name="params[institution]" size="70" value="" title="##medias,3,Institución##" />
			</p>
			<p>
				<input type="hidden" name="do" id="do" value="mediasDoEditX" />
				<input type="button" id="button_edit_media" name="button_edit_media" title="Aceptar" value="Agregar nuevo" onClick="javascript:createActor(this.form)"/>
				<a href="#" class="lbAction" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>