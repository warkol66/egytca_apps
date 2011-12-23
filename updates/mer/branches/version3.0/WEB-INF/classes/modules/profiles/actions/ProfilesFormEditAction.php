<?php

class ProfilesFormEditAction extends BaseAction {

	function ProfilesFormEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Profiles";
		$section = "Configure";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		if ($_GET["createForm"]) {
			$smarty->assign("createForm",true);
			return $mapping->findForwardConfig('success');
		}


		if (!empty($_GET["form"]))
			$forms[0] = FormPeer::get($_GET["form"]);
		else {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);
		}

		if (count($forms) == 1) {

			$crit = new Criteria();
			$crit->add(FormPeer::ID,$forms[0]->getId());
			$sections = FormPeer::getSectionsTree($crit);

			if ($request->getParameter("questionId")) {
				try {
					$question = QuestionPeer::retrieveByPK($request->getParameter("questionId"));
				}
				catch (PropelException $e) {
					echo "Error retrieving question id:".$request->getParameter("questionId");
				}
			}
			else
				$question = new Question();

			$smarty->assign("question",$question);
			$smarty->assign("positions",range(1,30));
			$smarty->assign("forms",$forms);
			$smarty->assign("form",$forms[0]);
			$smarty->assign("sections",$sections);

			$form = $forms[0];
			$questions = $form->getAllQuestions();
			$smarty->assign('questions',$questions);

			return $mapping->findForwardConfig('success');
		}

		if (count($forms) == 0) {
			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);
		}

		$smarty->assign("forms",$forms);
		$smarty->assign("do","profilesFormEdit");

		return $mapping->findForwardConfig('select_form');
	}

}
