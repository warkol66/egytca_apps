<?php

require 'contentProvider/HeadlineFeedParser.php';

class HeadlinesXMLParseAction extends BaseAction {
	
	function HeadlinesXMLParseAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$tvHeadlinesFeed = 'http://prensa/rss1.xml';
		$radioHeadlinesFeed = 'http://prensa/rss2.xml';
		$pressHeadlinesFeed = 'http://prensa/rss3.xml';
		
		$debug = true;
		
		$tvHeadlineParser = new HeadlineFeedParser('TVHeadline');
		$tvHeadlines = $tvHeadlineParser->debugMode($debug)->parse($tvHeadlinesFeed);
		
		$radioHeadlineParser = new HeadlineFeedParser('RadioHeadline');
		$radioHeadlines = $radioHeadlineParser->debugMode($debug)->parse($radioHeadlinesFeed);
		
		$pressHeadlineParser = new HeadlineFeedParser('PressHeadline');
		$pressHeadlines = $pressHeadlineParser->debugMode($debug)->parse($pressHeadlinesFeed);
		
		$saved = array();
		$notSaved = array();
		if ($_POST['save']) {
			foreach (array_merge($tvHeadlines, $radioHeadlines, $pressHeadlines) as $h) {
				try {
					$h->save();
					if ($debug) {
						$saved []= $h;
					}
				} catch (Exception $e) {
					if ($debug) {
						$notSaved []= $h;
					}
				}
			}
		}
		
		if ($debug) {
			?><hr/>
				<form action="Main.php?do=headlinesXMLParse" method="post">
					<input type="hidden" name="save" value="1" />
					<input type="submit" value="guardar parseados a DB" />
				</form>
			<?php
			echo '<hr/>';
				echo 'guardados: '.count($saved);
				echo '<br/>';
				echo 'no guardados (por repetidos supuestamente): '.count($notSaved);
			echo '<hr/>';
				echo 'class: '.get_class($tvHeadlines[0]);
				echo '<br/>';
				echo 'count: '.count($tvHeadlines);
				echo '<br/>';
				$tvHeadlineParser->printDebugInfo();
			echo '<hr/>';
				echo 'class: '.get_class($radioHeadlines[0]);
				echo '<br/>';
				echo 'count: '.count($radioHeadlines);
				echo '<br/>';
				$radioHeadlineParser->printDebugInfo();
			echo '<hr/>';
				echo 'class: '.get_class($pressHeadlines[0]);
				echo '<br/>';
				echo 'count: '.count($pressHeadlines);
				echo '<br/>';
				$pressHeadlineParser->printDebugInfo();
			echo '<hr/>';
		}
	}
}
