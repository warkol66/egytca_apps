<?php

require 'contentProvider/HeadlineFeedParser.php';

class HeadlinesXMLDoParseXAction extends BaseAction {
	
	protected $debug;
	
	private $typeMap;
	
	function HeadlinesXMLDoParseXAction() {
		$this->debug = false;
		$this->typeMap = ConfigModule::get('headlines', 'typeMap');
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
				echo '<input type="hidden" name="type[]" value="press" />';
				echo '<input type="hidden" name="url" value="'.urlencode('http://prensa/rss3.xml').'" />';
				echo '<input type="submit" value="guardar PressHeadlines parseados a DB" />';
			echo '</form>';
		}
		/* ******************* end debug ****************** */
		
		if (!empty($_POST['type'])) {
			
			$savedHeadlines = array();
			$type = $_POST['type'];
			
			$headlinesFeed = $this->typeMap[$type]['url'];

			$headlineParser = new HeadlineFeedParser($this->typeMap[$type]['class']);
			$headlines = $headlineParser->debugMode($this->debug)->parse($headlinesFeed);

			if ($this->debug) {
				$notSavedHeadlines = array();
			}

			foreach ($headlines as $h) {
				try {
					$h->save();
					$savedHeadlines []= $h;
				} catch (Exception $e) {
					if ($this->debug) {
						$notSavedHeadlines []= $h;
					}
				}
			}

			/* ********************* debug ******************** */
			if ($this->debug) {
				echo '<hr/>';
					echo 'guardados: '.count($savedHeadlines);
					echo '<br/>';
					echo 'no guardados (por repetidos supuestamente): '.count($notSavedHeadlines);
				echo '<hr/>';
					echo 'class: '.get_class($headlines[0]);
					echo '<br/>';
					echo 'count: '.count($headlines);
					echo '<br/>';
					$headlineParser->printDebugInfo();
				echo '<hr/>';

				die;
			}
			/* ******************* end debug ****************** */
			
			$smarty->assign('headlinesParsed', $savedHeadlines);
		}
		
		$smarty->display('HeadlinesParsedListInclude.tpl');
	}
}
