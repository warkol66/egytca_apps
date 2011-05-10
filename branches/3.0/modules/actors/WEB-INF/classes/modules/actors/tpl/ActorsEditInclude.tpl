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
</script>
	
	<form name="form_edit_actor" id="form_edit_actor" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un ##actors,2,Actor##">
			<legend>Formulario de Creación de ##actors,1,Actores##</legend>
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
				<label for="params[institution]">##actors,3,Institución##</label>
				<input type="text" id="params[institution]" name="params[institution]" size="70" value="" title="##actors,3,Institución##" />
			</p>
			<p>
				<input type="hidden" name="do" id="do" value="actorsDoEditX" />
				<input type="button" id="button_edit_actor" name="button_edit_actor" title="Aceptar" value="Agregar nuevo" onClick="javascript:createActor(this.form)"/>
				<a href="#" class="lbAction" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>