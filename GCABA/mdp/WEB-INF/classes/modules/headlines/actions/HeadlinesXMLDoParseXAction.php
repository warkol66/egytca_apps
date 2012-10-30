<?php

require 'contentProvider/HeadlineFeedParser.php';

class HeadlinesXMLDoParseXAction extends BaseAction {
	
	protected $debug;
	
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
			
			$savedHeadlines = array();
			$existentHeadlinesCount = 0;
			$invalidHeadlinesCount = 0;
			
			$type = $_POST['type'];
			
			if (!in_array($type, array_keys($this->typeMap))) {
				if ($type == "")
					$type = "(empty string)";
				return $this->returnAjaxFailure("$type is not a valid type");
			}
			
			$lastParsedEntry = HeadlineParseLogEntryQuery::create()
				->filterByHeadlinetype($type)
				->orderByCreatedAt(Criteria::DESC)
				->findOne();
			
			if (!is_null($lastParsedEntry)) {
				$lastParsedTime = strtotime($lastParsedEntry->getCreatedAt());
				$maxAllowedTimeString = $this->maxAllowedTimeStrings[$type];
				$maxAllowedTime = strtotime($maxAllowedTimeString);
				if ($lastParsedTime > $maxAllowedTime) {
					// se parseo hace muy poco -> impedir
					$smarty->assign('parseErrors', array(
						array('strategy' => 'feed', 'message' => 'El feed se parseo hace poco. Espere para volver a parsear')
					));
					$smarty->display('HeadlinesParsedListInclude.tpl');
					return;
				}
			}
			
			$this->feedsPath = ConfigModule::get("headlines", "feedBackupsPath");
			$this->feed = $this->feedsPath.'/temp-feed.xml';
			$headlinesFeed = $this->feed;
			file_put_contents($this->feed, file_get_contents($this->typeMap[$type]['url']));
			
			$logEntry = new HeadlineParseLogEntry();
			$logEntry->setHeadlinetype($type);
			$logEntry->setUser(Common::getLoggedUser());
			$logEntry->setUrl($headlinesFeed);
			$logEntry->setStatus('ongoing');
			$logEntry->save();

			$headlineParser = new HeadlineFeedParser($this->typeMap[$type]['class']);
			try {
				$this->zipData($logEntry->getId(), $headlinesFeed);
				$headlines = $headlineParser->debugMode($this->debug)->parse($headlinesFeed);
				$logEntry->setStatus('success');
			} catch (Exception $e) {
				$logEntry->setStatus('failure');
				$logEntry->setErrormessage($e->getMessage());
				$parseErrors = array(
					array('strategy' => 'feed', 'message' => $e->getMessage())
				);
				$smarty->assign('parseErrors', $parseErrors);
				require_once 'contentProvider/ErrorReporter.php';
				ErrorReporter::report($parseErrors);
			}

			foreach ($headlines as $h) {
				if (HeadlineParsedQuery::create()->filterByInternalid($h->getInternalId())->count() > 0) {
					$existentHeadlinesCount++;
				} else {
					try {
						$h->save();
						$savedHeadlines []= $h;
					} catch (Exception $e) {
						$invalidHeadlinesCount++;
					}
				}
			}
			
			$logEntry->setParsedcount(count($headlines));
			$logEntry->setCreatedcount(count($savedHeadlines));
			$logEntry->setExistentcount($existentHeadlinesCount);
			$logEntry->setInvalidcount($invalidHeadlinesCount);
			$logEntry->save();
			
			unlink($this->feed);
			
			$smarty->assign('headlinesParsed', $savedHeadlines);
		}
		
		$smarty->display('HeadlinesParsedListInclude.tpl');
	}
	
	private function zipData($logEntryId, $feed) {
		$destination = "$this->feedsPath/$logEntryId.zip";
		$zip = new ZipArchive();
		if ($zip->open($destination, ZIPARCHIVE::CREATE) !== true)
			throw new Exception("unable to open $destination");
		
		$zip->addFile($this->feed, "$logEntryId.xml");
		$zip->close();
		
		if (!file_exists($destination))
			throw new Exception("unable to create $destination");
	}
}
