<?php

/**
 * Class SurveyQuestionPeer
 *
 * @package Survey
 */
class SurveyQuestionPeer extends BaseSurveyQuestionPeer {
  
	/**
	* Crea una pregunta del tipo Yes / No
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	public function createYesNoQuestion($params, $question = null) {
		//no soporta opciones multiples
		$params['surveyQuestion']['multipleAnswer'] = 0;
	
		if ($question === null)
			$question = new SurveyQuestion;
		else 
			SurveyAnswerOptionQuery::create()->filterBySurveyQuestion($question)->delete();
			
		Common::setObjectFromParams($question, $params);
		if (!$question->save())
			return false;
		
		$question->reload();
		try {
			//opcion NO
			$answerOption = new SurveyAnswerOption();
			$answerOption->setQuestionId($question->getId());
			$answerOption->setAnswer('No');
			$answerOption->save();
		
			//opcion SI
			$answerOption = new SurveyAnswerOption();
			$answerOption->setQuestionId($question->getId());
			$answerOption->setAnswer('Si');
			$answerOption->save();

		} catch (PropelException $exp) {
			return false;
		}
	
		return $question;
	}

	/**
	* Elimina un survey question a partir de los valores de la clave.
	*
  	* @param int $id id del surveyquestion
	*	@return boolean true si se elimino correctamente el surveyquestion, false sino
	*/
	function delete($id) {
		return SurveyQuestionQuery::create()->filterByPrimaryKey($id)->delete() > 0;
	}

	/**
	* Obtiene la informacion de un survey question.
	*
	* @param int $id id del surveyquestion
	* @return array Informacion del surveyquestion
	*/
	function get($id) {
		return SurveyQuestionQuery::create()->findPk($id);
	}

	/**
	* Obtiene todos los survey questions.
	*
	*	@return array Informacion sobre todos los surveyquestions
	*/
	function getAll() {
		return SurveyQuestionQuery::create()->find();
	}
  
	/**
	* Obtiene todos los survey questions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los surveyquestions
	*/
	function getAllPaginated($page=1,$perPage=-1) {  
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		require_once("propel/util/PropelPager.php");
		$cond = new Criteria();     
		$pager = new PropelPager($cond,"SurveyQuestionPeer", "doSelect",$page,$perPage);
		return $pager;
	}    
}
?>
