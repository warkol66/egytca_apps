<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.timepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		initializeDatePickers();
		
		$('#construction_street').change(updateLocateButton);
		$('#construction_number').change(updateLocateButton);
		$('#construction_latitude').change(updateLocateButton);
		$('#construction_longitude').change(updateLocateButton);
	});
	
	function updateLocateButton() {
		
		var text;
		
		if ( $('#construction_latitude').val() != '' && $('#construction_street').val() != '' )
			text = 'Ver en mapa';
		else
			text = 'Buscar en mapa';
		
		$('#button_locate').attr('value', text);
		$('#button_locate').attr('title', text);
	}
	
	function initializeDatePickers() {
		$.datepicker.setDefaults({
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 3
//			minDate: 0	
		});
		$('#construction_endDate').datepicker();
	}
</script>
<h2>Administración de Obras</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Obra</h1>
|-if $message eq "ok"-|
	<div class="successMessage">Obra guardada correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar la obra</div>
|-/if-|
<div id="div_constructions">
		<form name="form_edit_construction" id="form_edit_construction" action="Main.php" method="post">
			<p>Ingrese los datos de la obra</p>
			<fieldset title="Formulario de edición de datos de una obra">
			<legend>Formulario de Obras</legend>
				<p>
					<label for="construction_name">Nombre</label>
					<input name="params[name]" type="text" id="construction_name" title="Nombre de la Obra" value="|-$construction->getName()|escape-|" class="emptyValidation" size="60" maxlength="255" |-js_char_counter object=$construction columnName="name" fieldName="construction_name" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes" showHide=1 useSpan=0-||-$Counter.pre-| /> |-$Counter.pos-| |-validation_msg_box idField="construction_name"-|
				</p>
				<p>
					<label for="construction_description">Descripción</label>
					<textarea name="params[description]" cols="60" rows="6" wrap="VIRTUAL"  id="construction_description">|-$construction->getDescription()|escape-|</textarea>
			</p>
				<p>
					<label for="construction_endDate">Fin de Obra</label>
					<input name="params[endDate]" type="text" id="construction_endDate" title="endDate" value="|-$construction->getEndDate()|date_format-|" size="18" /> 
				</p>							
				<p>
					<label for="construction_street">Calle</label>
					<input name="params[street]" type="text" id="construction_street" title="calle" value="|-$construction->getStreet()-|" size="30" />
				</p>
				<p>
					<label for="construction_number">Número</label>
					<input name="params[number]" type="text" id="construction_number" title="número" value="|-$construction->getNumber()-|" size="8" />
				</p>
|-include file="CommonMapInclude.tpl" locateButtonId="button_locate" disableId="button_edit_construction" streetId="construction_street" numberId="construction_number" latitudeId="construction_latitude" longitudeId="construction_longitude"-|
				<p>
					|-if !($construction->getLatitude() eq '') && !($construction->getStreet() eq '')-|
						|-assign var=locateButtonText value="Ver en mapa"-|
					|-else-|
						|-assign var=locateButtonText value="Buscar en mapa"-|
					|-/if-|
					<input type="button" id="button_locate" value="|-$locateButtonText-|" title="|-$locateButtonText-|" />
				</p>
				<p style="display: none">
					<label for="construction_latitude">Latitud</label>
					<input name="params[latitude]" type="text" id="construction_latitude" title="latitud" value="|-$construction->getLatitude()-|" size="20" readonly="readonly" />
				</p>
				<p style="display: none">
					<label for="construction_longitude">Longitud</label>
					<input name="params[longitude]" type="text" id="construction_longitude" title="longitud" value="|-$construction->getLongitude()-|" size="20" readonly="readonly"/>
				</p>
				<p>
					<label for="construction_regionId">Comunas/Barrios</label>
					<select id="construction_regionId" name="params[regionId]" title="Barrio o comuna">
						<option value="">Seleccione el barrio o comuna</option>
					|-foreach from=$regions item=object-|
						<option value="|-$object->getid()-|" |-$construction->getRegionId()|selected:$object->getid()-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="construction_categoryId">Dependencias</label>
					<select id="construction_categoryId" name="params[categoryId]" title="dependencias">
						<option value="">Seleccione la dependencia</option>
					|-foreach from=$categories item=object-|
						<option value="|-$object->getid()-|" |-$construction->getCategoryId()|selected:$object->getid()-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="params_inaugurated">Inaugurada</label>
					<input name="params[inaugurated]" id="params_inaugurated" type="hidden" value="0">
					<input name="params[inaugurated]" type="checkbox" |-$construction->getInaugurated()|checked_bool-| value="1">
				</p>
				<p>
					|-if !$construction->isNew()-|
					<input type="hidden" name="id" id="construction_id" value="|-$construction->getid()-|" />
					|-/if-|
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					<input type="hidden" name="do" id="doEdit" value="constructionsDoEdit" />
					|-javascript_form_validation_button id="button_edit_construction" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=constructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
				</p>
			</fieldset>
		</form>
	</div>
|-if !$construction->isNew()-|
	|-include file="ConstructionsInspectionsListInclude.tpl" inspections=$construction->getInspections() constructionId=$construction->getId()-|
|-/if-|
