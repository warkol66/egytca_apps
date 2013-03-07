<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
<!-- Swampy browser-->
	var sb_browser_url = '|-$scriptPath-|scripts/swampy_browser';
	var sb_site_url = '|-$systemUrl|substr:0:-9-|';
	<!-- Variable width styles-->
	var browserWidth = window.innerWidth || document.documentElement.clientWidth;
		if (browserWidth < 1000) document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
		else if (browserWidth > 1500) document.write('<link href="css/styleWide+.css" rel="stylesheet" type="text/css">');
		else if (browserWidth >= 1260) document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
	<!-- /Variable width styles-->
</script>
<script src="scripts/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/overlib.js" type="text/javascript"></script>
|-include file="ValidationJavascriptInclude.jquery.tpl"-|