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
				<button type="submit" class="icon iconDownload" title="Descargar documento">ver</button>
			</form>
			<form name='documents' id='document_|-$document->getId()-|' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$document->getId()-|'>
					|-if $usePasswords && $document->getPassword() ne ''-|
						<input type='password' name='password' />
					|-/if-|
					<input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='icon iconDelete' onclick="if (confirm('¿Seguro que desea eliminar este documento?'))$.ajax({url: 'Main.php?do=documentsDoDeleteX',data:$('#document_|-$document->getId()-|').serialize(),type: 'post',success:function(data){$('#documentOperationInfo').html(data);}});return false;" alt="Eliminar" />
			</form></a></span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
</ul>
</div>
<script type="text/javascript">
	$('#photos').html('');
	|-foreach $photos as $picture-|
		|-assign var=photo value=$picture->getDocument()-|
		var photoItem = $('<a></a>').addClass('galleryPhoto').attr('rel','unnamedGallery').attr('href','#divPhoto|-$photo->getId()-|').attr('photoId','|-$photo->getId()-|'); 
		var divPhoto = $('<div></div>').attr('id','divPhoto|-$photo->getId()-|');
		var img = $('<img />').attr('src','WEB-INF/documents/|-$photo->getId()-|');
		divPhoto = $(divPhoto).append(img);
		$('#photos').append(photoItem);
		$('#photos').append(divPhoto);
	|-/foreach-|
	
	$('a.galleryPhoto').fancybox();
	
	|-if count($photos) > 0-|
		var view = $('<a></a>').attr('href','#').attr('onClick',"$('a.galleryPhoto').first().click();return false;").text('Ver fotos');
		$('#viewPhotos').html(view);
	|-/if-|
</script>
|-/if-|
