<script type="text/javascript" >
	function createTag(form) {
		$.ajax({
			url: 'Main.php?do=blogTagsDoEditX', 
			data: $(form).serialize(),
			type: 'post',
			success: function(data){
				$('#operationInfo').html(data);
			}
		});
		$('#operationInfo').html('<span class="inProgress">Procesando información</span>');
		return false;
	}
</script>
	
<fieldset title="Formulario de edición de datos de una etiqueta">
 <legend>Ingrese los datos de la etiqueta</legend>
			<div id="operationInfo"></div>
	<form id="form_edit_tag" name="form_edit_tag" action="Main.php" method="post">
	<p><label for="params[name]">Nombre</label>
		<input name="params[name]" type="text" id="params_name" title="Nombre" value="" size="60" maxlength="100" />
	</p>
	<p>			
		<input type="hidden" name="do" id="do" value="blogTagsDoEditX" />
		<input type="hidden" name="fromBlog" id="fromBlog" value="true" />
		<input type="button" id="button_edit_actor" name="button_edit_actor" title="Aceptar" value="Agregar" onClick="javascript:createTag(this.form)"/>
		<a href="javascript:$.fancybox.close();" class="lbAction" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
</p>
	</form>
</fieldset>

