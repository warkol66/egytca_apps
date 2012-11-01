<script type="text/javascript" language="javascript" >
	$('attendantsMsgField').innerHTML = '<span class="resultSuccess">Recurso Asociado</span>';
	option = $('attendantOption|-$attendant->getAttendantid()-|');
	if (option != null) {
		Element.remove('attendantOption|-$attendant->getAttendantid()-|');
	}
</script>
		|-assign var="resource" value=$attendant->getUser()-|
				<li id="asocAttendantsListItem|-$resource->getId()-|">
					<form  method="post"> 
						<input type="hidden" name="do" id="do" value="requirementsDoDeleteAttendantX" />
						<input type="hidden" name="id" id="id" value="|-$attendant->getId()-|" />
						<input type="button" value="Eliminar" onClick="javascript:requirementsDoDeleteAttendant(this.form)" class="icon iconDelete" title="Eliminar el recurso del desarrollo"/> 
					</form> |-$resource->getName()-|
				</li> 
