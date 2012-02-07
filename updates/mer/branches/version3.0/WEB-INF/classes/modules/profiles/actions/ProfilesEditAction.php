<?php

class ProfilesEditAction extends BaseAction {

	function ProfilesEditAction() {
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
		$actor = ActorPeer::retrieveByPK($request->getParameter("actor"));
		if (!$actor)
			print "Actor '".$request->getParameter("actor")."' not found!";

		$actorCriteria = new Criteria();
		$actorCriteria->add(ActorActiveQuestionPeer::ACTORID  , $actor->getId());
		if (!ActorActiveQuestionPeer::doCount($actorCriteria))
			$_REQUEST['showAll'] = true;

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

		$smarty->assign("actor",$actor);
		$smarty->assign("forms",$forms);
		$smarty->assign("form",FormQuery::create()->findPK($_GET["form"]));
		$smarty->assign("do","profilesEdit");

		if (count($forms) == 1) {

			$smarty->assign("form",$forms[0]);

			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,false);
			$forms = FormPeer::doSelect($formsC);

			$smarty->assign("forms",$forms);

			return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('select_form');
	}

}
