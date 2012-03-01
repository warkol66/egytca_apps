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
    
    public function parse() {
        $pq = phpQuery::newDocumentFile($this->buildQueryUrl());
	
	$news = array();
        foreach ($pq[$this->getSelector('items')] as $item) {
		
		$urlAndMore = $this->parseUrl($pq->find($this->getSelector('item_url'), $item)->attr('href'));
		$urlAndMore_chunks = preg_split("/&/", $urlAndMore);
		
		// horrible - debería hacerse con el $pq de ser posible
		$chunks = preg_split("/<div>/", $pq->find($this->getSelector('item_body'), $item)->html());
		list($timestamp, $snippet) = $this->parseDateAndSnippet($this->fixEncoding($chunks[0]));
		
		if ($this->mustUseItem($snippet)) {
			$news[] = array(
			    'url' => $urlAndMore_chunks[0],
			    'title' => $this->fixEncoding($pq->find($this->getSelector('item_title'), $item)->html()),
			    'source' => $this->parseSource($this->fixEncoding($pq->find($this->getSelector('item_source'), $item)->html())),
			    'timestamp' => $timestamp,
			    'snippet' => $snippet
			);
		}
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
	
	protected function mustUseItem($itemSnippet) {
		return !empty($itemSnippet);
	}
} // GoogleStrategy
