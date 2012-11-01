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
						<input type="hidden" name="do" id="do" value="requirementsDevelopmentsDoDeleteAttendantX" />
						<input type="hidden" name="id" id="id" value="|-*$asocAttendant->getId()*-|" />
						<input type="button" value="Eliminar" onClick="javascript:developmentsDoDeleteAttendant(this.form)" class="icon iconDelete" title="Eliminar el recurso del desarrollo"/> 
					</form> |-$resource->getName()-|
				</li> 
