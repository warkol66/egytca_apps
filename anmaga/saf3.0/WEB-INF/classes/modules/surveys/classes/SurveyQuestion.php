<?php

/**
 * Skeleton subclass for representing a row from the 'surveys_question' table.
 *
 * Pregunta a Encuesta
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package Survey
 */
class SurveyQuestion extends BaseSurveyQuestion {
	
	public function __toString() {
		return $this->getQuestion();
	}
		
	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}	
	
	/**
	 * Crea una nueva opcion de respuesta dentro de una pregunta
	 * @param string texto de la opcion de respuesta
	 * @return SurveyAnswerOption instance or false on failure 
	 */
	public function addAnswerOption($answerText) {
		try {		
			$option = new SurveyAnswerOption();
			$option->setSurveyQuestion($this);
			$option->setAnswer($answerText);
			$option->save();
			return $option;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	 * Indica si una pregunta soporta multiples respuestas
	 * @return boolean
	 */
	public function acceptsMultipleAnswers() {
		return ($this->getMultipleAnswer() == 1);
	}
	
	/**
	 * Devuelve el total de respuesta que se han acumulado para la pregunta
	 * sin diferenciar la opcion elegida.
	 * @return integer
	 */
	public function getTotalAnswerCount() {
		return $this->countSurveyAnswers();
	}

} // SurveyQuestion
