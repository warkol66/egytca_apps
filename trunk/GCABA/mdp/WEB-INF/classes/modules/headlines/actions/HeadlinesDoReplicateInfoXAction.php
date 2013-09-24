<?php

class HeadlinesDoReplicateInfoXAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		header('Content-Type: text/json');
		
		if (empty($_POST['idFrom'])) {
			$smarty->assign('errors', array('emptyId' => 'idFrom cannot be empty'));
			return $mapping->findForwardConfig('success');
		}
		
		if (empty($_POST['idTo']))
			$idsTo = array();
		elseif (is_array($_POST['idTo']))
			$idsTo = $_POST['idTo'];
		else
			$idsTo = array($_POST['idTo']);
		
		$headlineFrom = HeadlineQuery::create()->findOneById($_POST['idFrom']);
		if (!$headlineFrom) {
			$smarty->assign('errors', array('invalidId' => 'no headline with id '.$_POST['idFrom']));
			return $mapping->findForwardConfig('success');
		}
		
		$headlinesTo = HeadlineQuery::create()->filterById($idsTo)->find();
		foreach ($headlinesTo as $headlineTo) {
			$headlineTo->copyFrom($headlineFrom);
			$headlineTo->save();
		}
		
		$smarty->assign('headlines', $headlinesTo);
		
		return $mapping->findForwardConfig('success');
	}
}