	|-if $formMessage neq ''-|
		<div class='formSuccessMessage'>|-$formMessage-|</div>
	|-/if-|
	|-if $capchaError neq ''-|
		<div class='formFailureMessage'>Captcha Invalido. Por favor vuelva a completar el formulario.</div>	
	|-/if-|
	<div id=titleContent>
		<h1>|-$contentData.title-|</h1>
	</div>
	|-$contentData.content-|
