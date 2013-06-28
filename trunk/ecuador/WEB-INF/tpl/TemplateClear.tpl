<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>|-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="images/favicon.ico">
<script language="JavaScript" type="text/javascript" src="scripts/prototype.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/functions.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/datePicker.js"></script>
<script language="JavaScript" src="scripts/scriptaculous.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/behaviour.js"></script>
<script type="text/javascript" src="scripts/soundmanager.js"></script>
<script type="text/javascript" src="scripts/slideshow.js"></script>
<script type="text/javascript" src="scripts/newsletter-schedule.js"></script>
<script type="text/javascript" src="scripts/news.js"></script>
<script type="text/javascript" src="scripts/calendar.js"></script>
|-if $module eq 'content'-|<script language="JavaScript" src="scripts/scriptaculous.js?load=effects,dragdrop" type="text/javascript"></script>|-/if-|
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
|-if $loadAreaedit eq 1-||-include file='ContentEditAreaeditInclude.tpl' editors="content"-||-/if-|
</head>
<body>
	|-$centerHTML-|
</body>
</html>