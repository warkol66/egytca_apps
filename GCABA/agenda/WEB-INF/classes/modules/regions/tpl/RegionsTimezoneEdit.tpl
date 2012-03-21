<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Región</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<script type="text/javascript" language="javascript">
function regionsTimezoneGetAllParentsByRegionX(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('regionMsgField').innerHTML = '<p><span class="inProgress">buscando padres...</span></p>';
	return true;
}
</script>
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una región del sistema.</p>
<div id="div_region">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la región </div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de una región">
     <legend>Ingrese los datos de la Región</legend>
	<form action="Main.php" method="post">
				<input type="hidden" name="do" value="regionsTimezoneGetAllParentsByRegionX" />
<p>
      <label for="regionDataX[type]">Tipo</label>
<select id="regionDataX[type]" name="regionDataX[type]" title="type" onChange="javascript:regionsTimezoneGetAllParentsByRegionX(this.form)">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$regionstimezone key=typeKey item=type name=for_type-|
        <option value="|-$typeKey-|" >|-$type-|</option> 
			|-/foreach-|
      </select></p>
		</form>
	<form name="form_edit_region" id="form_edit_region" action="Main.php" method="post">
|-if $action eq "edit"-|
<p>
  <label for="regionData[parentId]">Dentro de</label>
  <select id="regionData[parentId]" name="regionData[parentId]" title="parentId"> 
			|-foreach from=$continents key=typeKey item=type name=for_type-|
        <option value="|-$typeKey-|">|-$type-|</option> 
			|-/foreach-|
  </select>
</p>

|-else-|
<span id="regionMsgField"></span>
|-/if-|
	<p><label for="regionData[name]">Nombre</label>
				<input name="regionData[name]" type="text" id="regionData[name]" title="name" value="|-if $action eq 'edit'-||-$region->getName()-||-/if-|" size="60" maxlength="100" />
	</p>			|-if $action eq "edit"-|
	<p>			<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$region->getId()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="regionsTimezoneDoEdit" />
				<br>
				<input type="submit" id="button_edit_region" name="button_edit_region" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_region" name="button_return_region" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=regionsTimezoneList'" />
				<input type="hidden" name="regionData[type]" id="regionData[type]" value="|-$type-|" /></p>
	</form>
		</fieldset>
</div>
