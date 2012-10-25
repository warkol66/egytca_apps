<script type="text/javascript" language="javascript" >
	$('developmentMsgField').innerHTML = '<span class="resultSuccess">Desarrollo Asociado</span>';
	option = $('developmentOption|-$development->getId()-|');
	if (option != null) {
		Element.remove('developmentOption|-$development->getId()-|');
	}
	
</script>

<li id="developmentsListItem|-$development->getId()-|">
	|-$development->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="requirementsDoRemoveDevelopmentX" />
		<input type="hidden" name="developmentId"  value="|-$development->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:requirementsDoRemoveDevelopment(this.form)" class="icon iconDelete" />
	</form>
</li>
