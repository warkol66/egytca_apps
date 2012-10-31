<?php
/** 
 * RequirementsDoAddAttendantXAction
 *
 * @package requirements 
 * @subpackage attendants
 */

class RequirementsDoAddAttendantXAction extends BaseDoEditAction {

	public function __construct() {
		parent::__construct('Requirement');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		if(!empty($_POST["attendantId"]) && !empty($_POST["id"]) && !empty($_POST["entityType"])){
			
			$user = UserQuery::create()->findOneById($_POST["attendantId"]);
			
			if(!empty($user)){
				$attendant = new Attendant();
				$attendant->setAttendantid($_POST["attendantId"]);
				$attendant->setEntityid($_POST["id"]);
				$attendant->setEntitytype($_POST["entityType"]);
				$attendant->save();
				$this->smarty->assign("attendant", $attendant);
			}
		}
		
	}
}
