function showProductAdd() {
	$('product-add-box').show();
	$('product-add-link').hide();
	$('productQuantity').value = "0";
}

function cancelProductAdd() {
	$('product-add-box').hide();
	$('product-add-link').show();
	$('productQuantity').value = "0";
	
}

function productAddValidation() {
	return true;
}

//agrega un producto
function ordersItemsDoAddX(form) {
	var quantity = $('productQuantity');
	if ((quantity == "")) {
		alert('Quantity must be a valid value');
		return false;
	}
	
	$('messageAdd').innerHTML = "agregando item...";
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'productsTable'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	
	//ocultamos la caja de agregado
	
	$('product-add-box').hide();
	$('product-add-link').show();
	$('productQuantity').value = "1";
	
	return true;
}

function ordersItemsDoDeleteX(id) {
	
	var form = $('formRemove' + id);
	var message = $('messageRemove' + id);
	
	if (confirm('Esta seguro que quiere eliminar el item')) {
   
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
				{success: 'productsTable'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion : Insertion.Bottom
				});
   		
		message.innerHTML = 'eliminando item...';
   	
	}
	
	return true;
} // End of function_name