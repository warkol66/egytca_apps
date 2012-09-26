<?php

if ($_REQUEST["autoresamplerStart"]) {
	echo "<br>Reiniciar Autoresampler";
	$autoresampler = shell_exec(dirname(__FILE__).'/WEB-INF/classes/modules/headlines/classes/autoresampler/autoresampler start');
	echo "<br>autoresampler: " . $autoresampler;
}
if ($_REQUEST["autoresamplerStop"]) {
	echo "<br>Reiniciar Autoresampler";
	$autoresampler = shell_exec(dirname(__FILE__).'/WEB-INF/classes/modules/headlines/classes/autoresampler/autoresampler stop');
	echo "<br>autoresampler: " . $autoresampler;
}
	
echo "shell_exec('" . dirname(__FILE__) . "/WEB-INF/classes/modules/headlines/classes/autodwnlder/autodwnlder status')";
$autodwnlder = shell_exec(dirname(__FILE__).'/WEB-INF/classes/modules/headlines/classes/autodwnlder/autodwnlder status');
echo "<br>autodwnlder: " . $autodwnlder;
$autoresampler = shell_exec(dirname(__FILE__).'/WEB-INF/classes/modules/headlines/classes/autoresampler/autoresampler status');
echo "<br>autoresampler: " . $autoresampler;
?>
<form name="form1" method="post" action="testServices.php">
  <input type="submit" name="Submit" value="Iniciar Autoresampler" />
	<input type="hidden" name="autoresamplerStart" value="true"/>
</form>
<form name="form1" method="post" action="testServices.php">
  <input type="submit" name="Submit" value="Detener Autoresampler" />
	<input type="hidden" name="autoresamplerStop" value="true"/>
</form>
