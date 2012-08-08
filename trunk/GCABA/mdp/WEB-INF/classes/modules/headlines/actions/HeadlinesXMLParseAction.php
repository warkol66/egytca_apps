<?php

require 'HeadlineFeedParser.php';

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
		
		if ($debug) {
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
