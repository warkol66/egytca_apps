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
		<th>Precio</th>
		<th>Proveedor</th>
		<th>Precio</th>
		<th>Respaldo</th>
		<th>Definitivo</th>
	</tr>
	<tr>
		<td>1</td>
		<td><div id="supplier1" style="position: relative;z-index:12000;">|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier1" label="" url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="params[supplierId1]" disableSubmit="save"-|</div></td>
		<td align="right"><span id="price1" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice1()|system_numeric_format-|</span></td>
		<td><input type="file" name="file1" /></td>
		<td><input onchange="setParam('definitive1', this.checked)" type="checkbox" value="1" |-$priceBulletin->getDefinitive1()|checked_bool-| /></td>
	</tr>
	<tr>
		<td> 2</td>
		<td><div id="supplier2" style="position: relative;z-index:11000;">
		|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier2" label="" url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="params[supplierId2]" disableSubmit="save" -|
		</div></td>
		<td align="right"><span id="price2" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice2()|system_numeric_format-|</span></td>
		<td><input type="file" name="file2" /></td>
		<td><input onchange="setParam('definitive2', this.checked)" type="checkbox" value="1" |-$priceBulletin->getDefinitive2()|checked_bool-| /></td>
	</tr>
	<tr>
		<td> 3</td>
		<td><div id="supplier3" style="position: relative;z-index:10000;">
		|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier3" label="" url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="params[supplierId3]" disableSubmit="save" -|
		</div></td>
		<td align="right"><span id="price3" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->getPrice3()|system_numeric_format-|</span></td>
		<td><input type="file" name="file3" /></td>
		<td><input onchange="setParam('definitive3', this.checked)" type="checkbox" value="1" |-$priceBulletin->getDefinitive3()|checked_bool-| /></td>
	</tr>
	</table>
	


	<h3>Precio del boletín</h3>
	<p>
		<input name="button" type='button' title="Calcular precio" onClick=''  value='Calcular precio' />
	</p>
	<p>
		  <label for="params[averagePrice]">Precio</label>
	  <input name="params[averagePrice]" disabled="disabled" type="text" value="Calculado como promedio de los valores 1, 2 y 3" size="15" /> 
	  </p>
	<p>
		<!-- si es admin debe poder marcarlo como definitivo -->
		<label for="params[definitive]">Definitivo</label>
		<input name="params[definitive]" type="checkbox" value="1" disabled="disabled"
		       |-$priceBulletin->getDefinitive()|checked_bool-|/> 
	</p>
	<p>
		<input name="save" id="save" type="submit" value="Guardar Cambios" /> 
		<input type='button'  value='Regresar' title="Regresar al listado de Contratistas"
		      onClick='location.href="Main.php?do=vialidadBulletinEdit&amp;id=|-$bulletin->getId()-|&amp;submit_go_edit_vialidad_bulletin=Editar"' />
	</p>
	</form>
</fieldset>

<script type="text/javascript">
	
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
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Precio: ') });
			}
		}
	);
}

window.onload = function() {
	attachInPlaceEditor('price1');
	attachInPlaceEditor('price2');
	attachInPlaceEditor('price3');
}

function showInput(to_show, to_hide) {
	$(to_show).show();
	$(to_hide).hide();
}

function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
	element.innerHTML = chomp(element.innerHTML);
}
</script>
