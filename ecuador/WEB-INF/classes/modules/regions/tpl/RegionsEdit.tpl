<script type="text/javascript">
	jQuery.noConflict();
</script>
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>

<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Región</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<script type="text/javascript" language="javascript">
function regionsGetAllParentsByRegionX(form){
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

function addNeighbor(form) {
	
	jQuery.ajax({
		url: url,
		data: jQuery(form).serialize(),
		type: 'post',
		dataType: 'html',
		success: function(data){
			jQuery('#neighborList').append(data);
		}
	});
	jQuery('#neighborMsgField').html('<span class="inProgress">agregando región vecina</span>');
	return true;
}
</script>
<p>A continuación podrá |-if !$region->isNew()-|editar|-else-|crear|-/if-| una región del sistema.</p>
<div id="div_region">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la región </div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de una región">
     <legend>Ingrese los datos de la Región</legend>
	<form action="Main.php" method="post">
				<input type="hidden" name="do" value="regionsGetAllParentsByRegionX" />
<p>
      <label for="regionDataX[type]">Tipo</label>
|-if !$region->isNew()-|
|-$region->getRegionTypeTranslated()-|
|-else-|<select id="regionDataX[type]" name="regionDataX[type]" title="type" onChange="javascript:regionsGetAllParentsByRegionX(this.form)">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$regionTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get("regions","treeRootType")-|
        <option value="|-$typeKey-|">|-$type-|</option>
				|-/if-|
			|-/foreach-|
      </select>|-/if-|</p>
		</form>
	<form name="form_edit_region" id="form_edit_region" action="Main.php" method="post">
|-if !$region->isNew()-|
<p>
  <label for="regionData[parentId]">Dentro de</label>
  <select id="regionData[parentId]" name="regionData[parentId]" title="parentId"> 
	|-if $region->getType() eq $configModule->get("regions","treeRootType") or empty($regions)-|
    <option value="0" selected="selected">Ninguna</option> 
	|-/if-||-$regions|@print_r-|
	|-foreach from=$regions item=parent name=for_parent-|
	|-assign var=ancestor value=$region->getParent()-|
	 <option value="|-$parent->getId()-|" |-$region->getParentId()|selected:$ancestor->getId()-|>|-section name=space loop=$parent->getType()-|&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>

|-else-|
<span id="regionMsgField"></span>
|-/if-|
	<p><label for="regionData[name]">Nombre</label>
				<input name="regionData[name]" type="text" id="regionData[name]" title="name" value="|-$region->getName()|escape-|" size="60" maxlength="100" />
	</p>			
	<p><label for="regionData[postalCode]">Código Postal</label>
				<input name="regionData[postalCode]" type="text" id="regionData[postalCode]" title="postalCode" value="|-$region->getPostalCode()-|" size="10"  class="right" />
	</p>			
	<p><label for="regionData[latitude]">Latitud</label>
				<input name="regionData[latitude]" type="text" id="regionData[latitude]" title="latitude" value="|-$region->getLatitude()|system_numeric_format:8-|" size="10"  class="right" />
	</p>			
	<p><label for="regionData[longitude]">Longitud</label>
				<input name="regionData[longitude]" type="text" id="regionData[longitude]" title="longitude" value="|-$region->getLongitude()|system_numeric_format:8-|" size="10"  class="right" />
	</p>			
	<p><label for="regionData[population]">Población</label>
				<input name="regionData[population]" type="text" id="regionData[population]" title="Población" value="|-$region->getPopulation()|system_numeric_format:0-|" size="8"  class="right" />
habitantes	</p>			
	<p><label for="regionData[populationYear]">Año de medición</label>
				<input name="regionData[populationYear]" type="text" id="regionData[populationYear]" title="Año de medición" value="|-$region->getPopulationYear()|system_numeric_format:0-|" size="6" class="right" />
	</p>			
	<p><label for="regionData[area]">Superficie </label>
				<input name="regionData[area]" type="text" id="regionData[area]" title="Superficie" value="|-$region->getArea()|system_numeric_format-|" size="10"  class="right" />
(Km2)	</p>			
	<p><label for="regionData[capital]">Capital</label>
				<input name="regionData[capital]" type="text" id="regionData[capital]" title="Capital" value="|-$region->getCapital()-|" size="60" />
	</p>			
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
	<p>|-if !$region->isNew()-|<input type="hidden" name="id" id="id" value="|-$region->getId()-|" />|-/if-|
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="regionsDoEdit" />
				<br>
				<input type="submit" id="button_edit_region" name="button_edit_region" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_region" name="button_return_region" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=regionsList'" />
				<input type="hidden" name="regionData[type]" id="regionData[type]" value="|-$region->getType()-|" /></p>
	</form>
		</fieldset>
</div>
|-if !$region->isNew()-|<!--Neighbors-->
<fieldset title="Formulario de edición de regiones vecinas">
	<legend>Regiones Vecinas</legend>
<div id="neighborAdding"> <span id="neighborMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="neighborId" name="neighborId" title="neighborId" > 
      <option value="">Seleccione una región</option>
				|-foreach from=$neighborOptions item=neighborOp name=for_neighborOp-|
        <option id="neighborOption|-$neighborOp->getId()-|" value="|-$neighborOp->getId()-|" >|-$neighborOp->getName()-|</option> 
				|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="regionsDoAddNeighborX" /> 
      <input type="hidden" name="regionId" id="regionId" value="|-$region->getId()-|" /> 
      <input type="button" value="Asignar vecino" onClick="javascript:addNeighbor(this.form)"/> 
    </p> 
  </form> 
  <ul id="neighborList" class="optionDelete">|-assign var=actualNeighbors value=$region->getNeighbors()-|
     |-foreach from=$actualNeighbors item=actual name=for_actual-|
    <li id="neighborListItem|-$actual->getId()-|">
      <form  method="post">
        <input type="hidden" name="do" id="do" value="regionsDoDeleteNeighborX" /> 
        <input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
        <input type="hidden" name="neighborId"  value="|-$actual->getId()-|" /> 
			  <input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar el vínculo con la región?')){deleteNeighborFromrRegion(this.form)}; return false" class="icon iconDelete" /> 
     </form><span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$actual->getName()-|</span>
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
<!--Fin Neighbors-->|-/if-|
