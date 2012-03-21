<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/datePicker.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/effects.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/dragdrop.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=common&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=categories&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=|-$module|lower-|&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
<!-- Swampy browser-->
	var sb_browser_url = '|-$scriptPath-|scripts/swampy_browser';
	var sb_site_url = '|-$systemUrl|substr:0:-9-|';
<!-- Variable width styles-->
 if (navigator.appName.indexOf("Microsoft")>=0) {
  if (document.documentElement.clientWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (document.documentElement.clientWidth > 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}else{
  if (window.innerWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (window.innerWidth > 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}
</script>
<script src="scripts/overlib.js" type="text/javascript"></script>

|-if $module eq 'Content'-|
	<script src="Main.php?do=js&name=js&module=content&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-elseif $module eq 'News'-|
	<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-elseif $module eq 'Multilang'-|
	<script src="Main.php?do=js&name=js&module=multilang&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-elseif $module eq 'Calendar'-|
	<script src="Main.php?do=js&name=js&module=calendar&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-elseif $module eq 'Positions'-|
	<script src="Main.php?do=js&name=js&module=positions" type="text/javascript"></script>
|-/if-|

|-include file="ValidationJavascriptInclude.tpl"-|
|-if $documentsUpload && $configModule->get('documents', 'useSWFUploader')-|
	|-include file="DocumentsSwfUploadInclude.tpl"-|	
|-/if-|
|-if $actualAction eq "newsArticlesEdit" or $actualAction eq "calendarEventsEdit"-|
	|-if $actualAction eq "newsArticlesEdit"-|
		<script src="scripts/news-medias.js" type="text/javascript"></script>
	|-/if-|
	<script src="scripts/swfupload/swfupload.js" type="text/javascript"></script>
	<script src="scripts/swfupload/js/fileprogress.js" type="text/javascript"></script>
	|-if $actualAction eq "newsArticlesEdit"-|
	<script src="scripts/swfupload/js/handlers.js" type="text/javascript"></script>
	|-elseif $actualAction eq "calendarEventsEdit"-|
	<script src="scripts/swfupload/js/calendarHandlers.js" type="text/javascript"></script>
	|-/if-|
	<script type="text/javascript">
			var swfu;
			
			window.onload = function () {
				swfu = new SWFUpload({
					// Backend settings
					upload_url: "../../Main.php",	// Relative to the SWF file, you can use an absolute URL as well.
					file_post_name: "media",
	
					// Flash file settings
					file_size_limit : "15360",	// 15 MB
					file_types : "*.jpg;*.png;*.gif;",	// or you could use something like: "*.doc;*.wpd;*.pdf",
					file_types_description : "Imagenes",
					file_upload_limit : "1000", // Even though I only want one file I want the user to be able to try again if an upload fails
					file_queue_limit : "1", // this isn't needed because the upload_limit will automatically place a queue limit
	
					// Event handler settings
					swfupload_loaded_handler : swfUploadLoaded,
				
					file_dialog_start_handler : fileDialogStart,		// I don't need to override this handler
					file_queued_handler : fileQueued,
					file_queue_error_handler : fileQueueError,
					file_dialog_complete_handler : fileDialogComplete,
				
					//upload_start_handler : uploadStart,	// I could do some client/JavaScript validation here, but I don't need to.
					upload_progress_handler : uploadProgress,
					upload_error_handler : uploadError,
					upload_success_handler : uploadSuccess,
					upload_complete_handler : uploadComplete,
	
					// Button Settings
					button_image_url : "/images/XPButtonUploadText_61x22.png",	// Relative to the SWF file
					button_placeholder_id : "spanButtonPlaceholder",
					button_width: 61,
					button_height: 22,
	
					// Flash Settings
					flash_url : "scripts/swfupload/swfupload.swf",	// Relative to this file
	
					custom_settings : {
						progress_target : "fsUploadProgress",
						upload_successful : false
					},
				
					// Debug settings
					debug: true
				});
			
			};
	</script>	
|-/if-|
