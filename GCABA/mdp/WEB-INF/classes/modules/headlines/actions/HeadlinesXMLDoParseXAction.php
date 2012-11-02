<?php

require 'contentProvider/HeadlineFeedParser.php';

class HeadlinesXMLDoParseXAction extends BaseAction {
	
	protected $debug;
	
	private $type;
	private $typeMap;
	private $maxAllowedTimeStrings;
	
	function HeadlinesXMLDoParseXAction() {
		$this->debug = false;
		$this->typeMap = ConfigModule::get('headlines', 'typeMap');
		$this->maxAllowedTimeStrings = array(
			'web' => 'now -30 minutes',
			'multimedia' => 'now -30 minutes',
			'press' => 'now -30 minutes'
		);
	}

	function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_POST['type'])) {
			
			$this->type = $_POST['type'];
			
			if (!in_array($this->type, array_keys($this->typeMap))) {
				if ($this->type == "")
					$this->type = "(empty string)";
				return $this->returnAjaxFailure("$this->type is not a valid type");
			}
			
			if (!$this->timeIsOk()) {
				// se parseo hace muy poco -> impedir
				$smarty->assign('parseErrors', array(
					array('strategy' => 'feed', 'message' => 'El feed se parseo hace poco. Espere para volver a parsear')
				));
				$smarty->display('HeadlinesParsedListInclude.tpl');
				return;
			}
			
			$parser = new HeadlineParsedParser($this->type, true);
			try {
				$parser->parse();
			} catch (Exception $e) {
				$parseErrors = array(
					array('strategy' => 'feed', 'message' => $e->getMessage())
				);
				$smarty->assign('parseErrors', $parseErrors);
				require_once 'contentProvider/ErrorReporter.php';
				ErrorReporter::report($parseErrors);
			}
			
			$smarty->assign('headlinesParsed', $parser->getSavedHeadlines());
		}
		
		$smarty->display('HeadlinesParsedListInclude.tpl');
	}
	
	private function timeIsOk() {
		
		$lastParsedEntry = HeadlineParseLogEntryQuery::create()
			->filterByHeadlinetype($this->type)
			->orderByCreatedAt(Criteria::DESC)
			->findOne();

		if (!is_null($lastParsedEntry)) {
			$lastParsedTime = strtotime($lastParsedEntry->getCreatedAt());
			$maxAllowedTimeString = $this->maxAllowedTimeStrings[$this->type];
			$maxAllowedTime = strtotime($maxAllowedTimeString);
			return $lastParsedTime < $maxAllowedTime;
		}
	}
}
