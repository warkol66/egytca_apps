<script type="text/javascript" language="javascript" >
	$('regionMsgField').innerHTML = '<span class="resultSuccess">Región Agregada</span>';
	option = $('regionOption|-$region->getId()-|');
	if (option != null) {
		Element.remove('regionOption|-$region->getId()-|');
	}
	
</script>

<li id="regionListItem|-$region->getId()-|">
	|-$region->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="objectivesDoDelRegionX" />
		<input type="hidden" name="objectiveId"  value="|-$objective->getId()-|" />
		<input type="hidden" name="regionId"  value="|-$region->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:deleteRegionFromObjective(this.form)" class="icon iconDelete" />
	</form>
</li>
