<script type="text/javascript" language="javascript" >
	$('regionMsgField').innerHTML = '<span class="resultSuccess">Barrio Agregado</span>';
</script>

<li id="regionListItem|-$region->getId()-|">
	|-$region->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="tableroProjectsDoDelRegionX" />
		<input type="hidden" name="projectId"  value="|-$project->getId()-|" />
		<input type="hidden" name="regionId"  value="|-$region->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:tableroDeleteRegionFromProject(this.form)" class="buttonImageDelete" />
	</form>
</li>
