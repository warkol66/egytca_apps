<script language="JavaScript" type="text/javascript">
	var message = "|-if $message eq 'deleted'-|Producto Eliminado|-/if-|";
	Element.remove('productRequest_|-$productReqId-|');
	$('msgBox').innerHTML = message;
	$('msgBox').show();
</script>
