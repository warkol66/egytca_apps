<script type="text/javascript">
	|-if $type eq 'Imagen'-|
		$('#imagesList_|-$id-|').remove();
	|-/if-|
	
	|-if $type eq 'Video'-|
		$('#videosList_|-$id-|').remove();
	|-/if-|

	|-if $type eq 'Sonido'-|
		$('#soundsList_|-$id-|').remove();
	|-/if-|	
		
</script>
