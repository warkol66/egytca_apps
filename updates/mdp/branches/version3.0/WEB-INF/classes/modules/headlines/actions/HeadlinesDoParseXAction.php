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
		
		$config = Common::getConfiguration('headlines');
		$maxParsedResults = $config['maxParsedResults'];
		$stopTrigger = 10/10;
		
		$headlinesParsed = array();
		$parsedCount = 0;
//		$debug = true;
		while ($parsedCount < $maxParsedResults) {
			
			$loopResults = $provider->find($ignored, $total);
			
			$headlinesParsed = array_merge($headlinesParsed, $loopResults);
			$provider->setParameters($provider->getParameters());
			
			$parsedCount += $total;
			
			if ($debug) {
				echo "iterarion parsed count: ".$total."<br />";
				echo "iterarion ignored count: ".$ignored."<br />";
				echo "iterarion created count: ".count($loopResults)."<br />";
				echo "headlinesParsed count: ".count($headlinesParsed)."<br />";
				echo "total parsed count: ".$parsedCount."<br />";
				echo "<br />";
			}
			
			if ($ignored / $total > $stopTrigger) {
				if ($debug) {
					echo "too many ignored results - trigger activated - stopping...<br />";
				}
				break;	
			}
			
			if ($debug) {
				if ( !(count($headlinesParsed) < $maxParsedResults) )
					echo "limit exceeded - operation finished<br />";
			}
		}
		
		$strategiesParams = $provider->getParameters();
        $parseErrors = $provider->getErrors();
		
		$smarty->assign('headlinesParsed', $headlinesParsed);
		$smarty->assign('strategiesParams', $strategiesParams);
        $smarty->assign('parseErrors', $parseErrors);
		
		return $mapping->findForwardConfig('success');
	}
    
    
}
