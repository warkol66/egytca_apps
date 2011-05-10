<?php

/**
 * Skeleton subclass for representing a row from the 'surveys_answer' table.
 *
 * Respuesta seleccionada al realizar una encuesta por un usuario publico o registrado
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package Survey
 */
class SurveyAnswer extends BaseSurveyAnswer {

	public function getObject() {
		$id = $this->getObjectId();
		$className = $this->getObjectType();
		$queryClassName = $className . 'Query';
		if (class_exists($queryClassName)) {
			$query = new $queryClassName;
			return $query->findPk($id);
		}
		return NULL;
	}
} // SurveyAnswer
