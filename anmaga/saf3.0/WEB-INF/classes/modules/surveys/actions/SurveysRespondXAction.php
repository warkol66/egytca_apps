<?php

class SurveysRespondXAction extends BaseAction {

	private $answerParams;
	private $answersToSave = array();
	private $survey;

	function SurveysRespondXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Surveys";
		$smarty->assign("module",$module);
		$section = "Surveys";
		$smarty->assign("section",$section);

		$this->survey = SurveyPeer::get($_POST['surveyId']);
		if (empty($this->survey))
			return $mapping->findForwardConfig('failure');

		//Preparamos el objectType y el objectId.
		$this->prepareAnswerObject();

		//verificacion si solo debe ser visible para un usuario registrado
		//no es publica y no quiere acceder un usuario afiliado.
		if ((!$this->survey->isPublic()) && (!Common::isRegistrationUser()))
			return $mapping->findForwardConfig('failure');

		//verificamos si la encuesta ha sido respondida
		if (isset($_GET['noResponse']) && $_GET['noResponse'] == 1) {
			//no se guardan respuestas pero el usuario no puede volver a contestar la encuesta
			$this->cookieSetup();
			return $mapping->findForwardConfig('success');
		}

		//validacion de captcha
		if (Common::getSurveysCaptchaUse()) {
			//validamos el captcha
			if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
				$smarty->assign('captcha',true);
				return $mapping->findForwardConfig('failure');
			}
		}

		$answersData = $_POST['answers'];
		$this->prepareAnswers($answersData);

		$this->saveAnswers();

		//se han guardado las respuestas
		//seteamos una cookie para evitar que el usuario pueda volver a responder la encuesta
		$this->cookieSetup();

		$smarty->assign('survey',$this->survey);

		return $mapping->findForwardConfig('success');

	}

	/**
	 * Prepara el objecto responsable de haber respondido la encuesta dentro de los parametros
	 * que van a ser utilizados para setear luego las encuestas.
	 */
	protected function prepareAnswerObject() {
		$this->answerParams['surveyAnswer']['objectId'] = $_POST['objectId'];
		$this->answerParams['surveyAnswer']['objectType'] = $_POST['objectType'];

		//Si no venian en los parámetros, los tomamos en base al usuario logueado.
		if (empty($this->answerParams['surveyAnswer']['objectId']) || empty($this->answerParams['surveyAnswer']['objectType'])) {
			//caso particular en el cual se guarda el usuario
			//que respondio la encuesta

			if (Common::isRegistrationUser()) {
				$user = Common::getRegistrationUserLogged();
				$type = 'RegistrationUser';
			} else if (Common::isSystemUser()) {
				$user = Common::getAdminLogged();
				$type = 'User';
			} else if (Common::isAffiliateUser()) {
				$user = Common::getAffiliatedLogged();
				$type = 'AffiliateUser';
			}

			if (!empty($user)) {
				$this->answerParams['surveyAnswer']['objectId'] = $user->getId();
				$this->answerParams['surveyAnswer']['objectType'] = $type;
			} else {
				return $mapping->findForwardConfig('failure');
			}
		}
	}

	protected function prepareAnswers($answersData) {
		foreach ($answersData as $answerData) {
			$question = SurveyQuestionPeer::get($answerData['questionId']);
			if (empty($question))
				return $mapping->findForwardConfig('failure');

			$answersIds = $answerData['answers'];

			//validacion de que sea encuesta de unica opcion y hayan varias seleccionadas
			if ((!$question->acceptsMultipleAnswers()) && count($answersIds) > 1) {
				return $mapping->findForwardConfig('failure');
			}

			foreach ($answersIds as $answerId) {
				$this->answerParams['surveyAnswer']['questionId'] = $question->getId();
				$this->answerParams['surveyAnswer']['answerOptionId'] = $answerId;


				$surveyAnswer = new SurveyAnswer;
				Common::setObjectFromParams($surveyAnswer, $this->answerParams['surveyAnswer']);

				//vamos a demorar la persistencia hasta estar seguros que no hay errores en ninguna
				//respuesta.
				$this->answersToSave[] = $surveyAnswer;
			}
		}
	}

	protected function saveAnswers() {
		//Vamos a intentar guardar las respuestas
		//Si se produce error en algún momento del proceso, hacemos rollback de todas.
		try {
			$con = Propel::getConnection(SurveyAnswerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
			$con->beginTransaction();
			foreach ($this->answersToSave as $answerToSave) {
				$answerToSave->save();
			}
			$con->commit();
		} catch (PropelException $exp) {
			$con->rollBack();
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return $mapping->findForwardConfig('failure');
		}
	}

	/**
	 * Crea el cookie correspondiente luego de
	 * la contestacion de la encuesta
	 */
	protected function cookieSetup() {
		//armamos la fecha de expiracion considerando la fecha de finalizacion de la encuesta
		$expiration = strtotime($this->survey->getEndDate());
		$cookieName = SurveyPeer::getCookieName($this->survey->getId(), $this->answerParams['surveyAnswer']['objectType'], $this->answerParams['surveyAnswer']['objectId']);
		setcookie($cookieName, $this->survey->getId(),$expiration);
	}
}