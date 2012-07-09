<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/datePicker.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/effects.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/dragdrop.js" language="JavaScript" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=common&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=categories&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
<!-- Swampy browser-->
	var sb_browser_url = '|-$scriptPath-|scripts/swampy_browser';
	var sb_site_url = '|-$systemUrl|substr:0:-9-|';
<!-- Variable width styles-->
 if (navigator.appName.indexOf("Microsoft")>=0) {
  if (document.documentElement.clientWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (document.documentElement.clientWidth  >= 1280 && document.documentElement.clientWidth < 1600)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
	else
		document.write('<link href="css/styleWide+.css" rel="stylesheet" type="text/css">');
}else{
  if (window.innerWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (window.innerWidth  >= 1280 && window.innerWidth  < 1600)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
	else
		document.write('<link href="css/styleWide+.css" rel="stylesheet" type="text/css">');
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
