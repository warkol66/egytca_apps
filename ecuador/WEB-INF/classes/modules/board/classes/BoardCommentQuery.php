<?php



/**
 * Skeleton subclass for performing query and update operations on the 'board_comment' table.
 *
 * Comentarios a challenges
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.board.classes
 */
class BoardCommentQuery extends BaseBoardCommentQuery{
	
	function selectParents($parents){
		if($parents)
			$this->filterByParentId(NULL, Criteria::EQUAL);
		
		return $this;
	}
}