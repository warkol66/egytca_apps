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
	<!--<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.20.custom.css" type="text/css">-->
<link rel="stylesheet" href="css/blitzer/jquery-ui-1.10.3.custom.css" type="text/css">

<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css">
<link type="text/css" rel="stylesheet" href="css/chosen.css" />

<script src="scripts/jquery/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/jquery-ui-1.9.1.custom.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/jquery.ui.datepicker-es.js" language="JavaScript" type="text/javascript"></script>

<script src="scripts/jquery/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/overlib.js" type="text/javascript"></script>
<script src="scripts/jquery/chosen.js"></script>
<script src="scripts/jquery/egytca.js" type="text/javascript"></script>

|-include file="ValidationJavascriptInclude.jquery.tpl"-|
