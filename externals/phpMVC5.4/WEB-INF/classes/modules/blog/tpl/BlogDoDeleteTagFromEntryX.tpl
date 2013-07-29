<script type="text/javascript" language="javascript">
	$('#tagListItem|-$tag->getId()-|').remove();
	$('#tagId').append($('<option></option>').attr('value','|-$tag->getId()-|').attr('id','categoryOption|-$tag->getId()-|').html('|-$tag->getName()-|'));
</script>
<span class="resultSuccess">Etiqueta Eliminada</span>
