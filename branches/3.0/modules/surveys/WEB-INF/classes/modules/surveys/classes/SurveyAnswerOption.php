<?php

/**
 * Skeleton subclass for representing a row from the 'surveys_answerOption' table.
 *
 * Opciones de respuesta para una determinada Pregunta
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package Survey
 */
class SurveyAnswerOption extends BaseSurveyAnswerOption {

	/**
	 * Devuelve el total de respuesta que se han acumulado para la pregunta
	 * para la opcion especifica.
	 * @return integer
	 */
	public function getAnswerCount() {
		return $this->countSurveyAnswers();
	}
} // SurveyAnswerOption
