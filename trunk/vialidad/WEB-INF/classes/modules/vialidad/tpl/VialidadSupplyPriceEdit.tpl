|-assign var='bulletin' value=$priceBulletin->getBulletin()-|
|-assign var='supply' value=$priceBulletin->getSupply()-|

|-include file="CommonAutocompleterInclude.tpl" -|

<h2>Boletines</h2>
<h1>Administración de Precios - |-$bulletin->getBulletindate()|date_format:"%B / %Y"|@ucfirst-|</h1>
	
<p>A continuación podrá administrar los precios del insumo: |-$supply->getName()-|</p>

<fieldset title="Formulario de edición de precios del Insumo">
	<legend>|-$supply->getName()-|</legend>
	<p>Ingrese el precio en cada proveedor y haga click en &quot;Guardar&quot; </p>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th width="4%">Precio</th>
		<th>Proveedor</th>
		<th width="20%">Precio</th>
		<th width="6%">Definitivo</th>
		<th width="8%">Respaldo</th>
	</tr>
	<tr>
		<td>1</td>
		<td>
			<div id="supplier1_non_edit">
				|-assign var='supplier1' value=$priceBulletin->getSupplierRelatedBySupplierid1()-|
				<span id="supplier1_name">|-if $supplier1 neq ''-||-$supplier1->getName()-||-else-|&nbsp;-&nbsp;|-/if-|</span>
				<button type="button" onclick="setSupplierEdition(1, true);" class="icon iconEdit" />
			</div>
			<div id="supplier1_edit" style="display:none">
				<div id="supplier1_autocomplete" style="position: relative;z-index:12000;display: inline;">|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier1" label="" url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="supplierId1" disableSubmit="save_supplier1"-|</div>
				<button id="save_supplier1" type="button" disabled="disabled" onclick="updateSupplier(1)" class="icon iconActivate" style="margin-right:3px;"/>
				<button type="button" onclick="setSupplierEdition(1, false);" class="icon iconCancel" />
			</div>
		</td>
		<td align="right"><span id="price1" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice1()|system_numeric_format-|</span></td>
		<td align="center"><input id="definitive1" onchange="setParam('definitive1', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->getDefinitive1()|checked_bool-| /></td>
		<td align="center">
			<a |-if $document1 neq ''-|style="display:none"|-/if-| href="#lightbox1" rel="lightbox1" class="lbOn"><img src="images/clear.png" class="icon iconAttach" /></a>
			<input |-if $document1 eq ''-|style="display:none"|-/if-| onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$priceBulletin->getSupplierDocument1()-|')" type="button" class="icon iconView" />
			<form action="Main.php?do=vialidadSupplyPriceDeleteDocument" method="post">
				<input type="hidden" name="id" value="|-$priceBulletin->getId()-|" />
				<input type="hidden" name="supplierNumber" value="1" />
				<input type="submit" |-if $document1 eq ''-|style="display:none"|-/if-| onclick="return confirm('Seguro que desea eliminar el respaldo definitivamente?')" class="icon iconDelete" />
			</form>
		</td>
	</tr>
	<tr>
		<td>2</td>
		<td>
			<div id="supplier2_non_edit">
				|-assign var='supplier2' value=$priceBulletin->getSupplierRelatedBySupplierid2()-|
				<span id="supplier2_name">|-if $supplier2 neq ''-||-$supplier2->getName()-||-else-|&nbsp;-&nbsp;|-/if-|</span>
				<button type="button" onclick="setSupplierEdition(2, true);" class="icon iconEdit" />
			</div>
			<div id="supplier2_edit" style="display:none">
				<div id="supplier2_autocomplete" style="position: relative;z-index:11000;">|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier2" label="" url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="supplierId2" disableSubmit="save_supplier2" -|</div>
				<button id="save_supplier2" type="button" disabled="disabled" onclick="updateSupplier(2)" class="icon iconActivate"  style="margin-right:3px;"/>
				<button type="button" onclick="setSupplierEdition(2, false);" class="icon iconCancel" />
			</div>
		</td>
		<td align="right"><span id="price2" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice2()|system_numeric_format-|</span></td>
		<td align="center"><input id="definitive2" onchange="setParam('definitive2', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->getDefinitive2()|checked_bool-| /></td>
		<td align="center">
			<a |-if $document2 neq ''-|style="display:none"|-/if-| href="#lightbox2" rel="lightbox2" class="lbOn"><img src="images/clear.png" class="icon iconAttach" /></a>
			<input |-if $document2 eq ''-|style="display:none"|-/if-| onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$priceBulletin->getSupplierDocument2()-|')" type="button" class="icon iconView" />
			<form action="Main.php?do=vialidadSupplyPriceDeleteDocument" method="post">
				<input type="hidden" name="id" value="|-$priceBulletin->getId()-|" />
				<input type="hidden" name="supplierNumber" value="2" />
				<input type="submit" |-if $document2 eq ''-|style="display:none"|-/if-| onclick="return confirm('Seguro que desea eliminar el respaldo definitivamente?')" class="icon iconDelete" />
			</form>
		</td>
	</tr>
	<tr>
		<td>3</td>
		<td>
			<div id="supplier3_non_edit">
				|-assign var='supplier3' value=$priceBulletin->getSupplierRelatedBySupplierid3()-|
				<span id="supplier3_name">|-if $supplier3 neq ''-||-$supplier3->getName()-||-else-|&nbsp;-&nbsp;|-/if-|</span>
				<button type="button" onclick="setSupplierEdition(3, true);" class="icon iconEdit" />
			</div>
			<div id="supplier3_edit" style="display:none">
				<div id="supplier3_autocomplete" style="position: relative;z-index:10000;">|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier3" label="" url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="supplierId3" disableSubmit="save_supplier3" -|</div>
				<button id="save_supplier3" type="button" disabled="disabled" onclick="updateSupplier(3)" class="icon iconActivate"  style="margin-right:3px;"/>
				<button type="button" onclick="setSupplierEdition(3, false);" class="icon iconCancel" />
			</div>
		</td>
		<td align="right"><span id="price3" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice3()|system_numeric_format-|</span></td>
		<td align="center"><input id="definitive3" onchange="setParam('definitive3', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->getDefinitive3()|checked_bool-| /></td>
		<td align="center">
			<a |-if $document3 neq ''-|style="display:none"|-/if-| href="#lightbox3" rel="lightbox3" class="lbOn"><img src="images/clear.png" class="icon iconAttach" /></a>
			<input |-if $document3 eq ''-|style="display:none"|-/if-| onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$priceBulletin->getSupplierDocument3()-|')" type="button" class="icon iconView" />
			<form action="Main.php?do=vialidadSupplyPriceDeleteDocument" method="post">
				<input type="hidden" name="id" value="|-$priceBulletin->getId()-|" />
				<input type="hidden" name="supplierNumber" value="3" />
				<input type="submit" |-if $document3 eq ''-|style="display:none"|-/if-| onclick="return confirm('Seguro que desea eliminar el respaldo definitivamente?')" class="icon iconDelete" />
			</form>
		</td>
	</tr>
	</table>
	


	<h3>Precio del boletín</h3>
	<p>
		<label for="averagePrice">Precio</label>
		<input id="averagePrice" style="display:inline" disabled="disabled" type="text" value="|-$priceBulletin->getAveragePrice()-|" size="15" />
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
|-section name=lightboxes start=1 loop=4 step=1-|
|-assign var=i value=$smarty.section.lightboxes.index-|
<div id="lightbox|-$i-|" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p>
	

	
	<form method="post" action="Main.php?do=vialidadSupplyPriceAddDocument" enctype="multipart/form-data" id="documentsAdderForm|-$i-|">
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
			<label for="title">Título</label>
			<textarea name="title" cols="55" rows="2" wrap="virtual" title="Título"></textarea>
		</p>
		<p>
			<label for="description">Descripción</label>
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

<!--
<p>
	<span id="span_inplace_edit">clickeame</span>
	<input type="text" id="autocomplete" name="value"/>
	<div id="autocomplete_choices" class="autocomplete"></div>
</p>
<script type="text/javascript">
	
new Ajax.Autocompleter(
	"autocomplete",
	"autocomplete_choices",
	"Main.php?do=vialidadSuppliersAutocompleteListX",
	{
		minChars: 3
	}
);
</script>

-->

<script type="text/javascript">

/*
function attachSupplierEditor(number) {
	new Ajax.InPlaceEditor(
		'supplierId'+number,
		'ain.php?do=vialidadSupplyPriceEditFieldX',
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
				return 'bulletinId=|-$bulletin->getId()-|&supplyId=|-$supply->getId()-|&paramName=supplier1&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {}
		}
	);
}

*/
	
function updateSupplier(number) {
	var name = 'supplierId'+number;
	var value = $('autocomplete_supplier'+number+'_selected_id').value;
	
	new Ajax.Updater(
		'supplier'+number+'_name',
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
	
	setSupplierEdition(number, false);
}

function setSupplierEdition(supplierNumber, value) {
	if (value == true) {
		$('supplier'+supplierNumber+'_non_edit').hide();
		$('supplier'+supplierNumber+'_edit').show();
	} else {
		
		$('supplier'+supplierNumber+'_edit').hide();
		$('supplier'+supplierNumber+'_non_edit').show();
	}
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
	if ( $('definitive1').checked &&  $('definitive2').checked && $('definitive3').checked ) {
		$('definitive').checked=true;
		setParam('definitive', true);
	} else {
		$('definitive').checked=false;
		setParam('definitive', false);
	}
}

function updateAveragePrice() {
	var cant = 0;
	var sum = 0;
	
	for (var i=1; i<=3; i++) {
		var value = parseFloat($('price'+i).innerHTML);
		if (value != 0) {
			cant++;
			sum += value;
		}
	}
	
	if (cant != 0) {
		setParam('averagePrice', sum/cant);
		$('averagePrice').value = sum/cant;
	}
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
	attachInPlaceEditor('price1');
	attachInPlaceEditor('price2');
	attachInPlaceEditor('price3');
}


function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
	element.innerHTML = chomp(element.innerHTML);
}
</script>
