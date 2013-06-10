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
		
		$this->smarty = $smarty;
		
		if (!empty($_POST['type'])) {
			
			$this->type = $_POST['type'];
			$makeFeedBackup = true;
			
			if (empty($_FILES['file'])) {
				
				$uri = null; // parser will figure it out based on the feed type

				if (!in_array($this->type, array_keys($this->typeMap))) {
					if ($this->type == "")
						$this->type = "(empty string)";
					
					if ($_ENV['PHPMVC_MODE_CLI'])
						die("$this->type is not a valid type\n");
					else
						return $this->returnAjaxFailure("$this->type is not a valid type");
				}

				if (!$this->timeIsOk()) {
					$errorMsg = 'El feed se parseo hace poco. Espere para volver a parsear';
					if ($_ENV['PHPMVC_MODE_CLI']) {
						die("$errorMsg\n");
					} else {
						// se parseo hace muy poco -> impedir
						$smarty->assign('parseErrors', array(
							array('strategy' => 'feed', 'message' => $errorMsg)
						));
						$smarty->display('HeadlinesParsedListInclude.tpl');
						return;
					}
				}
				
			} else {

				$displayHeadlinesFeedList = true; // hack para el uploader

				if ($_FILES['file']['error'] > 0) {
//					return $this->returnAjaxFailure ($_FILES['file']['error']);
					echo 'file upload error: '.$_FILES['file']['error'];
					return;
				}

				$uri = $_FILES['file']['tmp_name'];
			}
			
			$this->parse($this->type, $makeFeedBackup, $uri);
			
		} elseif (!empty($_POST['logentryid'])) {
			
			$makeFeedBackup = false;
			$logEntry = HeadlineParseLogEntryQuery::create()->findOneById($_POST['logentryid']);
			if (is_null($logEntry)) {
				if ($_ENV['PHPMVC_MODE_CLI'])
					die("invalid logentryid\n");
				else
					return $this->returnAjaxFailure('invalid logentryid');
			}
			
			$this->type = $logEntry->getHeadlinetype();
			
			$feedsPath = ConfigModule::get('headlines', 'feedBackupsPath');
			$extractedDir = $feedsPath.'/'.'temp-'.$logEntry->getId().'-'.uniqid();
			$uri = $extractedDir.'/'.$logEntry->getId().'.xml';
			
			$zippedFeed = $feedsPath.'/'.$logEntry->getId().'.zip';
			$zip = new ZipArchive() ;
			if ($zip->open($zippedFeed) !== true) {
				if ($_ENV['PHPMVC_MODE_CLI'])
					die("unable to open $zippedFeed\n");
				else
					return $this->returnAjaxFailure("unable to open $zippedFeed");
			}
			
			$zip->extractTo($extractedDir);
			$zip->close();
			
			if (!file_exists($uri)) {
				if ($_ENV['PHPMVC_MODE_CLI'])
					die("$uri not found\n");
				else
					return $this->returnAjaxFailure("$uri not found");
			}
			
			$this->parse($this->type, $makeFeedBackup, $uri);
			
			unlink($uri);
			rmdir($extractedDir);
			
		} else {
			if ($_ENV['PHPMVC_MODE_CLI'])
				die("invalid parameters\n");
			else
				return $this->returnAjaxFailure('invalid parameters');
		}
		
		if ($_ENV['PHPMVC_MODE_CLI']) {
			
			echo "saved headlines: ".count($this->parser->getSavedHeadlines())."\n";
			echo "existent headlines: ".$this->parser->getExistentHeadlinesCount()."\n";
			echo "invalid headlines: ".$this->parser->getInvalidHeadlinesCount()."\n";
			die;
			
		} else {

			// hack para el uploader
			if ($displayHeadlinesFeedList) {
				$smarty->assign('headlineParsedColl', $this->parser->getSavedHeadlines());
				$smarty->display('HeadlinesFeedList.tpl');
			} else {
				$smarty->assign('headlinesParsed', $this->parser->getSavedHeadlines());
				$smarty->display('HeadlinesParsedListInclude.tpl');
			}
			return;
		}
	}
	
	private function parse($type, $makeFeedBackup, $uri) {
		$this->parser = new HeadlineParsedParser($type, $makeFeedBackup);
		try {
			$this->parser->parse($uri);
		} catch (Exception $e) {
			$parseErrors = array(
				array('strategy' => 'feed', 'message' => $e->getMessage())
			);
			$this->smarty->assign('parseErrors', $parseErrors);
			require_once 'contentProvider/ErrorReporter.php';
			ErrorReporter::report($parseErrors);
		}
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
		} else {
			return true;
		}
	}
}
