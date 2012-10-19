<?php

/** 
 * The skeleton for this class was autogenerated by Propel on:
 *
 * [Tue Jul 18 18:52:56 2006]
 *
 *  You should add additional methods to this class to meet the
 *  application requirements.  This class will only be generated as
 *  long as it does not already exist in the output directory.
 *
 * @package mer 
 */
class AnswerPeer extends BaseAnswerPeer {

	function getAnswerByActorAndQuestion($actor,$question) {
		$cond = new Criteria();
		$cond->add(AnswerPeer::ACTORID, $actor);
		$cond->add(AnswerPeer::QUESTIONID, $question);
		$answers = AnswerPeer::doSelect($cond);
		return $answers[0];
	} 

}