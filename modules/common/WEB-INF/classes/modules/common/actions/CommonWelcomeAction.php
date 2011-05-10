<?php
/** 
 * CommonWelcomeAction
 *
 * @package users 
 */

require_once("BaseAction.php");
require_once("TimezonePeer.php");
require_once("UserGroupPeer.php");
require_once("AffiliateUserGroupPeer.php");

class CommonWelcomeAction extends BaseAction {

	function CommonWelcomeAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateWelcome.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$projectsCountByColors = ProjectPeer::getProjectsByStatusColorCountAssoc();
		$smarty->assign('projectsCountByColors', $projectsCountByColors);		
		
		$projectsSpeed = ProjectPeer::getSpeed();
		$smarty->assign('projectsSpeed', $projectsSpeed);

		return $mapping->findForwardConfig('success');
	}

}
