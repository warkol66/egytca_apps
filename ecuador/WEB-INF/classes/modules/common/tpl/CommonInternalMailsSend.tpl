<link rel="stylesheet" href="css/main.css" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(images/bkg_bodyFancybox.png);
	background-color: #dad2ca;
	background-position: top left;
	background-repeat:repeat-x;
	color: #333;
	font-size:77%; /* this makes the text sized at 10px */
	padding: 0 0 40px;
}
#wrapper {
	width: 92%;
	background-color:#fdf8e9;
	-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.5);
	box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.5);
	-webkit-border-radius: 0px 0px 10px 10px;
border-radius: 0px 0px 10px 10px;

}
#rightColumn {
	background-color: #FDF8E9;
	margin-top: 50px;
}
-->
</style>
<div id="wrapper">
<div id="rightColumn">
|-if isset($error) and $error eq 'true'-|
<div class="errorMessage">El mensaje no pudo ser enviado.</div>
|-elseif isset($success) and $success eq 'true'-|
<div class="successMessage">Mensaje enviado correctamente.</div>
|-/if-|
<form method="POST" action="Main.php">
	<input type="hidden" name="do" value="commonInternalMailsEdit" />
	<input type="hidden" name="iframe" value="true" />
	<input type="hidden" name="userId" value="|-$userId-|" />
	<input type="hidden" name="userType" value="|-$userType-|" />
	<button type="submit" title="Agregar nuevo documento">	Enviar nuevo mensaje</button>
</form>
</div>
</div>
