<script type="text/javascript" language="javascript" charset="utf-8">
// <![CDATA[
	var message = |-if $message eq "accepted"-|"Se ha aceptado la cotizacion"|-/if-||-if $message eq "rejected"-|"Se ha rechazado la cotizacion"|-/if-|;
	$('msgBox').innerHTML = message;
	$('msgBox').show();
	$('productRequestStatus').innerHTML = '|- $productRequest->getStatus()-|';
	$('affiliateActionsText').innerHTML = '<p>No hay acciones para realizar en este Estado</p>';
// ]]>
</script>
