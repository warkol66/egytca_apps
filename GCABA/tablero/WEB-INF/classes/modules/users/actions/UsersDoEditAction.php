<?php
/**
 * UsersListAction
 *
 * @package users
 */

class UsersDoEditAction extends BaseAction {

	function UsersDoEditAction() {
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

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if ($_POST["accion"] == "edit" && !empty($_POST["id"])) {
			//estoy editando un usuario existente
			$params["id"] = $_POST["id"];

			if ($_POST["pass"] == $_POST["pass2"]) {

				$user = UserPeer::get($_POST["id"]);
				$user = Common::setObjectFromParams($user,$_POST["userParams"]);

				if(!empty($_POST["pass"])) {
					$user->setPasswordString($_POST["pass"]);
					$user->setPasswordUpdatedTime();
				}
				if ($user->save()) {
					$logSufix = ', ' . Common::getTranslation("action: edit","common");
					Common::doLog('success','username: ' . $_POST["userParams"]["username"] . $logSufix);
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
				}
				else
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}
			else {
				header("Location: Main.php?do=usersEdit&user=".$_POST["id"]."&message=wrongPassword");
				exit;
			}
		}
		else {
			//estoy creando un nuevo usuario

			if (!empty($_POST["pass"]) && $_POST["pass"] == $_POST["pass2"]) {

				$user = new User();

				$user = Common::setObjectFromParams($user,$_POST["userParams"]);

				$user->setPasswordString($_POST["pass"]);
				$user->setActiveUser();

				if (empty($_POST["userParams"]["levelId"]))
					$user->setLevelId('3');

				if(!$user->save()) {
					$smarty->assign("user",$user);
					$smarty->assign("message","error");
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
				}
				else {
					$params["id"] = $user->getId();
					$logSufix = ', ' . Common::getTranslation("action: create","common");
					Common::doLog('success-add',$_POST["userParams"]["username"]. $logSufix);
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-add');
				}
			}
		}
	}

}
