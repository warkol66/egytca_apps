<script type="text/javascript" language="javascript" >
	$('regionMsgField').innerHTML = '<span class="resultSuccess">Barrio Agregado</span>';
	option = $('regionOption|-$region->getId()-|');
	if (option != null) {
		Element.remove('regionOption|-$region->getId()-|');
	}
	
</script>

<li id="regionListItem|-$region->getId()-|">
	|-$region->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="tableroObjectivesDoDelRegionX" />
		<input type="hidden" name="objectiveId"  value="|-$objective->getId()-|" />
		<input type="hidden" name="regionId"  value="|-$region->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromObjective(this.form)" class="buttonImageDelete" />
	</form>
</li>
