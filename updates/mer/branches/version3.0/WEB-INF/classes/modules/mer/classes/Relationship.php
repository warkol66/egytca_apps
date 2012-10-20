<?php

/**
 * Skeleton subclass for representing a row from the 'MER_relationship' table.
 *
 * 
 *
 * This class was autogenerated by Propel on:
 *
 * Tue Aug  1 15:33:35 2006
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package mer
 */	
class Relationship extends BaseRelationship {
	/**
	 * Replaces all the relationships between actor1 and actor2. The answer format is:
	 * array(questionId => array(current,potential));
	 *
	 * @param Actor $actor1
	 * @param Actor $actor2
	 * @param Array $answers
	 */
	function replaceAnswers($user,$actor1,$actor2,$answers){
		foreach ($answers as $questionId => $answer) {
			$relationship = RelationshipPeer::get($questionId,$actor1,$actor2);
			if (empty($relationship))
				$relationship = new Relationship();
			$relationship->setQuestionid($questionId);
			$relationship->setActor1id($actor1->getId());
			$relationship->setActor2id($actor2->getId());
			$relationship->setCurrent($answer[0]);
			$relationship->setPotential($answer[1]);
			$relationship->save();
		}
	}
	
	function replaceActive($actor1,$actor2,$applyableQuestions,$form) {
		$questions = $form->getAllQuestions();
		require_once("mer/RelationshipActiveQuestionPeer.php");
		foreach ($questions as $question) {
			if (in_array($question->getId(),$applyableQuestions)) {
				$relActQuestion = RelationshipActiveQuestionPeer::get($actor1,$actor2,$question);
				if (empty($relActQuestion))
					$relActQuestion = new RelationshipActiveQuestion();
				$relActQuestion->setActor1Id($actor1->getId());
				$relActQuestion->setActor2Id($actor2->getId());
				$relActQuestion->setQuestionId($question->getId());
				$relActQuestion->save();
			}
			else
        	RelationshipActiveQuestionPeer::delete($actor1,$actor2,$question);
		}
	}

} // Relationship