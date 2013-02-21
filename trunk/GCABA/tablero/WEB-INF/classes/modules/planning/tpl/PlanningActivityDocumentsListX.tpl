<fieldset id="docs_list"><legend>Documentos asociados</legend>
<ul>
|-if $planningActivityDocumentColl|count eq 0-|
	<p>No hay documentos asociados</p>
|-else-|
	<ul class="iconList">
	|-foreach $planningActivityDocumentColl as $planningActivityDocument-|
		|-assign var="planningActivityId" value=$planningActivityDocument->getPlanningActivity()->getId()-|
		|-assign var="documentId" value=$planningActivityDocument->getDocument()->getId()-|
		<li id="planningActivityDocument_|-$documentId-|_|-$planningActivityId-|">
			<span style="float:left;width:75%;" title="Título del documento">
			|-$planningActivityDocument->getDocument()->getTitle()-|</span>
			<span style="float:left;width:25%;text-align:right;"><form method="POST" action="Main.php">
				<input type="hidden" name="do" value="documentsDoDownload" />
				<input type="hidden" name="id" value="|-$documentId-|" />
				<button type="submit" class="icon iconDownload" title="Descargar documento">ver</button>
			</form><a href="#" title="Editar documento"><img src="images/clear.png" class="icon iconEdit" title="Editar"/></a>
			<a href="#" title="Eliminar documento" onclick="confirm('seguro eliminar?') && doDeleteDocument(|-$documentId-|, |-$planningActivityId-|); return false;"><img src="images/clear.png" class="icon iconDelete" title="Editar"/></a></span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
</ul>
|-/if-|
</fieldset>
<script>
	doDeleteDocument = function(documentId, planningActivityId) {
		new Ajax.Request(
			'Main.php?do=documentsDoDeleteX',
			{
				method: 'POST',
				parameters: {
					id: documentId,
					entityId: planningActivityId,
					entity: 'PlanningActivity'
				},
				onSuccess: function() {
					$('planningActivityDocument_'+documentId+'_'+planningActivityId).remove();
				}
			}
		);
	}
</script>
