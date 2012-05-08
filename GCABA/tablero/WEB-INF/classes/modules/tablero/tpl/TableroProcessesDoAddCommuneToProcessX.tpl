<script type="text/javascript" language="javascript">
	$('communeMsgField').innerHTML = '<span class="resultSuccess">Comuna Agregada</span>';
	option = $('communeOption|-$commune->getId()-|');
	if (option != null) {
		Element.remove('communeOption|-$commune->getId()-|');
	}
</script>
<li id="communeListItem|-$commune->getId()-|">
	|-$commune->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="tableroProcessesDoDeleteCommuneX" />
		<input type="hidden" name="processId"  value="|-$process->getId()-|" />
		<input type="hidden" name="communeId"  value="|-$commune->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:tableroDeleteCommuneFromProcess(this.form)" class="imageButtonDelete"/>
	</form>

</li>
