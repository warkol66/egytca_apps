<?php

/**
 * Class SurveyPeer
 *
 * @package Survey
 */
class SurveyPeer extends BaseSurveyPeer {
	
	/**
	* Elimina un survey a partir de los valores de la clave.
	*
	* @param int $id id del survey
	*	@return boolean true si se elimino correctamente el survey, false sino
	*/
	function delete($id) {
		return SurveyQuery::create()->filterByPrimaryKey($id)->delete() > 0;
	}

	/**
	* Obtiene la informacion de un survey.
	*
	* @param int $id id del survey
	* @return array Informacion del survey
	*/
	function get($id) {
		return SurveyQuery::create()->findPk($id);
	}

	/**
	* Obtiene todos los surveys.
	*
	*	@return array Informacion sobre todos los surveys
	*/
	function getAll() {
		return SurveyQuery::create()->find();
	}
	
	/**
	* Obtiene todos los surveys paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los surveys
	*/
	function getAllPaginated($page=1,$perPage=-1) {  
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();     
		$pager = new PropelPager($cond,"SurveyPeer", "doSelect",$page,$perPage);
		return $pager;
	 }    

	/**
	* Obtiene la última survey activa.
	*	@return obj última encuesta activa
	 */
	public function getLastActive() {
		return SurveyQuery::create()->lastActive();
	}
	
	public function generateSurveyForProducts($products) {
		$survey = new Survey;
		$surveyParams['startDate'] = new DateTime;
		$surveyParams['endDate'] = date_modify(new DateTime, '+2 weeks');
		$surveyParams['isPublic'] = 1;
		$surveyParams['name'] = 'Encuesta de Productos';
		Common::setObjectFromParams($survey, $surveyParams);
		$survey->save();
		
		foreach ($products as $product) {
			$questionPrice = new SurveyQuestion;
			$questionPrice->setQuestion('Precio de ' . $product);
			
			$questionQuality = new SurveyQuestion;
			$questionQuality->setQuestion('Calidad de ' . $product);
			
			$questionPackage = new SurveyQuestion;
			$questionPackage->setQuestion('Empaque de ' . $product);
			
			$questions = array($questionPrice, $questionQuality, $questionPackage);
			foreach ($questions as $question) {
				$question->setMultipleAnswer(0);
				$question->setSurvey($survey);
				$question->save();
				for ($i = 1; $i <= 5; $i++) {
					$answerOption = new SurveyAnswerOption;
					$answerOption->setAnswer($i);
					$answerOption->setSurveyQuestion($question);
					$answerOption->save();
				}
			}
		}
		return $survey;
	}

	public static function getCookieName($surveyId, $objectType = null, $objectId = null) {
		if (empty($objectType) || empty($objectId)) {
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
				$objectId = $user->getId();
				$objectType = $type;
			}
		}
		$cookieName = Common::getSiteShortName() . $surveyId .  $objectType . $objectId;
		return $cookieName;
	}
}
