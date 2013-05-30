<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>
<script type="text/javascript">
	
	var galleryOptions; 
	
	$(document).ready(function() {
		
		galleryOptions = {
			titleShow: true,
			titlePosition: 'inside',
			titleFormat: function(title, currentArray, currentIndex, currentOpts) {
				var a = currentArray[currentIndex];
				var photoDiv = $('<div></div>');
				$('<p><span id="title" class="jeditable_'+$(a).attr('photoId')+'">'+$(a).attr('photoTitle')+'</span></p>').appendTo(photoDiv);
				$('<p><span id="description" class="jeditable_'+$(a).attr('photoId')+'">'+$(a).attr('photoDescription')+'</span></p>').appendTo(photoDiv);
				return photoDiv;
			},
			onComplete: function(currentArray, currentIndex) {
				var a = currentArray[currentIndex];
				$('.jeditable_'+$(a).attr('photoId')).editable('Main.php?do=resourcesDoEditParam', {
					id: 'paramName',
					name: 'paramValue',
					submitdata: { id: $(a).attr('photoId') },
					submit: 'OK',
					cancel: 'Cancel',
					indicator : 'Saving...',
					callback: function(value, settings) {
						$(a).attr('photo'+$(this).attr('id'), value);
					}
				});
			}
		}
		
		$('a.galleryPhoto').fancybox(galleryOptions);
		|-if !$blogEntry->isNew()-|
			$('a#photoAdd').fancybox({
				onComplete: function() {
					swfuInit();
				}
			});
		|-/if-|
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
<div id="documents"></div>
<fieldset id="docs_list" class="noMargin"><legend>Documentos asociados</legend>
	<div><p align="right">
		<a class="iframe addLink" id="fancybox_document" href="Main.php?do=documentsEdit&entityId=|-$id-|&requester=Blog&entity=BlogEntry&entityId=|-$id-|">Agregar nuevo documento</a>
	</p></div>
	|-if count($photos) > 0-|
	<div><p align="right">
		<a href="#" onclick="$('a.galleryPhoto').first().click();">Ver fotos</a>
	</p></div>
	|-/if-|
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
				<!--input type="hidden" name="module" value="Blog" /-->
				<button type="submit" class="icon iconDownload" title="Descargar documento">ver</button>
			</form>
			<form name='documents' id='document_|-$document->getId()-|' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					<input type=hidden name='category' value='|-$document->getCategoryid()-|'>
					|-if $usePasswords && $document->getPassword() ne ''-|
						<input type='password' name='password' />
					|-/if-|
					<!--input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='icon iconDelete' onclick="if (confirm('¿Seguro que desea eliminar este documento?'))$.ajax({url: 'Main.php?do=documentsDoDeleteX',data:$('#documents').serialize(),type: 'post',success:function(data){$('#documentOperationInfo').html(data);}});return false;" alt="Eliminar" /-->
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
	
	$('a.fancygallery').fancybox(); 
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
