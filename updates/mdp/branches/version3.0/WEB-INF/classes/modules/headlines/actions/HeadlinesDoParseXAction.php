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
//        devuelve solo la 1er estrategia y no el array =(
//        $request->getParameter('strategies')
//        print_r($request->getParameter('strategies')); die;
        $provider = HeadlineContentProvider::create(
            $request->getParameter('q'), 
            $request->getParameter('campaignId')
        )->setStrategy($_REQUEST['strategies'])
         ->setParameters($_REQUEST['strategiesParams']);
        
        $headlinesParsed = $provider->find();
        $strategiesParams = $provider->getParameters();
        
        $smarty->assign('headlinesParsed', $headlinesParsed);
        $smarty->assign('strategiesParams', $strategiesParams);

		return $mapping->findForwardConfig('success');
	}
    
    
}
