<?php

class ProfilesDoEditAction extends BaseAction {

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

		$actor = ActorPeer::retrieveByPK($request->getParameter("actor"));
		if (!$actor)
			print "Cannot find actor '".$request->getParameter("actor")."'";

		$actor->replaceAnswers($request->getParameterValues("answer"));
		$form = FormPeer::get($request->getParameter("form"));

		if (!empty($_POST["showAll"]))
			$actor->replaceActive($request->getParameterValues("applyableQuestions"),$form);

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$myRedirectPath = $myRedirectPath."&actor=".$actor->getId()."&form=".$request->getParameter("form");
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;
	}
}
