<?php

class profilesFormRelFillAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Mer";
		$section = "Relations";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$actor1 = ActorPeer::retrieveByPK($request->getParameter("actor"));
				
		$smarty->assign('actor1',$actor1);
		if ($request->getParameter("actor2"))
			$actor2 = ActorPeer::retrieveByPK($request->getParameter("actor2"));
		else{
			$actor2 = new Actor();
			$actors = array(''=>"Select an actor");
		}
		foreach (ActorPeer::getUserActors($_SESSION["login_user"]) as $actor){
			$actors[$actor->getId()] = $actor->getName();
		}
		unset($actors[$request->getParameter("actor")]);
		$smarty->assign("actors",$actors);		
		$smarty->assign('actor2',$actor2);

		$formsC = new Criteria();
		$formsC->add(FormPeer::RELATIONSHIP,true);				
		$smarty->assign('forms',FormPeer::doSelect($formsC));

		$actorCriteria = new Criteria();
		$actorCriteria->add(RelationshipActiveQuestionPeer::ACTOR1ID  , $actor1->getId());
		$actorCriteria->add(RelationshipActiveQuestionPeer::ACTOR2ID  , $actor2->getId());
		if (!RelationshipActiveQuestionPeer::doCount($actorCriteria)){
			$_REQUEST['showAll'] = true;
		}
		
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
    $smarty->assign("do",$request->getParameter("do"));		

		if (count($forms) == 1) {

			$smarty->assign('form',$forms[0]);

			$formsC = new Criteria();
			$formsC->add(FormPeer::RELATIONSHIP,true);
			$forms = FormPeer::doSelect($formsC);

			$smarty->assign('forms',$forms);

			$smarty->assign('actor',$actor);
	
			$report = $request->getParameter("report");
			if (!empty($report)) {
				$this->template->template = "template_report.tpl";
        return $mapping->findForwardConfig('report');
			}
			else
				return $mapping->findForwardConfig('success');
		}

		if ($actor2->getId())
			return $mapping->findForwardConfig('select_form');
		else
			return $mapping->findForwardConfig('success');
	}

}
