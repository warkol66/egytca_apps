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
	
	<p>Precio 1 </p>
	<p>
		<div id="supplier1" style="position: relative;z-index:10000;">
		|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_supplier1" label="Proveedor"
			url="Main.php?do=vialidadSuppliersAutocompleteListX" hiddenName="params[supplierId1]" disableSubmit="save" -|
		</div>
	</p>
	<p>
		<label for="params[price1]">Precio</label>
		<input name="params[price1]" type="text" size="15" value="|-$priceBulletin->getPrice1()-|" />
	</p>
	<p>
		<!-- name no debe ser params[file1] porque los datos del priceBulletin se modifican con el array $_POST["params"] -->
		<label for="file1">Respaldo</label>
		<input type="file" name="file1" />		
	</p>
	<p>
		<label for="params[definitive1]">Definitivo</label>
		<input name="params[definitive1]" type="checkbox" value="1"
		       |-if $priceBulletin->getDefinitive1() eq true-|checked="checked"|-/if-|/> 
	</p>
	
	<p>Precio 2 </p>
	<p>
		<label for="params[supplierId2]">Proveedor</label>
		<input name="params[supplierId2]" type="text" size="50"
			|-if $priceBulletin->getSupplierId2() neq 0-|value="|-$priceBulletin->getSupplierId2()-|"
			|-else-|value=""|-/if-|
		/>
	</p>
	<p>
		<label for="params[price2]">Precio</label>
		<input name="params[price2]" type="text" size="15" value="|-$priceBulletin->getPrice2()-|" />
	</p>
	<p>
		<!-- name no debe ser params[file2] porque los datos del priceBulletin se modifican con el array $_POST["params"] -->
		<label for="file2">Respaldo</label>
		<input type="file" name="file2" />		
	</p>
	<p>
		<label for="params[definitive2]">Definitivo</label>
		<input name="params[definitive2]" type="checkbox" value="1"
		       |-if $priceBulletin->getDefinitive2() eq true-|checked="checked"|-/if-|/> 
	</p>
	
	<p>Precio 3 </p>
	<p>
		<label for="params[supplierId3]">Proveedor</label>
		<input name="params[supplierId3]" type="text" size="50"
			|-if $priceBulletin->getSupplierId3() neq 0-|value="|-$priceBulletin->getSupplierId3()-|"
			|-else-|value=""|-/if-|
		/>
	</p>
	<p>
		<label for="params[price3]">Precio</label>
		<input name="params[price3]" type="text" size="15" value="|-$priceBulletin->getPrice3()-|" />
	</p>
	<p>
		<!-- name no debe ser params[file3] porque los datos del priceBulletin se modifican con el array $_POST["params"] -->
		<label for="file3">Respaldo</label>
		<input type="file" name="file3" />		
	</p>
	<p>
		<label for="params[definitive3]">Definitivo</label>
		<input name="params[definitive3]" type="checkbox" value="1"
		       |-if $priceBulletin->getDefinitive3() eq true-|checked="checked"|-/if-|/> 
	</p>
	
	<h3>Precio del boletín</h3>
	<p>
		<label for="params[averagePrice]">Precio</label>
		<input name="params[averagePrice]" disabled="disabled" type="text" value="Calculado como promedio de los valores 1, 2 y 3" size="15" /> 
	</p>
	<p>
		<!-- si es admin debe poder marcarlo como definitivo -->
		<label for="params[definitive]">Definitivo</label>
		<input name="params[definitive]" type="checkbox" value="1" disabled="disabled"
		       |-if $priceBulletin->getDefinitive() eq true-|checked="checked"|-/if-|/> 
	</p>
	<p>
		<input name="save" id="save" type="submit" value="Guardar Cambios" /> 
		<input type='button'  value='Regresar' title="Regresar al listado de Contratistas"
		      onClick='location.href="Main.php?do=vialidadBulletinEdit&amp;id=|-$bulletin->getId()-|&amp;submit_go_edit_vialidad_bulletin=Editar"' />
	</p>
	</form>
</fieldset>
