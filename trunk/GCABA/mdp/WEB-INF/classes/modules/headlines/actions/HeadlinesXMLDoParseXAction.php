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
		
		/* ********************* debug ******************** */
		if ($this->debug) {
			echo '<hr/>';
			echo '<form action="Main.php?do=headlinesXMLDoParseX" method="post">';
				echo '<input type="hidden" name="type" value="press" />';
				echo '<input type="hidden" name="url" value="'.urlencode('http://prensa/rss3.xml').'" />';
				echo '<input type="submit" value="guardar PressHeadlines parseados a DB" />';
			echo '</form>';
		}
		/* ******************* end debug ****************** */
		
		if (!empty($_POST['type'])) {
			
			$savedHeadlines = array();
			$existentHeadlines = array();
			$invalidHeadlines = array();
			
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
			
			$headlinesFeed = $this->typeMap[$type]['url'];
			
			$logEntry = new HeadlineParseLogEntry();
			$logEntry->setHeadlinetype($type);
			$logEntry->setUser(Common::getLoggedUser());
			$logEntry->setUrl($headlinesFeed);
			$logEntry->setStatus('ongoing');
			$logEntry->save();

			$headlineParser = new HeadlineFeedParser($this->typeMap[$type]['class']);
			try {
				$headlines = $headlineParser->debugMode($this->debug)->parse($headlinesFeed);
				$logEntry->setStatus('success');
			} catch (Exception $e) {
				$logEntry->setStatus('failure');
				$logEntry->setErrormessage($e->getMessage());
			}

			foreach ($headlines as $h) {
				if (HeadlineParsedQuery::create()->filterByInternalid($h->getInternalId())->count() > 0) {
					$existentHeadlines []= $h;
				} else {
					try {
						$h->save();
						$savedHeadlines []= $h;
					} catch (Exception $e) {
						$invalidHeadlines []= $h;
					}
				}
			}
			
			$logEntry->setParsedcount(count($headlines));
			$logEntry->setCreatedcount(count($savedHeadlines));
			$logEntry->setExistentcount(count($existentHeadlines));
			$logEntry->setInvalidcount(count($invalidHeadlines));
			$logEntry->save();

			/* ********************* debug ******************** */
			if ($this->debug) {
				echo '<hr/>';
					echo 'guardados: '.count($savedHeadlines);
					echo '<br/>';
					echo 'existentes: '.count($existentHeadlines);
					echo '<br/>';
					echo 'invalidos: '.count($invalidHeadlines);
				echo '<hr/>';
					echo 'total: '.count($headlines);
					echo '<br/>';
					$headlineParser->printDebugInfo();
				echo '<hr/>';
					echo '<pre>';
					$toBePrinted = null;
					foreach($headlines as $h){
						$toBePrinted = $h;
						if ($h->getHeadlineParsedAttachments()->count() > 0)
							break;
					}
					print_r($toBePrinted);
					echo "</pre>";
				echo '<hr/>';

				die;
			}
			/* ******************* end debug ****************** */
			
			$smarty->assign('headlinesParsed', $savedHeadlines);
		}
		
		$smarty->display('HeadlinesParsedListInclude.tpl');
	}
}
