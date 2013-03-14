<div id="rightColumn">
<!--Se vuelven a agregar los scripts y estilos porque si no no los incluye-->
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<link rel="stylesheet" href="css/globalStyles.css" type="text/css">
<link rel="stylesheet" href="css/globalCustom.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">
<style type="text/css">
<!--
body {	background-image: none; 	background-color: transparent;}
-->
</style>
<div id="planningActivityDocumentsEditTemplate" style="display:none">
	|-include file="DocumentsEditInclude.tpl" entity="PlanningActivity" entityId=$id-|
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
		|-assign var="document" value=$planningActivityDocument->getDocument()-|
		<li id="planningActivityDocument_|-$document->getId()-|_|-$id-|">
			<span style="float: left;width: 80%;font-weight: bold;" title="Título del documento">|-$document->getDate()|date_format-| | |-$document->getTitle()-|<br />
			<span style="float: left;margin-left: 3em;font-weight: normal;" title="Descripción del documento">|-$document->getDescription()-|</span></span>
			<span style="float: left;width: 20%;text-align: right;"><form method="POST" action="Main.php">
				<input type="hidden" name="do" value="documentsDoDownload" />
				<input type="hidden" name="id" value="|-$document->getId()-|" />
				<button type="submit" class="icon iconDownload" title="Descargar documento">ver</button>
			</form>
			<a href="#" title="Eliminar documento" onclick="confirm('¿Está seguro que desea eliminar el documento?') && doDeleteDocument(|-$document->getId()-|, |-$id-|); return false;"><img src="images/clear.png" class="icon iconDelete" title="Eliminar"/></a></span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
</ul>
|-/if-|
</fieldset>
</div>
<script language="JavaScript" type="text/javascript">
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
</div>