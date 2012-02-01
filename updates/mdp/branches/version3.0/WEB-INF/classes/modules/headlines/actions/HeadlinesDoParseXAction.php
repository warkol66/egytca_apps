<?php

class HeadlinesDoParseXAction extends BaseAction {

	function HeadlinesDoParseXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
        
        require 'scrapper/Scrapper.php';
        $headlinesParsed = Scrapper::create(
            $request->getParameter('q'), 
            $request->getParameter('campaignId')
        )->find();
        $smarty->assign('headlinesParsed', $headlinesParsed);

		return $mapping->findForwardConfig('success');
	}
    
    
}
