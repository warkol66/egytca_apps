<?php

class HeadlinesGenerateInternalIdsAction extends BaseAction {

	function HeadlinesGenerateInternalIdsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
        
        $updated = 0;
        foreach(HeadlineQuery::create()->find() as $headline) {
            $headline->buildInternalId();
            $headline->save();
        }
        $smarty->assign('updated', $updated);

		return $mapping->findForwardConfig('success');
	}
    
    
}
