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
</script>
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una región del sistema.</p>
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
|-if $action eq "edit"-|
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
|-if $action eq "edit"-|
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
				<input name="regionData[name]" type="text" id="regionData[name]" title="name" value="|-if $action eq 'edit'-||-$region->getName()|escape-||-/if-|" size="60" maxlength="100" />
	</p>			
	<p><label for="regionData[postalCode]">Código Postal</label>
				<input name="regionData[postalCode]" type="text" id="regionData[postalCode]" title="postalCode" value="|-if $action eq 'edit'-||-$region->getPostalCode()-||-/if-|" size="10" />
	</p>			
	<p><label for="regionData[latitude]">Latitud</label>
				<input name="regionData[latitude]" type="text" id="regionData[latitude]" title="latitude" value="|-if $action eq 'edit'-||-$region->getLatitude()|system_numeric_format:8-||-/if-|" size="10" />
	</p>			
	<p><label for="regionData[longitude]">Longitud</label>
				<input name="regionData[longitude]" type="text" id="regionData[longitude]" title="longitude" value="|-if $action eq 'edit'-||-$region->getLongitude()|system_numeric_format:8-||-/if-|" size="10" />
	</p>			
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
	<p>|-if $action eq "edit"-|<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$region->getId()-||-/if-|" />|-/if-|
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
