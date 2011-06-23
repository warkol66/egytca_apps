<?php
/** 
 * UsersLevelsListAction
 *
 * @package users
 * @subpackage levels 
 */

class UsersLevelsListAction extends BaseAction {

	function UsersLevelsListAction() {
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

		$groupPeer = new GroupPeer();
		$levels = LevelPeer::getAll();
		$smarty->assign("levels",$levels);

    $smarty->assign("message",$_GET["message"]);

    if ( !empty($_GET["level"]) ) {
			//voy a editar un level

			try {
				$level = LevelPeer::get($_GET["level"]);
				$smarty->assign("currentLevel",$level);
	    	$smarty->assign("accion","edicion");
	  	}
			catch (PropelException $e) {
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
