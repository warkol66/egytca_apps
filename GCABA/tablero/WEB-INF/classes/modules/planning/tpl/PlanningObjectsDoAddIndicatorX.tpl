<script type="text/javascript" language="javascript" >
	$('indicatorMsgField').innerHTML = '<span class="resultSuccess">Indicador vinculado</span>';
</script>
<li id="indicatorListItem|-$indicator->getId()-|" title="Indicador asociado">
	<form action="Main.php" method="post" style="display:inline;"> 
		<input type="hidden" name="do" value="planningObjectsDoRemoveIndicatorX" /> 
		<input type="hidden" name="planningObjectType" value="ImpactObjective" /> 
		<input type="hidden" name="planningObjectId" value="|-$object->getId()-|" /> 
		<input type="hidden" name="indicatorId" value="|-$indicator->getId()-|" />
		<input type="button" name="submit_go_remove_indicator" value="Borrar" title="Desvincular indicador" onclick="if (confirm('Seguro que desea desvincular el indicator?')) removeIndicatorFromImpactObjective(this.form);" class="icon iconDelete" /> 
	</form> |-$indicator-|
</li>
