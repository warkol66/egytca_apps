|-if isset($error)-|
	$('budgetMessage').innerHTML = '<div id="errorMessage">Se generó el siguiente error: |-$error-|</div>';
|-/if-|
