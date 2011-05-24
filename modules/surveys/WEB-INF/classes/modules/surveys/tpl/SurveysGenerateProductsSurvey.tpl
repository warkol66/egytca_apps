<h2>Configuración del Sistema</h2>
	<h1>Generación de Encuestas de Productos</h1>
	<p>A continuación podrá crear encuestas acerca de los productos que usted seleccione.</p>
	Para crear las encuestas primero debe seleccionar hasta 10 productos y luego presionar aceptar. <br />
	<br />
	
|-if $message eq "error"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar guardar la información de la encuesta</div>
|-elseif $message eq "no-products"-|
	<div class='errorMessage'>Debe seleccionar al menos un producto y no más de 10.</div>
|-elseif $message eq "ok"-|
	<div class='successMessage'>La encuesta ha sido generada, se han enviado notificaciones a los usuarios.</div>
|-/if-|

|-if $usingAutocompleter-|
<form method="post" action="Main.php">
	<fieldset title="Formulario de edición de usuario">
	
		<div id="products" style="position: relative;">
			|-include file="CommonAutocompleterInstanceInclude.tpl" id="autocomplete_products" label="Productos: " defaultValue="" defaultHiddenValue="" url="Main.php?do=catalogProductsAutocompleteListX" afterUpdateElement="productsAfterUpdateElement"-|
		</div>
		
		<span id="indicator1" style="display: none">
			<img src="images/spinner.gif" alt="Procesando..." />
		</span>
		
		<p>
			<ul id="productsSelected">
			</ul>
		</p>
		
		<p>
			<input type="hidden" name="do" value="surveysDoGenerateProductsSurvey" />
			<input type="submit" id="button_submit_survey" name="button_submit" value="Aceptar" title="Aceptar" />
			<input type='button' onClick='javascript:history.go(-1)' value='Regresar' />
		</p>
	</fieldset>
</form>

|-include file="CommonAutocompleterInclude.tpl" -|

<script type="text/javascript" language="javascript" charset="utf-8">

var alredySelected = new Hash({'alredySelectedIds[]': []});

function productsAfterUpdateElement(text, li) {
	$('autocomplete_products').value = '';
	var idx = $$('#productsSelected > li').size();
	if (idx < 10) {
		$('productsSelected').insert('<li><input type="hidden" name="survey[productsIds]['+idx+']" value="'+li.id+'" />'+li.innerHTML.stripTags()+'<input type="button" class="icon iconDelete" onClick="removeProduct(this.parentNode, '+li.id+')" /></li>')
    	alredySelected.get('alredySelectedIds[]').push(li.id);
		autocomplete_products_instance.url = 'Main.php?do=catalogProductsAutocompleteListX&' + Object.toQueryString(alredySelected);    
    }
    if (!li.hasClassName('informative_only')) {
        var submit = $('button_submit_survey');
        if (Object.isElement(submit))
    		submit.enable();
	}
}

function removeProduct(li, id) {
	alredySelected.set('alredySelectedIds[]', alredySelected.get('alredySelectedIds[]').without(id));
	autocomplete_products_instance.url = 'Main.php?do=catalogProductsAutocompleteListX&' + Object.toQueryString(alredySelected); 
	li.remove();
}

</script>
|-else-|

<form method="post" action="Main.php">
	<fieldset title="Formulario de edición de usuario">
		<p>
			<div class='errorMessage' id="validationErrorMsg" style="display:none;">Debe seleccionar al menos un producto y no más de 10.</div>
		</p>
		<p>
			<select name="categoryId" onChange="getProductsByCategoryX(this.form); return;">
				|-foreach from=$productCategories item=productCategory-|
					<option value="|-$productCategory->getId()-|">|-$productCategory-|</option>
				|-/foreach-|
			</select>
		</p>		
		
		<p>
			<ul id="productsSelected">
				|-include file="CatalogProductsGetProductsByCategoryX.tpl"-|
			</ul>
		</p>
		
		<p>
			<input type="hidden" name="do" value="surveysDoGenerateProductsSurvey" />
			<input type="submit" id="button_submit_survey" name="button_submit" value="Aceptar" title="Aceptar" onClick="return validateSelectionCount(this.form)" />
			<input type='button' onClick='javascript:history.go(-1)' value='Regresar' />
		</p>
	</fieldset>
</form>

<script type="text/javascript" language="javascript" charset="utf-8">
	function getProductsByCategoryX(form) {
		var fields = Form.serialize(form, true);
		fields.do = 'catalogProductsGetProductsByCategoryX';
		fields = Object.toQueryString(fields);
		var myAjax = new Ajax.Updater(
			{success: 'productsSelected'},
			'Main.php',
			{
				method: 'post',
				postBody: fields,
				evalScripts: true
			}
		);
	
		return true;
	}
	
	function validateSelectionCount() {
		var count = $$('ul#productsSelected > li > input:checked[type="checkbox"]').size();
		if (count > 10 || count < 1) {
			$('validationErrorMsg').show();
			return false;
		} else {
			return true;
		}
	}
</script>

|-/if-|