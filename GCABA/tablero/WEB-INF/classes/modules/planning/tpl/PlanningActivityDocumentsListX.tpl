<!--Se vuelven a agregar los scripts y estilos porque si no no los incluye-->
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<!--[if !IE]>--> <link href="css/style_ns6+.css" rel="stylesheet" type="text/css"> <!--<![endif]-->
<link rel="stylesheet" href="css/main.css" type="text/css">
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if gte IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="shortcut icon" href="images/favicon.ico">
<!--/-->
<div id="planningActivityDocumentsEditTemplate" style="display:none">
	|-include file="DocumentsEditInclude.tpl" entity="PlanningActivity" entityId=|-$id-| -|
</div>
<div id="documentsList">
	<div><p align="right"><a id="documentAddLink" href="#" class="addLink">Agregar nuevo documento</a></p></div>
	<div id="planningActivityDocumentsListDiv"></div>
<fieldset id="docs_list" class="noMargin"><legend>Documentos asociados</legend>
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
			</form>
			<a href="#" title="Eliminar documento" onclick="confirm('seguro eliminar?') && doDeleteDocument(|-$documentId-|, |-$planningActivityId-|); return false;"><img src="images/clear.png" class="icon iconDelete" title="Editar"/></a></span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
</ul>
|-/if-|
</fieldset>
</div>
<script>
	$('documentAddLink').onclick = function() {
		$('planningActivityDocumentsEditTemplate').show();
		$('documentsList').hide();
		return false;
	};
	
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
