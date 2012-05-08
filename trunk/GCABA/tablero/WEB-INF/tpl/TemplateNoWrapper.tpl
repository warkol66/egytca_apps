|-if $positionHeader-||-else-|<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
|-/if-|
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
<!--[if !IE]>--> <link href="css/style_ns6+.css" rel="stylesheet" type="text/css" /> <!--<![endif]-->
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" href="css/ECOTree.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/datePicker.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/effects.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/dragdrop.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/ECOTree.js" language="JavaScript" type="text/javascript"></script>
<script src="Main.php?do=js&amp;name=js&amp;module=common&amp;code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="Main.php?do=js&amp;name=js&amp;module=categories&amp;code=|-$currentLanguageCode-|" type="text/javascript"></script></head>
|-include file='TemplateJsIncludes.tpl'-|
<script type="text/javascript"> 
 if (navigator.appName.indexOf("Microsoft")>=0) {
  if (document.documentElement.clientWidth < 900) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (document.documentElement.clientWidth > 1250)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}else{
  if (window.innerWidth < 900) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (window.innerWidth > 1250)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}
</script>
<script language="JavaScript" type="text/javascript">
	var url="|-$systemUrl-|";
</script>
|-if ($browser->getBrowser() == 'Internet Explorer' && $browser->getVersion() >= 7)-|
    <xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v"/>
    <style>v\:*{ behavior:url(#default#VML);}</style> |-/if-|        
|-if $browser->getBrowser() == 'Safari'-|
<link rel="stylesheet" href="css/style_safari.css" type="text/css" />
|-elseif $browser->getBrowser() == 'Chrome'-|
<link rel="stylesheet" href="css/style_chrome.css" type="text/css" />|-/if-|        
</head>
<body>
|-$centerHTML-|
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
