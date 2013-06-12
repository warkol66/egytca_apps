<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>
<script type="text/javascript">
	
	var galleryOptions; 
	
	$(document).ready(function() {
		
		galleryOptions = {
			titleShow: false
		}
		
		$('a.galleryPhoto').fancybox(galleryOptions);
	});
	
	$('#params_visitDate').datepicker();
	
	inspectionPhotoUploadSuccess = function (file, serverData) {
	try {
		var parsedData = JSON.parse(serverData);
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		
		if (parsedData.error == 1) {
			progress.setError();
			progress.setStatus(parsedData.message);
		} else {
			progress.setComplete();
			progress.setStatus('Complete.');
			var data = JSON.parse(parsedData.data);
			var photo = JSON.parse(data.photo);
			$.ajax({
				url: 'Main.php?do=constructionsInspectionsLoadGalleryPhotoX',
				type: 'post',
				data: { photoId: photo.Id },
				success: function(data) {
					$(data).appendTo($('#photos'));
					$('a.galleryPhoto').fancybox(galleryOptions);
				}
			});
		}
		
		progress.toggleCancel(false);

	} catch (ex) {
		this.debug(ex);
	}
}
</script>
<style type="text/css">
iframe{
    overflow:hidden;
}
</style>
<div id="documentsList">
<div id="documentOperationInfo"></div>
<fieldset id="docs_list" class="noMargin"><legend>Documentos asociados</legend>
	<div id="actions"><p align="right">
		<a class="iframe addLink" id="fancybox_document" href="Main.php?do=documentsEdit&entityId=|-$id-|&requester=Blog&entity=BlogEntry&entityId=|-$id-|">Agregar nuevo documento</a>
	</p>
	<p id="viewPhotos" align="right">
	|-if count($photos) > 0-|
		<a href="#" onclick="$('a.galleryPhoto').first().click();return false;">Ver fotos</a>
	|-/if-|
	</p>
	</div>
<div id="blogEntryDocumentsListDiv">
<ul>
|-if $blogEntryDocumentColl|count eq 0-|
	<p>No hay documentos asociados</p>
|-else-|
	<ul class="iconList">
	|-foreach $blogEntryDocumentColl as $blogEntryDocument-|
		|-assign var="document" value=$blogEntryDocument->getDocument()-|
		<li id="blogEntryDocument_|-$document->getId()-|">
			<span style="float: left;width: 80%;font-weight: bold;" title="Título del documento">|-$document->getDate()|date_format-| | |-$document->getTitle()-|<br />
			<span style="float: left;margin-left: 3em;font-weight: normal;" title="Descripción del documento">|-$document->getDescription()-|</span></span>
			<span style="float: left;width: 20%;text-align: right;"><form method="POST" action="Main.php">
				<input type="hidden" name="do" value="documentsDoDownload" />
				<input type="hidden" name="id" value="|-$document->getId()-|" />
				<!--input type="hidden" name="module" value="Blog" /-->
				<button type="submit" class="icon iconDownload" title="Descargar documento">ver</button>
			</form>
			<form name='documents' id='document_|-$document->getId()-|' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					<input type=hidden name='objectId' value='|-$id-|'>
					|-if $usePasswords && $document->getPassword() ne ''-|
						<input type='password' name='password' />
					|-/if-|
					<input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='icon iconDelete' onclick="if (confirm('¿Seguro que desea eliminar este documento?'))deleteDocument(|-$document->getId()-|,|-$id-|);return false;" alt="Eliminar" />
			</form></span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
</ul>
</div>
|-/if-|
</fieldset>
</div>
<script language="JavaScript" type="text/javascript">
	
	function deleteDocument(documentId, entryId){
		$.ajax({
			url: 'Main.php?do=documentsDoDeleteX',
			data:$('#document_' + documentId).serialize(),
			type: 'post',
			success:function(){
				$('#documentOperationInfo').html(data);
				$.ajax({
					url: 'Main.php?do=blogDocumentsListX',
					data: {id: entryId},
					type: 'post',
					success: function(data){
						$('#blogEntryDocumentsListDiv').html(data);
					}	
				});
			}
		});
	
	}
	
	$('a.fancygallery').fancybox(); 
	$('a#fancybox_document').fancybox({	'autoScale': false,
										'width' : 800,
										'height' :420,
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
</script>
<div id="photos" style="display:none">
|-foreach $photos as $picture-|
	|-assign var=photo value=$picture->getDocument()-|
	<a class="galleryPhoto" rel="unnamedGallery" href="#divPhoto|-$photo->getId()-|"
	photoId="|-$photo->getId()-|"
	></a>
	<div id="divPhoto|-$photo->getId()-|">
	<img src="WEB-INF/documents/|-$photo->getId()-|" alt=""/>
	</div>
|-/foreach-|
</div>
