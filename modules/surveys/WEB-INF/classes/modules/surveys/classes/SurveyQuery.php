<?php


/**
 * Skeleton subclass for performing query and update operations on the 'surveys_survey' table.
 *
 * Encuestas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.surveys.classes
 */
class SurveyQuery extends BaseSurveyQuery {
	public function lastActive() {
		return $this->filterByIsPublic(1)
					->filterByStartDate(array('max'=>date('Y-m-d')))
					->orderByEndDate()
					->findOne();
	}
} // SurveyQuery
