<?php

/**
 * Skeleton subclass for representing a row from the 'surveys_survey' table.
 *
 * Encuestas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package Survey
 */
class Survey extends BaseSurvey {

	public function __toString() {
		return $this->getName();
	}
		
	/**
	 * Indica si una encuesta es publica o no.
	 * @return boolean
	 */
	public function isPublic() {
		return ($this->getIsPublic() == 1);
	}
	
	/**
	 * Indica si a la fecha de hoy, la encuesta esta vencida o no, de su periodo
	 * @return boolean
	 */
	public function hasExpired() {
		$now = strtotime(date("Y-m-d h:m:s"));

		if (($now >= strtotime($this->getStartDate())) && ($now <= strtotime($this->getEndDate())))
			return false;
		return true;
	}

	/**
	 * Indica la cantidad de veces que se ha respondido la encuesta
	 * @return integer
	 */
	public function getTotalAnswers() {
		$questions = $this->getSurveyQuestions();
		$maxAnswers = 0;
		foreach ($questions as $question) {
			$options = $question->getSurveyAnswerOptions();
			$total = 0;
			foreach ($options as $option)
				$total += $option->getAnswerCount();
			if ($maxAnswers < $total)
				$maxAnswers = $total;
		}
		return $maxAnswers;
	}
	
	public function hasBeenAnsweredBy($object) {
		$objectType = get_class($object);
		$objectId = $object->getId();
		$cookieName = SurveyPeer::getCookieName($this->getId(), $objectType, $objectId);
		$cookie = $_COOKIE[$cookieName];
		$answersCount = SurveyAnswerQuery::create()
			->filterBySurvey($this)
			->filterByObjectType($objectType)
			->filterByObjectId($objectId)
			->count();
			
		return (!empty($cookie) && $cookie == $this->getId()) || $answersCount > 0;
	}

} // Survey
