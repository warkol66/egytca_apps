<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
<!-- Swampy browser-->
	var sb_browser_url = '|-$scriptPath-|scripts/swampy_browser';
	var sb_site_url = '|-$systemUrl|substr:0:-9-|';
<!-- Variable width styles-->
 if (navigator.appName.indexOf("Microsoft")>=0) {
  if (document.documentElement.clientWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (document.documentElement.clientWidth >= 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css"><link href="css/printWide.css" rel="stylesheet" type="text/css" media="print">');
}else{
  if (window.innerWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (window.innerWidth >= 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css"><link href="css/printWide.css" rel="stylesheet" type="text/css" media="print">');
}
</script>
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.20.custom.css" type="text/css">
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css">

<script src="scripts/jquery/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/jquery-ui-1.9.1.custom.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/jquery.ui.datepicker-es.js" language="JavaScript" type="text/javascript"></script>

<script src="scripts/jquery/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/overlib.js" type="text/javascript"></script>

|-include file="ValidationJavascriptInclude.jquery.tpl"-|
