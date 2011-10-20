|-assign var='bulletin' value=$priceBulletin->getBulletin()-|
|-assign var='supply' value=$priceBulletin->getSupply()-|

|-include file="CommonAutocompleterInclude.tpl" -|

<h2>Boletines</h2>
<h1>Administración de Precios - |-$bulletin->getBulletindate()|date_format:"%B / %Y"|@ucfirst-|</h1>
	
<p>A continuación podrá administrar los precios del insumo: |-$supply->getName()-|</p>

<fieldset title="Formulario de edición de precios del Insumo">
	<legend>|-$supply->getName()-|</legend>
	<form action="Main.php?do=vialidadSupplyPriceDoEdit" method="post" enctype="multipart/form-data">
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
				<button id="save_supplier1" type="button" disabled="disabled" onclick="updateSupplier(1)" class="icon iconActivate" />
				<button type="button" onclick="setSupplierEdition(1, false);" class="icon iconClose" />
			</div>
		</td>
		<td align="right"><span id="price1" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice1()|system_numeric_format-|</span></td>
		<td align="center"><input id="definitive1" onchange="setParam('definitive1', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->getDefinitive1()|checked_bool-| /></td>
		<!-- <td><input type="file" name="file1" /></td> -->
		<td align="center">
			<button id="button_attach_supplier1" onclick="showAttachForm(1)" type="button" class="icon iconAttach" />
			<button id="button_view_supplier1" style="display:none" onclick="viewDocument(1)" type="button" class="icon iconView" />
			<button id="button_delete_supplier1" style="display:none" onclick="deleteDocument(1)" type="button" class="icon iconDelete" />
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
				<button id="save_supplier2" type="button" disabled="disabled" onclick="updateSupplier(2)" class="icon iconActivate" />
				<button type="button" onclick="setSupplierEdition(2, false);" class="icon iconClose" />
			</div>
		</td>
		<td align="right"><span id="price2" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice2()|system_numeric_format-|</span></td>
		<td align="center"><input id="definitive2" onchange="setParam('definitive2', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->getDefinitive2()|checked_bool-| /></td>
		<!-- <td><input type="file" name="file2" /></td> -->
		<td align="center">
			<button id="button_attach_supplier2" onclick="showAttachForm(2)" type="button" class="icon iconAttach" />
			<button id="button_view_supplier2" style="display:none" onclick="viewDocument(2)" type="button" class="icon iconView" />
			<button id="button_delete_supplier2" style="display:none" onclick="deleteDocument(2)" type="button" class="icon iconDelete" />
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
				<button id="save_supplier3" type="button" disabled="disabled" onclick="updateSupplier(3)" class="icon iconActivate" />
				<button type="button" onclick="setSupplierEdition(3, false);" class="icon iconClose" />
			</div>
		</td>
		<td align="right"><span id="price3" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice3()|system_numeric_format-|</span></td>
		<td align="center"><input id="definitive3" onchange="setParam('definitive3', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->getDefinitive3()|checked_bool-| /></td>
		<!-- <td><input type="file" name="file3" /></td> -->
		<td align="center">
			<button id="button_attach_supplier3" onclick="showAttachForm(3)" type="button" class="icon iconAttach" />
			<button id="button_view_supplier3" style="display:none" onclick="viewDocument(3)" type="button" class="icon iconView" />
			<button id="button_delete_supplier3" style="display:none" onclick="deleteDocument(3)" type="button" class="icon iconDelete" />
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
	</form>
</fieldset>

<script type="text/javascript">
	
function showAttachForm(number) {}
	
function viewDocument(number) {}

function deleteDocument(number) {}
	
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
