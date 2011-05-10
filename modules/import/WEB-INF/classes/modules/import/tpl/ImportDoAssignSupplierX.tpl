<script type="text/javascript" language="javascript" charset="utf-8">
// <![CDATA[
	var message = "<span class='resultSuccess'>Se ha realizado la asignación al Proveedor y se ha modificado el estado de la solicitud</span>";
	$('msgBox').innerHTML = message;
	$('msgBox').show();
	$('productRequestStatus').innerHTML = '|- $productRequest->getStatus()-|';
	$('adminActionsText').innerHTML = '<p>No hay acciones para realizar en este Estado</p>';
// ]]>
</script>
