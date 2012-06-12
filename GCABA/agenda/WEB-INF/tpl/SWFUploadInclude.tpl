<link href="css/swfupload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/swfupload/swfupload.js"></script>
<script type="text/javascript" src="scripts/swfupload/plugins/swfupload.queue.js"></script>
<script type="text/javascript" src="scripts/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="scripts/swfupload/handlers.js"></script>
<script type="text/javascript">
	var swfu;
	var settings;
	
	window.onload = function() {
		settings = {
			flash_url : "scripts/swfupload/Flash/swfupload.swf",
			upload_url: "|-$url-|",
			post_params: {
				"isSWFU": "1",
				"PHPSESSID" : "|-$phpSessId-|"
			},
			file_post_name: "file",
			file_size_limit : "100 MB",
			file_types : "*.*",
			file_types_description : "All Files",
			file_upload_limit : 100,
			file_queue_limit : 0,
			custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "btnCancel"
			},
			debug: false,
			
			// Button settings
			button_image_url: "images/TestImageNoText_65x29.png",
			button_width: "65",
			button_height: "29",
			button_placeholder_id: "spanButtonPlaceHolder",
			button_text: '<span class="theFont">Subir</span>',
			button_text_style: ".theFont { font-size: 16; }",
			button_text_left_padding: 12,
			button_text_top_padding: 3,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			queue_complete_handler : queueComplete	// Queue plugin event
		};
		
		|-if !$preventInit-|
			swfu = new SWFUpload(settings);
		|-/if-|
	};
	
	swfuInit = function() {
		swfu = new SWFUpload(settings);
	}
</script>

<div class="swfpload"><div id="content">
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
		<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Cola de Archivos</span>
		</div>
		<div id="divStatus">0 Archivos subidos</div>
		<div>
			<span id="spanButtonPlaceHolder"></span>
			<input id="btnCancel" type="button" value="Cancelar cola" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
		</div>
	</form>
</div></div>