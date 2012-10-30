<?php
/** 
 * UsersDoAddToGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class RequirementsDevelopmentsDoAddAttendantXAction extends BaseDoEditAction {

	public function __construct() {
		parent::__construct('Development');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		if(!empty($_POST["attendantId"]) && !empty($_POST["id"]) && !empty($_POST["entityType"])){
			
			$user = UserQuery::create()->findOneById($_POST["attendantId"]);
			
			if(!empty($user)){
				//$attendant = DevelopmentQuery::create()->addAttendant($_POST["attendantId"],$_POST["id"],$_POST["entityType"]);
				$attendant = new Attendant();
				$attendant->setAttendantid($_POST["attendantId"]);
				$attendant->setEntityid($_POST["id"]);
				$attendant->setEntitytype($_POST["entityType"]);
				$attendant->save();
				$this->smarty->assign("attendant", $attendant);
			}
		}
		
		
	}

	/*function RequirementsDevelopmentsDoAddAttendantXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//por ser una action ajax.		
		$this->template->template = "TemplateAjax.tpl";

		$module = "Requirements";
		
		
		//busco el user, para pasarselo a addAttendant
		$attendant = UserQuery::create()->findOneById($_POST["attendantId"]);
		//busco el development
		$development = DevelopmentQuery::create()->findOneById($_POST["entityId"]);
		
		$smarty->assign('attendant',$attendant);
		$smarty->assign('development',$development);


		if ( !empty($_POST["attendantId"]) && !empty($_POST["entityId"]) && !empty($_POST["entityType"]) ) {
			if ( $development->addAttendant($attendant, $_POST["entityId"], $_POST["entityType"]) ) {
				return $mapping->findForwardConfig('success');
			}
		}
		
		$smarty->assign('errorTagId','attendantsMsgField');
		//return $mapping->findForwardConfig('success');
		return $mapping->findForwardConfig('failure');

	}*/

}
