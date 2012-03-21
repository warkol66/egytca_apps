<?php


/**
 * Skeleton subclass for performing query and update operations on the 'surveys_answer' table.
 *
 * Respuesta seleccionada al realizar una encuesta por un usuario publico o registrado
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.surveys.classes
 */
class SurveyAnswerQuery extends BaseSurveyAnswerQuery {

	public function filterBySurvey($survey, $comparison = null) {
		return $this
			->join('SurveyQuestion')
			->useQuery('SurveyQuestion')
				->filterBySurvey($survey, $comparison = null)
			->endUse();
	}
} // SurveyAnswerQuery
