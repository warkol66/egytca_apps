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

<script src="scripts/jquery/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/jquery/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/overlib.js" type="text/javascript"></script>

|-include file="ValidationJavascriptInclude.jquery.tpl"-|