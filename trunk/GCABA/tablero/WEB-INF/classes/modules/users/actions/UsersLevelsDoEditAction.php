<?php
/** 
 * UsersLevelsDoEditAction
 *
 * @package users 
 * @subpackage levels 
 */

require_once("BaseAction.php");
require_once("LevelPeer.php");

class UsersLevelsDoEditAction extends BaseAction {

	function UsersLevelsDoEditAction() {
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

		if ( !empty($_POST["id"]) ) {
			//estoy editando un nivel de usuarios existente

			if ( LevelPeer::update($_POST["id"],$_POST["name"]) ) {
			Common::doLog('success','levelId: ' . $_GET["id"] . ' name: ' .$_POST["name"] . ' action: edit');
  	   		return $mapping->findForwardConfig('success');
			}
			else {
				header("Location: Main.php?do=usersLevelsList&level=".$_POST["id"]."&message=errorUpdate");
				exit;
			}
		}
		else {
		  //estoy creando un nuevo nivel de usuarios

			if ( !empty($_POST["name"]) ) {

				LevelPeer::create($_POST["name"]);
				Common::doLog('success','name: ' .$_POST["name"] . ' action: create');
				return $mapping->findForwardConfig('success');
			}
			else {
				Common::doLog('blankName','action: create');
				return $mapping->findForwardConfig('blankName');
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
