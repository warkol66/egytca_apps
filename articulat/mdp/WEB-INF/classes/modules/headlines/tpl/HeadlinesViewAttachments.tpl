|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|
<h1>Clipping Multimedia</h1>
<h3>|-$headline-|</h3>
<fieldset>
<div>
	|-foreach $images as $image-|
		<div>
			<img src="Main.php?do=headlinesAttachmentGetData&id=|-$image->getId()-|" />
		</div>
	|-/foreach-|
	|-foreach $audios as $audio-|
		<p>
			<strong>Audio |-if $audios|count gt 1-| _ |-counter name="audios_counter"-| |-/if-|</strong> <a href="Main.php?do=headlinesAttachmentGetData&id=|-$audio->getId()-|" id="player|-$audio->getId()-|" class="icon iconAudio floatRight" title="Reproducir Audio">Audio |-counter name="audios_counter"-|</a>
		</p>
	|-/foreach-|
	|-foreach $videos as $video-|
		<p>
			<strong>Video |-if $videos|count gt 1-| _ |-counter name="videos_counter"-| |-/if-|</strong> <a href="Main.php?do=headlinesAttachmentGetData&id=|-$video->getId()-|" id="player|-$video->getId()-|"  class="icon iconAudio" title="Reproducir Video">Video |-counter name="videos_counter"-| </a>
		</p>
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
</fieldset>
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