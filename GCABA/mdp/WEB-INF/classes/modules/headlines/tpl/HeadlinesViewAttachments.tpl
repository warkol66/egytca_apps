|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|
<div>
	|-foreach $images as $image-|
		<div>
			<img src="Main.php?do=headlinesGetClipping&image=|-$image.name-|" width="|-$image.displayedWidth-|" height="|-$image.displayedHeight-|" />
		</div>
	|-/foreach-|
	|-foreach $audios as $audio-|
		<div>
			|-$video-|
		</div>
	|-/foreach-|
	|-foreach $videos as $video-|
		<div>
			|-$audio-|
		</div>
	|-/foreach-|
	|-foreach $missingAttachments as $missingAttachment-|
		<div id="missing|-$missingAttachment->getId()-|">
			<span>
				Archivo faltante:&nbsp;
				<button onclick="downloadAttachment('|-$missingAttachment->getId()-|')">descargar</button>
			</span>
		</div>
	|-/foreach-|
</div>

<script>
	function downloadAttachment(id) {
		new Ajax.Updater(
			'missing'+id,
			'Main.php?do=headlinesAttachmentDownloadX',
			{
				method: 'post',
				parameters: { id: id }
			}
		);
	}
</script>
|-/if-|