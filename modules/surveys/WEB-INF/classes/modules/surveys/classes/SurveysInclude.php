<?php

class SurveysInclude {


	function getDisplay($options) {

		global $system;
		$showInclude = $system['config']['surveys']['showInclude']['value'];
		if (($options["includeHome"] == 1) && ($showInclude == 'NO'))
			return;

		$results = array();

		if ($options["id"] > 0)
			$survey = SurveyPeer::get($options["id"]);
		elseif ($options["lastActive"])
			$survey = SurveyPeer::getLastActive();

		if (!$survey)
			return $results;

		if ($survey->hasExpired()) {
			$results['surveyExpired'] = true;
		}

		//verificacion si solo debe ser visible para un usuario registrado
		//no es publica y no quiere acceder un usuario afiliado.
		if ((!$survey->isPublic()) && (!Common::isRegistrationUser())) {
			$results['forRegistrated'] = true;
			return $results;
		}

		//verificamos la existencia del cookie para ver si el usuario no ha respondido ya
		//la encuesta
		$cookieName = SurveyPeer::getCookieName($survey->getId(), $options['objectType'], $options['objectId']);
		$cookie = $_COOKIE[$cookieName];

		if (!empty($cookie) && $cookie == $survey->getId()) {
			//la encuesta ya fue respondida
			$results['alreadyAnswered'] = true;
		}

		//verifico la utilizacion de captcha para construir la opcion en la vista
		if (Common::getSurveysCaptchaUse()) {
			$result['useCaptcha'] = true;
		}

		$questions = $survey->getSurveyQuestions();
		$results["survey"] = $survey;
		$results["surveyQuestion"] = $questions[0];

		return $results;

	}


} // end of class