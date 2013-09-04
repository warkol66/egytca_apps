<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
|-block name="title"-|<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>|-/block-|
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
<!--[if lte IE 6]> <link href="css/styles-ie.css" rel="stylesheet" type="text/css" /> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css" /> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css" /> <![endif]-->
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
|-include file='TemplateJsIncludes.tpl'-|
</head>
<body>
<!--	<img src="images/logo_200.png" style="margin-left:30px; top: 0; float: left; position: fixed; z-index: 50002"/> -->
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header">
		<div id="headerLogo"></div>
		<a href="Main.php"><strong>|-$parameters.siteName-|</strong></a>
	</div>
	<!-- End Header -->
	<!-- Begin contentWrapper -->
	        <!-- 	Begin MenuHorizontal-->
				|-include file="MenuHorizontal.tpl"-|
        <!-- 	End MenuHorizontal-->

		<div id="separatorHeader"></div>
		<div id="contentWrapper">
			<!-- Begin Left Column -->
				<div id="leftColumn">
					|-include file="MenuLeft.tpl"-|
				</div>
			<!-- End Left Column -->
			<!-- Begin Right Column -->
				<div id="rightColumn">
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
		<div id="separatorFooter"></div>
</div>
<!-- End Wrapper -->
	<div id="footer">		       
		<p>Desarrollado por Módulos Empresarios.</p>
	</div>
	<!-- End Footer -->
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

