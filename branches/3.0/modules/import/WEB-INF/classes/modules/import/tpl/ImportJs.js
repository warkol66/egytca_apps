//agrega un producto a una cotidzacion de cliente
function importAddItemToClientQuoteX(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'clientQuoteItemList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	if ($('productSearchMsgBox'))
		$('productSearchMsgBox').innerHTML = '<span class="inProgress">... ##import,84,Agegando producto## ...</span>';
	
	return true;
}

function importSearchProductsX(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'productAdder'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});

	if ($('productSearchMsgBox'))
		$('productSearchMsgBox').innerHTML = '<span class="inProgress">... ##import,85,buscando## ...</span>';

	return true;
	
}

function importShowDiv(id) {
	
	if ($(id)) {
		$(id).show();
	}
	
}

function importHideDiv(id) {
	
	if ($(id)) {
		$(id).hide();
	}
	
}

function importUpdateItemsBySupplier(supplierId,clientQuoteId) {
	if (supplierId == '') {
		return false;
	}
	
	var fields = 'do=importClientQuoteItemsSupplierX&supplierId=' + supplierId + '&clientQuoteId=' + clientQuoteId;
	var myAjax = new Ajax.Updater(
				{success: 'assignmentMsgBox'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});

	if ($('assignmentMsgBox'))
		$('assignmentMsgBox').innerHTML = '<span class="inProgress">... ##import,86,procesando, cargando valores por default de incoterm y puerto para el proveedor## ...</span>';

	return true;	

}

function importSelectAllByName(name) {
	var elements = document.getElementsByName(name);
	
	for (var i=0; i < elements.length; i++) {
		elements[i].checked = 'checked';
	};
	
	return true;
}

function importSelectAllByTagName(name) {
	var elements = document.getElementsByTagName(name);
	
	for (var i=0; i < elements.length; i++) {
		elements[i].checked = 'checked';
	};
	
	return true;
}

function importDeleteItemFromClientQuoteX(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'productSearchMsgBox'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,

				});
	if ($('productSearchMsgBox'))
		$('productSearchMsgBox').innerHTML = '<span class="inProgress">... ##import,87,eliminando producto## ...</span>';
	
	return true;
}

function importGetSupplierPurchaseOrdersX(select) {
	
	var supplierId = select.value;
	var query = 'do=importSupplierOrderGetX&id=' + supplierId;
	
	var myAjax = new Ajax.Updater(
				{success: 'bankTransfer[supplierPurchaseOrderId]'},
				url,
				{
					method: 'post',
					postBody: query,
					evalScripts: true,

				});
	if ($('msgBox'))
		$('msgBox').innerHTML = '<span class="inProgress">... ##import,88,cargando ordenes## ...</span>';
	
	return true;
	
}
