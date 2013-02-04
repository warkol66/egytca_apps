|-if $planningActivityDocumentColl|count eq 0-|
	<li>No hay documentos asociados</li>
|-else-|
	|-foreach $planningActivityDocumentColl as $planningActivityDocument-|
		|-assign var="planningActivityId" value=$planningActivityDocument->getPlanningActivity()->getId()-|
		|-assign var="documentId" value=$planningActivityDocument->getDocument()->getId()-|
		<li id="planningActivityDocument_|-$documentId-|_|-$planningActivityId-|">
			<span>|-$planningActivityDocument->getDocument()->getTitle()-|</span>
			<form method="POST" action="Main.php">
				<input type="hidden" name="do" value="documentsDoDownload" />
				<input type="hidden" name="id" value="|-$documentId-|" />
				<button type="submit">ver</button>
			</form>
			<a href="#">editar</a>
			<a href="#" onclick="confirm('seguro eliminar?') && doDeleteDocument(|-$documentId-|, |-$planningActivityId-|)">borrar</a>
		</li>
	|-/foreach-|
|-/if-|

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