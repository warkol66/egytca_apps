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
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}else{
  if (window.innerWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (window.innerWidth >= 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}
</script>

<script src="scripts/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/overlib.js" type="text/javascript"></script>

|-include file="ValidationJavascriptInclude.jquery.tpl"-|