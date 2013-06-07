<span class="resultSuccess">Documento eliminado!</span>

<script language="JavaScript" type="text/javascript">
	$('#row_|-$id-|').remove();
	$('#blogEntryDocument_|-$id-|').remove();
	
	|-if isset($objectId)-|
	$.ajax({
			url: 'Main.php?do=blogDocumentsListX',
			data: {id: |-$objectId-|},
			type: 'post',
			success: function(data){
				$('#blogEntryDocumentsListDiv').html(data);
			}	
		});
	|-/if-|
</script>
