<?php

require_once("BaseAction.php");
require_once("ThemePeer.php");

class LausiThemesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiThemesDoEditAction() {
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

		if (isset($_POST['actionType']) && $_POST['actionType'] == 'ajax') {
			//por recibir una llama ajax
			$this->template->template = "template_ajax.tpl";
		}

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Themes";
		$smarty->assign("section",$section);		


		if ( $_POST["action"] == "edit" ) {
			//estoy editando un theme existente
			ThemePeer::update($_POST["id"],$_POST["name"],$_POST["shortName"],Common::convertToMysqlDateFormat($_POST["startDate"]),$_POST["duration"],$_POST["type"],$_POST["clientId"],$_POST['sheetsTotal']);      		
			
			return $mapping->findForwardConfig('success');
		}
		else {
		  //estoy creando un nuevo theme
		  	$theme = ThemePeer::create($_POST["name"],$_POST["shortName"],Common::convertToMysqlDateFormat($_POST["startDate"]),$_POST["duration"],$_POST["type"],$_POST["clientId"],$_POST['sheetsTotal']);
			if ($theme == false) {
				$theme = new Theme();
				$theme->setid($_POST["id"]);
				$theme->setname($_POST["name"]);
				$theme->setshortName($_POST["shortName"]);
				$theme->setstartDate(Common::convertToMysqlDateFormat($_POST["startDate"]));
				$theme->setduration($_POST["duration"]);
				$theme->settype($_POST["type"]);
				$theme->setclientId($_POST["clientId"]);
				require_once("ClientPeer.php");		
				$smarty->assign("clientIdValues",ClientPeer::getAll());
				$smarty->assign("theme",$theme);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				
				if (isset($_POST['actionType']) && $_POST['actionType'] == 'ajax') {
					return $mapping->findForwardConfig('failure-ajax');
				}
				return $mapping->findForwardConfig('failure');
      		}
			
			$smarty->assign('theme',$theme);

			if (isset($_POST['actionType']) && $_POST['actionType'] == 'ajax') {
				return $mapping->findForwardConfig('success-ajax');
			}

			return $mapping->findForwardConfig('success');
			
		}

	}

}
