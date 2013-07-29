|-if isset($errormessage)-|
	<span class="resultSuccess">Documento eliminado!</span>
|-else-|
	<script language="JavaScript" type="text/javascript">
		$('#row_|-$id-|').remove();
		$('#blogEntryDocument_|-$id-|').remove();
	</script>
|-/if-|
