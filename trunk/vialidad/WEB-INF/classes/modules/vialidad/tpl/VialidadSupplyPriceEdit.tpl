<h2>Boletines</h2>
|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del item ingresado no es válido. Seleccione un item de un boletín.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadBulletinList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Boletines"/>
|-else-|

|-assign var='bulletin' value=$priceBulletin->getBulletin()-|
|-assign var='supply' value=$priceBulletin->getSupply()-|

<h1>Administración de Precios - |-$bulletin->getBulletindate()|date_format:"%B / %Y"|@ucfirst-|</h1>
	
<p>A continuación podrá administrar los precios del insumo: |-$supply->getName()-|. <br />
El precio es por "<strong>|-$supply->getMeasureUnit()->getName()-| (|-$supply->getMeasureUnit()-|)</strong>" expresado en Guaraníes (sin separador de miles).<br />
El precio anterior se muestra como referencia y no puede ser modificado.
</p>

<fieldset title="Formulario de edición de precios del Insumo">
	<legend>|-$supply->getName()-|</legend>
	<p>Ingrese el precio en cada proveedor y haga click en &quot;Guardar&quot; </p>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th width="3%">Precio</th>
		<th width="50%">Proveedor</th>
		<th width="20%">Precio anterior</th>
		<th width="20%">Precio</th>
		<th width="3%">Definitivo</th>
		<th width="3%">Respaldo</th>
		<th width="1%">&nbsp;</th>
	</tr>
	|-for $i=1 to 4-|
		|-assign var='getAffiliateRelatedBySupplierid' value='getAffiliateRelatedBySupplierid'|cat:$i-|
		|-assign var='getLastprice' value='getLastprice'|cat:$i-|
		|-assign var='getPrice' value='getPrice'|cat:$i-|
		|-assign var='getDefinitive' value='getDefinitive'|cat:$i-|
		|-assign var='getDocumentRelatedBySupplierdocument' value='getDocumentRelatedBySupplierdocument'|cat:$i-|
		|-assign var='getSupplierDocument' value='getSupplierDocument'|cat:$i-|
		<tr>
			<td align="center">|-$i-|</td>
			<td>
				|-assign var='supplier' value=$priceBulletin->$getAffiliateRelatedBySupplierid()-|
				<span id="supplier|-$i-|_name">|-if $supplier neq ''-||-$supplier->getName()-||-else-|&nbsp;-&nbsp;|-/if-|</span>
				<div id="autocomplete_choices|-$i-|" class="autocomplete" style="position: relative;z-index:12000;display: none;" ></div>
			</td>
			<td align="right">|-$priceBulletin->$getLastprice()|system_numeric_format-|</td>
			<td align="right"><span id="price|-$i-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->$getPrice()|system_numeric_format-|</span></td>
			<td align="center"><input id="definitive|-$i-|" onchange="setParam('definitive|-$i-|', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->$getDefinitive()|checked_bool-| /></td>
			<td align="center" nowrap="nowrap">
				|-assign var='document' value=$priceBulletin->$getDocumentRelatedBySupplierdocument()-|
				|-if $document eq ''-|<a href="#lightbox|-$i-|" rel="lightbox|-$i-|" class="lbOn"><img src="images/clear.png" class="icon iconAttach" /></a>|-/if-|
				|-if $document neq ''-|
				|-if !empty($document) && ($document->getDescription() neq '' || $document->getTitle() ne '')-|
				<a class="tooltip" href="#"><span>|-$document->getDescription()-|</span><img src="images/clear.png" class="icon iconInfo"></a>|-/if-|
				<input onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$priceBulletin->$getSupplierDocument()-|')" type="button" class="icon iconView" />
				<form action="Main.php?do=vialidadSupplyPriceDoDeleteDocument" method="post">
					<input type="hidden" name="id" value="|-$priceBulletin->getId()-|" />
					<input type="hidden" name="supplierNumber" value="|-$i-|" />
					<input type="submit"  onclick="return confirm('Seguro que desea eliminar el respaldo definitivamente?')" class="icon iconDelete" />
				</form>|-/if-|
			</td>
			<td align="center" nowrap="nowrap"><input class="icon desabled">
			</td>
		</tr>
	|-/for-|
</table>
	<h3>Precio del boletín</h3>
	<p>
		<label for="averagePrice">Precio</label>
		<span id="averagePrice">|-$priceBulletin->getAveragePrice()|system_numeric_format-|</span>
		<input name="button" type='button' title="Calcular precio" onClick='updateAveragePrice()'  value='Calcular precio' />
	</p>
	<p>
		<!-- si es admin debe poder marcarlo como definitivo -->
		<label for="definitive">Definitivo</label>
		<input id="definitive" onchange="setParam('definitive', this.checked);" type="checkbox" disabled="disabled" value="1"  |-$priceBulletin->getDefinitive()|checked_bool-|/> 
	</p>
	<p>
		<input type='button'  value='Regresar' title="Regresar al listado de Contratistas"
		      onClick='location.href="Main.php?do=vialidadBulletinEdit&amp;id=|-$bulletin->getId()-|&amp;submit_go_edit_vialidad_bulletin=Editar"' />
	</p>
</fieldset>
	
<script type="text/javascript" src="scripts/lightbox.js"></script>
|-section name=lightboxes start=1 loop=5 step=1-|
|-assign var=i value=$smarty.section.lightboxes.index-|
<div id="lightbox|-$i-|" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p>
	<form method="post" action="Main.php?do=vialidadSupplyPriceDoAddDocument" enctype="multipart/form-data" id="documentsAdderForm|-$i-|">
	<input type="hidden" name="id" value="|-$priceBulletin->getId()-|" />
	<input type="hidden" name="supplierNumber" value="|-$i-|" />
	<fieldset title="Formulario para Agregar Nuevo Respaldo">
		<legend>Anexar Respaldo</legend>
		<p>Ingrese los datos correspondientes al Respaldo que desea anexar.</p>
		<p>
			<label for="document_file">Archivo</label>
			<input type="file" id="document_file|-$i-|" name="document_file" title="Seleccione el archivo" size="45"/>
		</p>
		<p>
			<label for="date">Fecha</label>
			<input name="date" type="text" value="|-$smarty.now|date_format:'%d-%m-%Y'-|" size="10" title="Fecha del documento (Formato: dd-mm-yyyy)"/>
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="description">Comentarios</label>
			<textarea name="description" cols="55" rows="6" wrap="VIRTUAL" title="Descripción"></textarea>
		</p>
		<div id="upload_info"></div>
		<p>
			<input type="submit" name="uploadButton" value="Agregar Respaldo" ><span id="msgBoxUploader|-$i-|"></span>
		</p>
	</fieldset>
	</form>
</div> 
|-/section-|


<script type="text/javascript">
	
var requestParamValue;
var supplierId = new Array();
var submitButton;

function attachSupplierAutocompleter(elementName, number) {
	new Ajax.Autocompleter(
		elementName,
		"autocomplete_choices"+number,
		"Main.php?do=affiliatesAutocompleteListX&getCandidates=true&bulletinId=|-$bulletin->getId()-|&supplyId=|-$supply->getId()-|&supplierId="+number,
		{
			minChars: 3,
			afterUpdateElement: function(text, li) {
				requestParamValue = supplierId[text.value];
				if (requestParamValue > 0)
					submitButton.enable();
			}
		}
);
}

function attachSupplierEditor(number) {
	new Ajax.InPlaceEditor(
		'supplier'+number+'_name',
		'Main.php?do=vialidadSupplyPriceEditFieldX',
		{
			rows: 1,
			cols: 50,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'bulletinId=|-$bulletin->getId()-|&supplyId=|-$supply->getId()-|&paramName=supplierId'+number+'&paramValue=' + requestParamValue;
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {
				var input = form.elements['value'];
				submitButton =form.elements[1];
				
				if (input.value == '&nbsp;-&nbsp;')
					input.value = '-';
				submitButton.disable();
				attachSupplierAutocompleter(input, number);
				requestParamValue = supplierId[input.value];
			}
		}
	);
}

function setParam(name, value) {
	new Ajax.Request(
		'Main.php?do=vialidadSupplyPriceEditFieldX',
		{
			method: 'post',
			parameters: {
				bulletinId: "|-$bulletin->getId()-|",
				supplyId: "|-$supply->getId()-|",
				paramName: name,
				paramValue: value
			}
		}
	);
}

function updateDefinitive() {
	if ( $('definitive1').checked &&  $('definitive2').checked && $('definitive3').checked && $('definitive4').checked ) {
		$('definitive').checked=true;
		setParam('definitive', true);
	} else {
		$('definitive').checked=false;
		setParam('definitive', false);
	}
}

function updateAveragePrice() {
	new Ajax.Updater(
		'averagePrice',
		'Main.php?do=vialidadSupplyPriceCalculateAveragePriceX',
		{
			method: 'post',
			parameters: {id: '|-$priceBulletin->getId()-|'}
		}
	);
}
	
Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});

function attachInPlaceEditor(name) {
	new Ajax.InPlaceEditor(
		name,
		'Main.php?do=vialidadSupplyPriceEditFieldX',
		{
			rows: 1,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'bulletinId=|-$bulletin->getId()-|&supplyId=|-$supply->getId()-|&paramName='+name+'&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {}
		}
	);
}

window.onload = function() {
	loadSupplierIds();
	attachInPlaceEditor('price1');
	attachInPlaceEditor('price2');
	attachInPlaceEditor('price3');
	attachInPlaceEditor('price4');
	attachSupplierEditor(1);
	attachSupplierEditor(2);
	attachSupplierEditor(3);
	attachSupplierEditor(4);
}

function loadSupplierIds() {
	|-foreach from=$allSuppliers item=supplier-|
	supplierId['|-$supplier->getName()-|'] = '|-$supplier->getId()-|';
	|-/foreach-|
}

function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
	element.innerHTML = chomp(element.innerHTML);
}
</script>

|-/if-|
