<script type="text/javascript" language="javascript" >
	$('overlayForm').innerHTML += '<a href="javascript:void(0)" onclick="switch_vis_mult(new Array(\'overlayForm\',\'overlayFade\'));clearElement(\'overlayForm\');">Cancelar</a>	';
</script>

	<form name="form_edit_actor" id="form_edit_actor" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un actor">
			<legend>Formulario de Administración de ##actors,1,Actores##</legend>
			|-include file='ActorsForm.tpl'-|
			<p>
				<input type="hidden" name="do" id="do" value="actorsDoEditX" />
				<input type="submit" id="button_edit_actor" name="button_edit_actor" title="Aceptar" value="Agregar nuevo" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onclick="switch_vis_mult(new Array('overlayForm','overlayFade'))" />
			</p>
		</fieldset>
	</form>
