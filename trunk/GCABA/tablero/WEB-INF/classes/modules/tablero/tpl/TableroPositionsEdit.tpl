<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Cargo</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<script type="text/javascript" language="javascript">
function tableroPositionsGetAllParentsX(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'positionMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('positionMsgField').innerHTML = '<p><span class="inProgress">buscando línea de reporte...</span></p>';
	return true;
}
</script>
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| un cargo en el sistema.</p>
<div id="div_position">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar el cargo</div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de un cargo">
     <legend>Ingrese los datos del Cargo</legend>
	<form action="Main.php" method="post">
		<input type="hidden" name="do" value="tableroPositionsGetAllParentsX" />
<p>
      <label for="positionDataX[type]">Tipo</label>
|-if $action eq "edit"-|
|-$position->getRegionTypeTranslated()-|
|-else-|<select id="positionDataX[type]" name="positionDataX[type]" title="type" onChange="javascript:tableroPositionsGetAllParentsX(this.form)">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$positionTypes key=typeKey item=type name=for_type-|
 				|-if $typeKey gt constant("TableroPositionPeer::TREE_ROOT_TYPE")-|
        <option value="|-$typeKey-|">|-$type-|</option>
				|-/if-|
			|-/foreach-|
      </select>|-/if-|</p>
		</form>
	<form name="form_edit_position" id="form_edit_position" action="Main.php" method="post">
|-if $action eq "edit"-|
<p>
  <label for="positionData[parentId]">Reporta a</label>
  <select id="positionData[parentId]" name="positionData[parentId]" title="parentId"> 
	|-if $type eq constant("TableroPositionPeer::LOWEST_TYPE") or empty($positions)-|
    <option value="0" selected="selected">Ninguno</option> 
	|-/if-|
	|-foreach from=$positions item=parent name=for_parent-|
   |-assign var=level value=$parent->getType()-|<option value="|-$parent->getId()-|" |-if $position->getParentId() eq $parent->getId()-|selected="selected" |-/if-|>|-section name=space loop=$level-|&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>

|-else-|
<span id="positionMsgField"></span>
|-/if-|
	<p><label for="positionData[name]">Cargo</label>
				<input name="positionData[name]" type="text" id="positionData[name]" title="name" value="|-if $action eq 'edit'-||-$position->getName()-||-/if-|" size="60" maxlength="100" />
	</p>			|-if $action eq "edit"-|
	<p>			<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$position->getId()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="tableroPositionsDoEdit" />
				<br>
				<input type="submit" id="button_edit_position" name="button_edit_position" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_position" name="button_return_position" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=tableroPositionsList'" />
				<input type="hidden" name="positionData[type]" id="positionData[type]" value="|-$type-|" /></p>
	</form>
		</fieldset>
</div>
