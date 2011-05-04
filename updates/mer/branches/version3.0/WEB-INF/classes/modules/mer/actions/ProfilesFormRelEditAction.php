<?php

class profilesFormRelEditAction extends BaseAction {


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
		
		$module = "Relations";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if (!empty($_GET["form"])) {
			$forms[0] = FormPeer::get($_GET["form"]);
		}
		else {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,true);
			$forms = FormPeer::doSelect($formsC);
		}

		if (count($forms) == 1) {

			$crit = new Criteria();
			$crit->add(FormPeer::ID,$forms[0]->getId());
			$sections = FormPeer::getSectionsTree($crit);

			if ($request->getParameter("questionId")){
				try{
					$question = questionPeer::retrieveByPK($request->getParameter("questionId"));
				}catch (PropelException $e){
					echo "Error retrieving question id:".$request->getParameter("questionId");
				}
			}else{
				$question = new Question();
			}		
			$smarty->assign('question',$question);	
			$smarty->assign('positions',range(1,30));
			$smarty->assign("forms",$forms);
			$smarty->assign("form",$forms[0]);
			$smarty->assign("sections",$sections);
	
			return $mapping->findForwardConfig('success');
		}
		
		if (count($forms) == 0) {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);
		}
		
    $smarty->assign("forms",$forms);
    $smarty->assign("do","profilesFormRelEdit");

		return $mapping->findForwardConfig('select_form');
	}

}

?>
