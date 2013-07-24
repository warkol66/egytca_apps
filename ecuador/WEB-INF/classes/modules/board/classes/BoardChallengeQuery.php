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

	public function getCurrent(){
		$now = date("Y-m-d H:i:s");
		$current = BoardChallengeQuery::create()->filterByStartDate(array('max' => $now))->filterByEndDate(array('min' => $now))->findOne();
		if(is_object($current))
			return $current;
	}

}
