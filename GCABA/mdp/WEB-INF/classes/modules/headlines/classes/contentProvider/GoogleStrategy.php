<?php

/**
 * Class GoogleStrategy.
 */
class GoogleStrategy extends AbstractParserStrategy {

    public function initialize() {
        //http://www.google.com.ar/search?q=sabella&hl=es&gl=ar&start=10
        $this->setSearchEngineUrl('http://www.google.com.ar/search');
        $this->setSelectors(array(
            'items' => '#ires .g',
            'item_url' => '.r a',
            'item_title' => '.r a',
            'item_source' => '.s div cite',
            'item_body' => '.s'
        ));
        $this->setQueryParameters(array(
            'hl' => 'es'
        ));
    }
    
    public function addQueryParameters(array $params) {
	    require_once 'GoogleParamsManager.php';
	    $newParams = GoogleParamsManager::convertGlobal($params);
	    parent::addQueryParameters($newParams);
    }
    
    public function getNextQueryParameters() {
	    $params = parent::getQueryParameters();
	    $nextParams = parent::getNextQueryParameters();
	    
	    if (!$params['start'])
		    $params['start'] = 0;
	    $nextParams['start'] = $params['start'] + 10;
	    
	    return $nextParams;
    }

	public function parse($url = null) {
		
		$debug = false;
		
		$pq = $this->getDocument($url);
		
		$news = array();
		$resultsErrorsExist = false;
		foreach ($pq[$this->getSelector('items')] as $item) {
			
			if (!$this->mustUseItem($pq, $item))
				continue;
			
			// horrible - debería hacerse con el $pq de ser posible
			$chunks = preg_split("/<div>/", $pq->find($this->getSelector('item_body'), $item)->html());
			list($timestamp, $snippet) = $this->parseDateAndSnippet($this->fixEncoding($chunks[0]));
			
			$url = $this->parseUrl($pq->find($this->getSelector('item_url'), $item)->attr('href'));
			$title = $this->fixEncoding($pq->find($this->getSelector('item_title'), $item)->html());
			$source = $this->parseSource(
				$this->fixEncoding($pq->find($this->getSelector('item_source'), $item)->html())
			);
			
			if ( !$resultsErrorsExist && ($url == '' || $title == '' || $source == '' || $snippet == '') ) {
				$this->addError('invalid_headline');
				$resultsErrorsExist = true;
			}
			
			if ($debug) {
				echo "url: $url<br />";
				echo "title: $title<br />";
				echo "source: $source<br />";
				echo "timestamp: $timestamp<br />";
				echo "snippet: $snippet<br />";
				echo "<br />";
			}
			
			$news[] = array(
				'url' => $url,
				'title' => $title,
				'source' => $source,
				'timestamp' => $timestamp,
				'snippet' => $snippet,
				'strategy' => 'google'
			);
		}
		
		return $news;
	}
    
        protected function parseDateAndSnippet($html) {
		$chunks = preg_split("/\.\.\./", $html, 2);
		
		$timestamp = $this->parseTimestamp($chunks[0]);
		if (!is_null($timestamp))
			return array($timestamp, $chunks[1]);
		else
			return array(null, $html);
	}
	
	protected function parseSource($url) {
		$chunks = preg_split("/\//", $url);
		return $chunks[0];
	}
	
	protected function mustUseItem($pq, $item) {
		$extrasTable = $pq->find('.ts', $item)->html();
		if (!empty($extrasTable)) // is news or videos block
			return false;
		
		$itemBody = $pq->find('.s', $item)->html();
//		$brTag = $pq->find('<br>', $item); existance check?
		if (empty($itemBody) /* && exists $brTag */) // is images block
			return false;
		
		return true;
	}
	
	protected function parseUrl($url) {
		$urlAndMore = urldecode(preg_replace("/^\/url\?q=/", "", $url));
		$urlAndMore_chunks = preg_split("/&/", $urlAndMore);
		return $urlAndMore_chunks[0];
	}
} // GoogleStrategy
