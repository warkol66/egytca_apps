<?php

require 'contentProvider/HeadlineFeedParser.php';

class HeadlinesXMLDoParseXAction extends BaseAction {
	
	protected $debug;
	
	private $typeMap = array(
		'tv' => array('class' => 'TVHeadline', 'url' => 'http://prensa/rss1.xml'),
		'radio' => array('class' => 'RadioHeadline', 'url' => 'http://prensa/rss2.xml'),
		'press' => array('class' => 'PressHeadline', 'url' => 'http://prensa/rss3.xml')
	);
	
	function HeadlinesXMLDoParseXAction() {
		$this->debug = false;
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
			foreach ($_POST['type'] as $type) {
			
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
			}
			
			$smarty->assign('headlinesParsed', $savedHeadlines);
		}
		
		$smarty->display('HeadlinesParsedListInclude.tpl');
	}
}
