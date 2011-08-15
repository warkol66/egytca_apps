<script type="text/javascript" language="javascript" >
	$('overlayForm').innerHTML += '<a href="javascript:void(0)" onclick="switch_vis_mult(new Array(\'overlayForm\',\'overlayFade\'));clearElement(\'overlayForm\');">Cancelar</a>	';
</script>

	<form name="form_edit_media" id="form_edit_media" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un medio">
			<legend>Formulario de Administración de ##medias,1,Medios##</legend>
			<p>
				<label for="params[title]">Título</label>
				<input type="text" id="params[title]" name="params[title]" size="50" value="|-$media->gettitle()|escape-|" title="title" />
			</p>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$media->getname()|escape-|" title="Nombre" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[surname]">Apellido</label>
				<input type="text" id="params[surname]" name="params[surname]" size="50" value="|-$media->getsurname()|escape-|" title="Apellido" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[institution]">##medias,3,Institución##</label>
				<input type="text" id="params[institution]" name="params[institution]" size="70" value="|-$media->getinstitution()|escape-|" title="##medias,3,Institución##" />
			</p>
			<p>
				<input type="hidden" name="do" id="do" value="mediasDoEditX" />
				<input type="submit" id="button_edit_media" name="button_edit_media" title="Aceptar" value="Agregar nuevo" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onclick="switch_vis_mult(new Array('overlayForm','overlayFade'))" />
			</p>
		</fieldset>
	</form>
