<script type="text/javascript" >
	function createIssue(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('operationInfo',
					"Main.php?do=issuesDoEditX",
					{
						method: 'post',
						parameters: { action: "issuesDoEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('operationInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />'
		return false;
	}
</script>
	
	<form name="form_edit_issue" id="form_edit_issue" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un ##issues,2,Asunto##">
			<legend>Formulario de Creación de ##issues,1,Asuntos##</legend>
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
				<label for="params[institution]">##issues,3,Institución##</label>
				<input type="text" id="params[institution]" name="params[institution]" size="70" value="" title="##issues,3,Institución##" />
			</p>
			<p>
				<input type="hidden" name="do" id="do" value="issuesDoEditX" />
				<input type="button" id="button_edit_issue" name="button_edit_issue" title="Aceptar" value="Agregar nuevo" onClick="javascript:createIssue(this.form)"/>
				<a href="#" class="lbAction" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>