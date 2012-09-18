<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/datePicker.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/effects.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/dragdrop.js" language="JavaScript" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=common&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=categories&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
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
<!-- libreria de validación client-side externa -->
<script language="JavaScript" type="text/javascript" src="scripts/js_validation_library.js"></script>
<!-- libreria de validación del framework-->
<script language="JavaScript" type="text/javascript" src="scripts/validation.js"></script>
<!-- libreria de validación del framework traducida-->
<script src="Main.php?do=js&name=validationJs&module=common&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-if $documentsUpload && $configModule->get('documents', 'useSWFUploader')-|
	|-include file="DocumentsSwfUploadInclude.tpl"-|	
|-/if-|
