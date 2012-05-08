<script type="text/javascript" language="javascript" >
	$('regionMsgField').innerHTML = '<span class="resultSuccess">Barrio Agregado</span>';
</script>

<li id="regionListItem|-$region->getId()-|">
	|-$region->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="tableroProcessesDoDelRegionX" />
		<input type="hidden" name="processId"  value="|-$process->getId()-|" />
		<input type="hidden" name="regionId"  value="|-$region->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromProcess(this.form)" class="icon iconDelete" />
	</form>
</li>
