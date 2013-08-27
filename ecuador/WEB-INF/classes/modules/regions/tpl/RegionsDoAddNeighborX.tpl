<script type="text/javascript">
	jQuery.noConflict();
|-if $message eq "duplicate"-|
	jQuery('#neighborMsgField').html('<span class="resultFailure">La región ya es vecina</span>');
</script>
|-elseif $message eq "error"-|
	jQuery('#neighborMsgField').html('<span class="resultFailure">Error al relacionar la región</span>');
</script>
|-else-|
	jQuery('#neighborMsgField').html('<span class="resultSuccess">Región Vecina Agregada</span>');
	if (jQuery('#neighborOption|-$newNeighbor->getId()-|') != null) {
		jQuery('#neighborOption|-$newNeighbor->getId()-|').remove();
	}
</script>

<li id="neighborListItem|-$newNeighbor->getId()-|">
	<form  method="post"> 
		<input type="hidden" name="do" id="do" value="" /> 
		<input type="hidden" name="regionId"  value="|-$region->getId()-|" /> 
		<input type="hidden" name="neighborId"  value="|-$newNeighbor->getId()-|" /> 
		<input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar el vínculo con la región?')){deleteNeighborFromrRegion(this.form)}; return false" class="icon iconDelete" /> 
	</form>
	<span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$newNeighbor->getName()-|</span>
</li>
|-/if-|
