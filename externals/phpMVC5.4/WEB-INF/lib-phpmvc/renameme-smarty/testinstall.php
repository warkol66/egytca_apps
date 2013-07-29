<?php

require_once 'RenameMeSmarty.php';

$smarty = new RenameMeSmarty();
$installOk = $smarty->testInstall();

if ($installOk) {
	echo '<p style="color:green;"><b>OK</b></p>';
} else {
	echo '<p style="color:red;"><b>ERRORS</b></p>';
}
