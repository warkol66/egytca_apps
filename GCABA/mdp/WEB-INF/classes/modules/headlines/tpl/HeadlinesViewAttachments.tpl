|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|
<div>
	|-foreach $images as $image-|
		<div>
			<img src="Main.php?do=headlinesAttachmentGetData&id=|-$image->getId()-|" />
		</div>
	|-/foreach-|
	|-foreach $audios as $audio-|
		<div>
			<a href="Main.php?do=headlinesAttachmentGetData&id=|-$audio->getId()-|" id="player|-$audio->getId()-|" style="display:block;width:648px;height:30px;">
				Audio |-counter name="audios_counter"-|
			</a>
		</div>
	|-/foreach-|
	|-foreach $videos as $video-|
		<div>
			<a href="Main.php?do=headlinesAttachmentGetData&id=|-$video->getId()-|" id="player|-$video->getId()-|">
				Video |-counter name="videos_counter"-|
			</a>
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

<!--<script src="scripts/flowplayer/flowplayer-3.2.11.min.js"></script>-->
<script>
	Event.observe(
		window,
		"load",
		function() {
			|-*|-foreach $audios as $audio-|
				flowplayer("player|-$audio->getId()-|", "scripts/flowplayer/flowplayer-3.2.14.swf", {
					plugins: {
						audio: {
							url: "scripts/flowplayer/flowplayer.audio-3.2.10.swf"
						}
					},
					clip: {
						url: "Main.php?do=headlinesAttachmentGetData&id=|-$audio->getId()-|",
						provider: "audio"
					}
				});
			|-/foreach-|*-|
		}
	);
	
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