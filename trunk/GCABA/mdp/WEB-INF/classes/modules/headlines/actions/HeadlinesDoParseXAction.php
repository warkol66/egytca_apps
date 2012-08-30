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

		set_time_limit(ConfigModule::get("headlines","parserTimeLimit"));

		
		require 'contentProvider/HeadlineContentProvider.php';
//        devuelve solo la 1er estrategia y no el array =(
//        $request->getParameter('strategies')
//        print_r($request->getParameter('strategies')); die;
		$provider = HeadlineContentProvider::create(
			$request->getParameter('q'),
			$request->getParameter('campaignId')
		)->setStrategy($_REQUEST['strategies'])
		->setParameters($_REQUEST['strategiesParams']);
		
		foreach ($_REQUEST['strategies'] as $strategyName) {
			$provider->setParameters(array(
				$strategyName => array(
					'dateFilter' => $_REQUEST['dateFilter']
				)
			));
		}
		
		$config = Common::getConfiguration('headlines');
		$maxParsedResults = $config['maxParsedResults'];
		
		$headlinesParsed = $provider->findALot($maxParsedResults);
		
		$strategiesParams = $provider->getParameters();
		$parseErrors = $provider->getErrors();
		
		if (!empty($parseErrors)) {
			global $system;
			$debugMode = $system['config']['system']['parameters']['debugMode']['value'];
			if ($debugMode == 'YES') {
				require_once 'contentProvider/ErrorReporter.php';
				ErrorReporter::report($parseErrors);
			}
		}
		
		$smarty->assign('headlinesParsed', $headlinesParsed);
		$smarty->assign('strategiesParams', $strategiesParams);
		$smarty->assign('parseErrors', $parseErrors);
		
		return $mapping->findForwardConfig('success');
	}
    
    
}
