<?php



require_once("BaseAction.php");
require_once("SecurityActionPeer.php");
require_once("AffiliateUserLevelPeer.php");


/**
* Implementation of <strong>Action</strong> that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class SecurityActionListAffiliateUserAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityActionListAffiliateUserAction() {
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
		// Call our business logic from here

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		//asigno modulo y seccion
		$modulo = "Security";
		$section = "";

		$smarty->assign("modulo",$modulo);
		$smarty->assign("section",$section);

		$dir = "WEB-INF/classes/modules/";
		$dh  = opendir($dir);
		while (false !== ($module = readdir($dh))) {
			if ($module[0]!='.') {	
				$i++;
				$moduleName[$i]=$module;
			}
		}

		if (!empty($_SESSION['loginUser']))
			$userLevel = 1;
		else
			$userLevel = $_SESSION['loginAffiliateUser']->getLevelId();

		if(isset($_GET["module"])) {
			if($_GET["module"]!='todos'){
				$actions = SecurityActionPeer::getAllByModuleAndBitLevelAffiliateUser($_GET["module"],$userLevel);
				$moduleView=$_POST["module"];
			}
			else {
				//obtengo todos los actions de la base de datos y los envio al smarty
				$actions = SecurityActionPeer::getAllByBitLevelAffiliateUser($userLevel);
				$moduleView=$_GET["module"];
			}
		}	else {
			//obtengo todos los actions de la base de datos y los envio al smarty
			$actions = SecurityActionPeer::getAllByBitLevelAffiliateUser($userLevel);
			$moduleView='todos';
		}

		//obtengo todos los niveles con bitlevel mayor al del usuario logueado
    $levels = AffiliateUserLevelPeer::getAllWithBitLevelGreaterThan($userLevel);

		//contiene un nivel a comparar, equivalente a 2¨30 -1
		$levelSave=1073741823;

		$smarty->assign("actions",$actions);
		$smarty->assign("levelsave",$levelSave);
		$smarty->assign("modulesName",$moduleName);
		$smarty->assign("moduleView",$moduleView);
		$smarty->assign("levels",$levels);
		$smarty->assign("userLevel",$userLevel);

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');



	}

}
?>
