<?php
/** 
 * UsersLevelsDoEditAction
 *
 * @package users 
 * @subpackage levels 
 */

require_once("BaseAction.php");
require_once("LevelPeer.php");

class UsersLevelsDoDeleteAction extends BaseAction {

	function UsersLevelsDoDeleteAction() {
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

		$module = "Users";
		$section = "Levels";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);


	    if ( LevelPeer::delete($_GET["level"]) ) {
			Common::doLog('success','levelId: ' . $_GET["level"]);
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure','levelId: ' . $_GET["level"]);
			return $mapping->findForwardConfig('failure');
		}
	}

}
