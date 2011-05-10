|-if $result|@count neq 0-|
	|-if $result.forRegistrated neq '' and $result.forRegistrated-|
		<p>
			La encuesta es solo para usuarios registrados. Para poder acceder a ella debe <a href="Main.php?do=registrationLogin">acceder con su cuenta</a> o <a href="Main.php?do=registrationEdit">crear una</a>
		</p>
	|-else-|
		<div id="surveyPlaceholder">
			|-include file="SurveysShowInclude.tpl" survey=$result.survey surveyQuestion=$result.surveyQuestion alreadyAnswered=$result.alreadyAnswered useCaptcha=$result.useCaptcha-|
		</div>
	|-/if-|
|-/if-|