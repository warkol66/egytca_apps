<script language="JavaScript" type="text/javascript">
function indicatorsAddCategoryToIndicator(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">agregando categoría al indicador...</span>';
	
	return true;
}

function indicatorsDeleteCategoryFromIndicator(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">eliminando categoría del indicador...</span>';
	
	return true;

}
</script>
<h2>Indicadores</h2>
	|-if !$notValidId-|
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Indicador</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| un indicador del sistema.</p>
<div id="div_indicator">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar el indicador</div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de un indicador">
     <legend>Ingrese los datos del Indicador</legend>
	<form action="Main.php" method="post">
	<p><label for="indicatorData[name]">Nombre</label>
				<input name="indicatorData[name]" type="text" id="indicatorData[name]" title="name" value="|-if $action eq 'edit'-||-$indicator->getName()-||-/if-|" size="60" maxlength="100" />
	</p>
	<p><label for="indicatorData[type]">Tipo de gráfico</label>
			<select id="indicatorData[type]" name="indicatorData[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$indicatorsTypes key=typeKey item=type name=for_type-|
        <option value="|-$typeKey-|"|-if $action eq 'edit'-||-if $typeKey eq $indicator->getType()-| selected="selected"|-/if-||-/if-|>|-$type-|</option> 
			|-/foreach-|
      </select>
	</p>
	<div id="graphVarialbles" style="|-if $indicator->getType() neq constant('IndicatorPeer::PIE')-|display:block|-else-|display:none|-/if-|;">
	<p><label for="indicatorData[labelX]">Etiqueta en eje X</label>
				<input name="indicatorData[labelX]" type="text" id="indicatorData[labelX]" title="labelX" value="|-if $action eq 'edit'-||-$indicator->getLabelX()-||-/if-|" size="60" maxlength="100" />
	</p>
	<p><label for="indicatorData[labelY]">Etiqueta en eje Y</label>
				<input name="indicatorData[labelY]" type="text" id="indicatorData[labelY]" title="labelX" value="|-if $action eq 'edit'-||-$indicator->getLabelY()-||-/if-|" size="60" maxlength="100" />
	</p>
	<p><label for="indicatorData[minX]">Mínimo valor X</label>
				<input name="indicatorData[minX]" type="text" id="indicatorData[minX]" title="minX" value="|-if $action eq 'edit'-||-$indicator->getMinX()-||-/if-|" size="8" maxlength="100" />
	</p>
	<p><label for="indicatorData[maxX]">Máximo valor X</label>
				<input name="indicatorData[maxX]" type="text" id="indicatorData[maxX]" title="maxX" value="|-if $action eq 'edit'-||-$indicator->getMaxX()-||-/if-|" size="8" maxlength="100" />
	</p>
	<p><label for="indicatorData[minY]">Mínimo valor Y</label>
				<input name="indicatorData[minY]" type="text" id="indicatorData[minY]" title="minY" value="|-if $action eq 'edit'-||-$indicator->getMinY()-||-/if-|" size="8" maxlength="100" />
	</p>
	<p><label for="indicatorData[maxY]">Máximo valor Y</label>
				<input name="indicatorData[maxY]" type="text" id="indicatorData[maxY]" title="maxY" value="|-if $action eq 'edit'-||-$indicator->getMaxY()-||-/if-|" size="8" maxlength="100" />
	</p>
	</div>
	<p><label for="indicatorData[showValue]">Mostrar valor</label>
				<input name="indicatorData[showValue]" type="text" id="indicatorData[showValue]" title="showValue" value="|-if $action eq 'edit'-||-$indicator->getShowValue()-||-/if-|" size="4" />
	</p>
	<p><label for="indicatorData[valueType]">Tipo de valor</label>
				<input name="indicatorData[valueType]" type="text" id="indicatorData[valueType]" title="valueType" value="|-if $action eq 'edit'-||-$indicator->getValueType()-||-/if-|" size="4" />
	</p>
	<p><label for="indicatorData[decimals]">Decimales</label>
				<input name="indicatorData[decimals]" type="text" id="indicatorData[decimals]" title="decimals" value="|-if $action eq 'edit'-||-$indicator->getDecimals()-||-/if-|" size="4" />
	</p>

	<p>			
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="indicatorsDoEdit" />
				<br>
				<input type="submit" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" />
	|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$indicator->getId()-|" />
				<input type="button" id="button_edit_series" name="button_edit_series" title="Editar Series" value="Editar Series" onClick="location.href='Main.php?do=indicatorsSeriesEdit&id=|-$indicator->getId()-|'" />
				<input type="hidden" name="id" id="id" value="|-$indicator->getId()-|" />
				<input type="button" id="button_edit_xs" name="button_edit_xs" title="Editar Variables" value="Editar Variables" onClick="location.href='Main.php?do=indicatorsXsEdit&id=|-$indicator->getId()-|'" />
				<input type="hidden" name="id" id="id" value="|-$indicator->getId()-|" />
				<input type="button" id="button_edit_ys" name="button_edit_ys" title="Editar Valores" value="Editar Valores" onClick="location.href='Main.php?do=indicatorsYsEdit&id=|-$indicator->getId()-|'" />
	|-/if-|

				<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsList'" />
	</form>
		</fieldset>
</div>
|-if $action == "edit"-|
<p>Las categorías de indicadores le permiten relacionar un indicador con una o mas categorías. Para agregar una categoría a un indicador, seleccione la categoría deseada y haga click en "Agregar categoría".<br />
Para eliminar una categoría, haga click en el ícono de eliminar junto al nombre de la categoría que desea eliminar.</p>
<fieldset title="Formulario de edición de categorías del indicador">
	<legend>Categorías</legend>
  <div id="CategoryAdding"> <span id="categoryMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="categoryId" name="categoryId" title="Categoría" > 
      <option value="">Seleccione una categoría</option>
    	|-foreach from=$categoryCandidates item=category name=for_categories-|
        <option id="categoryOption|-$category->getId()-|" value="|-$category->getId()-|">|-$category->getName()-|</option> 
    	|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="indicatorsDoAddCategoryToIndicatorX" /> 
      <input type="hidden" name="indicatorId" id="indicatorId" value="|-$indicator->getId()-|" /> 
      <input type="button" value="Agregar Categoría" onClick="javascript:indicatorsAddCategoryToIndicator(this.form)"/> 
    </p> 
  </form> 
  <ul id="categoryList">
     |-foreach from=$actualCategories item=category name=for_actualCategories-|
		
    <li id="categoryListItem|-$category->getId()-|">|-$category->getName()-|
       |-if $category->getId() > 0-|<form  method="post"> 
        <input type="hidden" name="do" id="do" value="indicatorsDoDeleteCategoryFromIndicatorX" /> 
        <input type="hidden" name="indicatorId" id="indicatorId" value="|-$indicator->getId()-|" /> 
        <input type="hidden" name="categoryId"  value="|-$category->getId()-|" /> 
        <input type="button" value="Eliminar" onClick="javascript:indicatorsDeleteCategoryFromIndicator(this.form)" class="buttonImageDelete" /> 
      </form> |-/if-|
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-|
|-else-|
<div class="errorMessage">Ingresó un Identificador de Indicador inexistente, regrese al listado haciendo <a href="Main.php?do=indicatorsList">click aquí</a></div>
|-/if-|
