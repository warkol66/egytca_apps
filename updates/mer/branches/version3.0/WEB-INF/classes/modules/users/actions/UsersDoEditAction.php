<?php

require_once("BaseAction.php");
require_once("mer/UserPeer.php");

class UsersDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function UsersDoEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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

    $userPeer = new UserPeer();

		if ( $_POST["accion"] == "edicion" ) {
			//estoy editando un usuario existente

			if ( $_POST["pass"] == $_POST["pass2"] ) {

				if ( $userPeer->update($_POST["id"],$_POST["username"],$_POST["name"],$_POST["surname"],$_POST["pass"],$_POST["levelId"]) )
  	    	return $mapping->findForwardConfig('success');
				else {
					header("Location: Main.php?do=usersList&user=".$_POST["id"]."&message=errorUpdate");
					exit;
				}
			}
			else {
				header("Location: Main.php?do=usersList&user=".$_POST["id"]."&message=wrongPassword");
				exit;
			}

		}
		else {
		  //estoy creando un nuevo usuario
		  
			if ( !empty($_POST["pass"]) && $_POST["pass"] == $_POST["pass2"] ) {

				$userPeer->create($_POST["username"],$_POST["name"],$_POST["surname"],$_POST["pass"],$_POST["levelId"]);
				return $mapping->findForwardConfig('success');
			}
			else {
				header("Location: Main.php?do=usersList&user=&message=wrongPassword");
				exit;
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
