<h2>Certificados de Obra</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del certificado ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadCertificatesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Certificados"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Certificado de Obra</h1>
<div id="div_certificate">
	<p>Ingrese los datos del Certificado de Obra</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Certificado de Obra</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_certificate" id="form_edit_certificate" onsubmit="return validateForm()" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Certificado de Obra">
			<legend>Formulario de Administración de Certificado de Obra</legend>
			<p>
				|-if $action eq "create"-|
		<div style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadMeasurementRecordsAutocompleteListX&noCertificate=1" hiddenName="params[measurementRecordId]" disableSubmit="button_edit_certificate" label="Acta"-|
		</div>
				|-else-|
				|-assign var=record value=$certificate->getMeasurementRecord()-|
				|-assign var=construction value=$record->getConstruction()-|
				<label for="params[measurementRecordId]">Acta</label>
				<input type="hidden" name="params[measurementRecordId]" value="|-$record->getId()-|" />
				<span>|-$construction->getName()-|&nbsp;-&nbsp;|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</span>
				|-/if-|
			</p>
			|-if $action eq 'edit'-|
			<p>
				<label for="totalPrice">Precio Total</label>
				<span id="totalPrice" name="totalPrice" title="Precio total">|-$certificate->calculatePrice()|system_numeric_format-|</span>
			</p>
		 <p>
		   <label for="params[code]">Número</label>
				<span id="code" name="code" title="Número">|-$record->getCode()-|</span>
		</p>
			|-/if-|
			<div id="bulletin" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_bulletinId" label="Boletín base" url="Main.php?do=commonAutocompleteListX&object=bulletin" hiddenName="params[bulletinId]" defaultHiddenValue=$certificate->getBulletinId() defaultValue=$certificate->getBulletin() class="emptyValidation"-| 
			</div>
			<p>
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" value="|-$certificate->getid()-|" />
				<input type="hidden" name="action" value="edit" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadCertificatesDoEdit" />
				<input type="submit" id="button_edit_certificate" |-if $action eq "create"-|disabled="disabled"|-/if-| title="Aceptar" value="Guardar" />
				<input type="button" id="readjustment" title="Reajustes" value="Reajustes" onClick="location.href='Main.php?do=vialidadCertificatesReadjustmentEdit&id=|-$certificate->getid()-|'"/>
				<input type="button" id="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadCertificatesList'"/>
		<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
	
	|-if $action eq 'edit'-|
	
	<h3>Items</h3>
	<div id=div_itemPrices>
	<table id="table_itemPrices" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="5%">Código</th> 
			<th width="50%">Item</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Precio unitario</th>
			<th width="10%">Cantidad Certificada </th> 
			<th width="15%">Precio total</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		|-if $relations->count() eq 0-|
		<tr>
			<td colspan="5">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$relations item=relation name=for_relations-|
		<tr>
			|-assign var=item value=$relation->getConstructionItem()-|
			<td nowrap="nowrap">|-$item->getCode()-|</td>
			<td>|-$item->getName()-|</td>
			<td align="center">|-$item->getMeasureUnit()-|</td>
			<td align="right"><span id="price|-$relation->getId()-|">|-$relation->getPrice()|system_numeric_format-|</span></td>
			<td align="right">|-$relation->getQuantity()|system_numeric_format-|</td>
			<td align="right"><span id="totalPrice|-$relation->getId()-|">|-$relation->getTotalPrice()|system_numeric_format-|</span></td>
			<td align="center"><input id="button_priceEdit|-$relation->getId()-|" type="button" class="icon iconEdit"/></td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	
	

	
|-if $fines->count() gt 0-|
	<h3>Multas</h3>
	<div id=div_fines>
	<table id="table_fines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$fines item=fine-|
		<tr>
			<td>|-$fine->getDescription()-|</td>
			<td align="right">|-$fine->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
|-/if-|
	
|-if $dailyWorks->count() gt 0-|
	<h3>Trabajos por Día</h3>
	<div id=div_dailyWorks>
	<table id="table_dailyWorks" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$dailyWorks item=dailyWork-|
		<tr>
			<td>|-$dailyWork->getDescription()-|</td>
			<td align="right">|-$dailyWork->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
|-/if-|
	
|-if $adjustments->count() gt 0-|
	<h3>Ajustes</h3>
	<div id=div_adjustments>
	<table id="table_adjustments" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$adjustments item=adjustment-|
		<tr>
			<td>|-$adjustment->getDescription()-|</td>
			<td align="right">|-$adjustment->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
	|-/if-|
|-if $others->count() gt 0-|
	<h3>Otros bienes y servicios</h3>
	<div id=div_others>
	<table id="table_others" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$others item=other-|
		<tr>
			<td>|-$other->getDescription()-|</td>
			<td align="right">|-$other->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
	|-/if-|
		
	|-/if-|
</div>


<script type="text/javascript">
	
function validateForm() {
	var submit = true;
	var params = ['measurementRecordId'];
	
	for (var i=0; i<params.length; i++) {
		if (!($('form_edit_certificate').elements['params['+params[i]+']'].value)) {
			submit = false;
			$('div_form_error').show();
		}
	}
	
	return submit;
}

</script>

|-/if-|
