<style type="text/css">
iframe{
    overflow:hidden;
}
</style>
<div id="documentsList">
<fieldset id="docs_list" class="noMargin"><legend>Documentos asociados</legend>
	<div><p align="right">
		<a class="iframe addLink" id="fancybox_document" href="Main.php?do=documentsEdit&entityId=|-$id-|&requester=Blog&entity=BlogEntry&entityId=|-$id-|">Agregar nuevo documento</a>
	</p></div>
<div id="blogEntryDocumentsListDiv">
<ul>
|-if $blogEntryDocumentColl|count eq 0-|
	<p>No hay documentos asociados</p>
|-else-|
	<ul class="iconList">
	|-foreach $blogEntryDocumentColl as $blogEntryDocument-|
		|-assign var="document" value=$blogEntryDocument->getDocument()-|
		<li id="blogEntryDocument_|-$document->getId()-|_|-$id-|">
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
</div>
|-/if-|
</fieldset>
</div>
<script language="JavaScript" type="text/javascript">
	
	$('a#fancybox_document').fancybox({	'autoScale': false,
										'width' : 800,
										'height' :400,
										'hideOnContentClick': true,
										'onClosed': function(){
											$.ajax({
												url: 'Main.php?do=blogDocumentsListX',
												data: {id: |-$id-|},
												type: 'post',
												success: function(data){
													$('#blogEntryDocumentsListDiv').html(data);
												}	
											});
											$('#blogEntryDocumentsListDiv').html('Actualizando documentos...');
										}
									});
	
	doDeleteDocument = function(documentId, blogEntryId) {
		/*new Ajax.Request(
			'Main.php?do=documentsDoDeleteX',
			{
				method: 'POST',
				parameters: {
					id: documentId,
					entityId: blogEntryId,
					entity: 'BlogEntry'
				},
				onSuccess: function() {
					$('blogEntryDocument_'+documentId+'_'+planningActivityId).remove();
				}
			}
		);*/
	}
</script>
