<?php

require_once("BaseAction.php");
require_once("mer/ActorPeer.php");
require_once("mer/RelationshipPeer.php");
require_once("mer/FormPeer.php");
require_once("mer/GraphModelPeer.php");

class AnalysisGraphNetworkAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphNetworkAction() {
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
    
    $this->template->template = "template.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "Analysis";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

    $urlActors = "";

		$categoryId = $request->getParameter("categoryId");
		if (!empty($categoryId)) {
			$actors = ActorPeer::getByCategory($categoryId);
			$smarty->assign('categoryId',$categoryId);
			$urlActors .= "&categoryId=".$categoryId;
		}
		else {
			$actorsIds = $_GET["actors"];
			$actors = array();
			foreach ($actorsIds as $actor) {
				$actors[] = ActorPeer::get($actor);
				$urlActors .= "&actors[]=".$actor;
			}
		}
		$smarty->assign('urlActors',$urlActors);
		
		$smarty->assign('actors',$actors);

		if (!empty($_GET["form"])) {
			$forms[0] = FormPeer::get($_GET["form"]);
		}
		else {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,true);
			$forms = FormPeer::doSelect($formsC);
		}

		if (count($forms) == 0) {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,true);
			$forms = FormPeer::doSelect($formsC);
		}

    $smarty->assign("forms",$forms);
    $smarty->assign("do","analysisGraphNetwork");

		if (count($forms) == 1) {
			$form = $forms[0];
			$smarty->assign('form',$form);

			$questions = $form->getAllQuestions();
			$colors = GraphModelPeer::getColors();
			for ($i=0;$i<count($questions);$i++) {
				$index = fmod($i,count($colors));
				$questions[$i]->color = $colors[$index];
			}
			$smarty->assign("questions",$questions);

			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,true);
			$forms = FormPeer::doSelect($formsC);

			$smarty->assign('forms',$forms);

			return $mapping->findForwardConfig('success');
		}

/* 		$form = FormPeer::get($_GET["form"]);
		$questions = $form->getAllQuestions();
		$smarty->assign("questions",$questions);
    $smarty->assign("formId",$_GET["form"]); */


		return $mapping->findForwardConfig('success');
	}

}
?>
