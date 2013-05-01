<?php



/**
 * Skeleton subclass for performing query and update operations on the 'board_challenge' table.
 *
 * Challenges del Board
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.board.classes
 */
class BoardChallengeQuery extends BaseBoardChallengeQuery{
	
	/*function selectBetweenDates($id = null, $paramStart, $paramEnd){
		/*$this->filterByStartDate(array('max' => $start));
		$this->filterByEndDate(array('min' => $end));*
		$this->condition('c0','BoardChallenge.StartDate >= ?', $paramStart)
			->condition('c1','BoardChallenge.StartDate <= ?', $paramEnd)
			->combine(array('c0','c1'), 'and', 'c01')
			->condition('c2','BoardChallenge.EndDate <= ?', $paramEnd)
			->condition('c3','BoardChallenge.EndDate >= ?', $paramStart)
			->combine(array('c2','c3'), 'and', 'c23')
			->condition('c4','BoardChallenge.StartDate <= ?', $paramStart)
			->condition('c5','BoardChallenge.EndDate >= ?', $paramEnd)
			->combine(array('c4','c5'), 'and', 'c45')
			->combine(array('c01','c23'), 'or', 'c02')
			->where(array('c02','c45'), 'or');
		if(isset($id))
			$this->filterBy($id, CRITERIA::NOT_EQUAL);
			
		return $this;
	}*/
}
