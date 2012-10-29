<script type="text/javascript" language="javascript" >
	$('affiliatesMsgField').innerHTML = '<span class="resultSuccess">Cliente asociado</span>';
	option = $('affiliatesOption|-$affiliate->getId()-|');
	if (option != null) {
		Element.remove('affiliatesOption|-$affiliate->getId()-|');
	}
	
</script>

<li id="affiliatesListItem|-$affiliate->getId()-|">
	|-$affiliate->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="" />
		<input type="hidden" name="affiliateId"  value="|-$affiliate->getId()-|" />
		<input type="button" value="Eliminar" onClick="javascript:(this.form)" class="icon iconDelete" />
	</form>
</li>
