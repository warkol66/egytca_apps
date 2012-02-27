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
        
        require 'contentProvider/HeadlineContentProvider.php';
        $headlinesParsed = HeadlineContentProvider::create(
            $request->getParameter('q'), 
            $request->getParameter('campaignId')
        )->setStrategy('googleNews')
//         ->setParameters(array(
//             'dateFilter' => 'day' // ultimo dia
//         ))
         ->find();
        
        $smarty->assign('headlinesParsed', $headlinesParsed);

		return $mapping->findForwardConfig('success');
	}
    
    
}
