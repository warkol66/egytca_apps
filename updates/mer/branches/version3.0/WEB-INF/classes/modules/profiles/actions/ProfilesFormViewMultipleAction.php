<?php

class profilesFormViewMultipleAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //


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
		
		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);
    
    $url = "Main.php?do=profilesFormViewMultiple";
    
 		if (!empty($_GET["form"]))
 			$url .= "&form=".$_GET["form"];

		$categoryId = $request->getParameter("categoryId");
		if (!empty($categoryId)) {
			$actors = ActorPeer::getByCategory($categoryId);
			$smarty->assign('categoryId',$categoryId);
			$url .= "&categoryId=".$categoryId;
		}
		else {
			$actorsIds = $_GET["actors"];
			$actors = array();
			foreach ($actorsIds as $actor) {
				$actors[] = ActorPeer::get($actor);
				$url .= "&actors[]=".$actor;
			}
		}
		
		$smarty->assign('url',$url);
		$smarty->assign('urlReport',$url."&report=1");

		$smarty->assign('actors',$actors);
		
		if (!empty($_GET["form"])) {
			$forms[0] = FormPeer::get($_GET["form"]);
		}
		else {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);
		}
		
		if (count($forms) == 0) {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);
		}

    $smarty->assign("forms",$forms);
    $smarty->assign("do","profilesFormViewMultiple");

		if (count($forms) == 1) {
			$smarty->assign('form',$forms[0]);

			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);

			$smarty->assign('forms',$forms);

			$report = $request->getParameter("report");
			if (!empty($report)) {
				$this->template->template = "template_report.tpl";
        return $mapping->findForwardConfig('report');
			}
			else
				return $mapping->findForwardConfig('success');
		}


		return $mapping->findForwardConfig('success');
	}

}
?>
