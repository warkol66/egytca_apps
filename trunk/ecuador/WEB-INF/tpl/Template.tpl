<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
|-block name="title"-|<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>|-/block-|
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css">
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if gt IE 6]> <link href="css/styles-ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
<link rel="shortcut icon" href="images/favicon.ico">
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
<!--TemplateJsIncludes.tpl-->
|-include file='TemplateJsIncludes.jquery.tpl'-|
<script language="JavaScript" type="text/JavaScript">
	//jQuery.noConflict();
</script>
</head>
<body>
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header"><span>Empoderando al ciudadano,<br />gracias a los Derechos y Obligaciones conferidos <br />en las Leyes de Autonomía y Descentralización</span>
     <ul>
       	<li><a href="#" class="facebook"></a></li>
       	<li><a href="#" class="twitter"></a></li>
      </ul>                
		<a href="Main.php"><strong>|-$parameters.siteName-|</strong></a>
		<h1 id="headerLogo">
			<a href="index.html"><strong>Parroquias Rurales Ecuador</strong></a>
		</h1>
	</div>
	<!-- End Header -->
	<!-- Begin contentWrapper -->
		<div id="contentWrapper">
			<!-- Begin Left Column -->
			<div class="clear"></div>
				<div class="allColumns">
					|-include file="MenuHorizontal.tpl"-|
				</div>
			<!-- End Left Column -->
			<!-- Begin Right Column -->
				<div id="rightColumn" class="home">
					<!--centerHTML start-->
					|-$centerHTML-|
					<!--centerHTML end -->
				</div>
			<!-- End Right Column -->
	<!-- Begin contentCloser -->
	<div id="contentCloser"></div>
	<!-- End contentCloser -->
	</div>
	<!-- End contentWrapper -->
	<!-- Begin Footer -->
	<div id="footer">		       
		<ul>							|-include file='MenuBottomInclude.tpl'-|
</ul>
		<p>Copyright©2013 Líderes Parroquias Rurales Ecuador / Desarrollado por Módulos Empresarios.</p>
	</div>
	<!-- End Footer -->
</div>
<!-- End Wrapper -->
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

