<script type="text/javascript" language="javascript" >
	$('overlayForm').innerHTML += '<a href="javascript:void(0)" onclick="switch_vis_mult(new Array(\'overlayForm\',\'overlayFade\'));clearElement(\'overlayForm\');">Cancelar</a>	';
</script>

	<form name="form_edit_type" id="form_edit_type" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un actor">
			<legend>Formulario de Administración de ##actors,1,Actores##</legend>
			<p>
				<label for="params[title]">Título</label>
				<input type="text" id="params[title]" name="params[title]" size="50" value="|-$mediaType->gettitle()|escape-|" title="title" />
			</p>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$mediaType->getname()|escape-|" title="Nombre" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[surname]">Apellido</label>
				<input type="text" id="params[surname]" name="params[surname]" size="50" value="|-$mediaType->getsurname()|escape-|" title="Apellido" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[institution]">##actors,3,Institución##</label>
				<input type="text" id="params[institution]" name="params[institution]" size="70" value="|-$mediaType->getinstitution()|escape-|" title="##actors,3,Institución##" />
			</p>
			<p>
				<input type="hidden" name="do" id="do" value="mediasTypeDoEditX" />
				<input type="submit" id="button_edit_type" name="button_edit_type" title="Aceptar" value="Agregar nuevo" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onclick="switch_vis_mult(new Array('overlayForm','overlayFade'))" />
			</p>
		</fieldset>
	</form>
