<?php
/** 
 * UsersDoAddToGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class RequirementsDevelopmentsDoAddAttendantXAction extends BaseAction {

	function RequirementsDevelopmentsDoAddAttendantXAction() {
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

	}

}