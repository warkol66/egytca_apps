<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>|-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css">
<!--[if lte IE 6]> <link href="css/styles-ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" href="css/mainHandheld.css" type="text/css" media="handheld">
<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
<link rel="shortcut icon" href="images/favicon.ico">
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
|-include file='TemplateJsIncludes.tpl'-|
</head>
<body>
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header">
		<div id="headerLogo"><img src="images/logo_new.png" /></div>
		<a href="Main.php"><strong>|-$parameters.siteName-|</strong></a>
	</div>
		<!-- End Header -->
	<!-- Begin contentWrapper -->
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
	<div id="footer">		       
		<p>&nbsp;</p>
	</div>
	<!-- End Footer -->
</div>
<!-- End Wrapper -->
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>