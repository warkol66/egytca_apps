<?php

class ProfilesViewAction extends BaseAction {

	function ProfilesViewAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "Profiles";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$user = new User();
		$user->setId(1);
		$actor = ActorQuery::create()->findPK($request->getParameter("actor"));
		if (!$actor)
			$smarty->assign("notValidId",true);
			
		if (!empty($_GET["form"]))
			$forms[0] = FormPeer::get($_GET["form"]);
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

		$smarty->assign('actor',$actor);
		$smarty->assign("forms",$forms);
		$smarty->assign("do","profilesView");

		if (count($forms) == 1) {
			$smarty->assign('form',$forms[0]);

			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);

			$smarty->assign('forms',$forms);

			$report = $request->getParameter("report");
			if (!empty($report)) {
				$this->template->template = "TemplateReport.tpl";
				return $mapping->findForwardConfig('report');
			}
			else
				return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('select_form');


		return $mapping->findForwardConfig('success');
	}

}
