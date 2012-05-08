<script type="text/javascript" language="javascript" >
	$('regionMsgField').innerHTML = '<span class="resultSuccess">Región Agregada</span>';
	option = $('regionOption|-$region->getId()-|');
	if (option != null) {
		Element.remove('regionOption|-$region->getId()-|');
	}
	
</script>

<li id="regionListItem|-$region->getId()-|">
	
	<form  method="post">
		<input type="hidden" name="do" id="do" value="projectsDoDelRegionX" />
		<input type="hidden" name="projectId"  value="|-$project->getId()-|" />
		<input type="hidden" name="regionId"  value="|-$region->getId()-|" />			
	  <input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar el vínculo con la región?')){deleteRegionFromProject(this.form)}; return false" class="icon iconDelete" /> 
	</form><span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$region->getName()-|</span>
</li>
