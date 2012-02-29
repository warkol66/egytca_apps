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
            'item_title' => '.esc-lead-article-title-wrapper .titletext',
//            'item_source' => '.esc-lead-article-source',
//            'item_timestamp' => '.esc-lead-article-timestamp',
            'item_snippet' => '.s', // tiene otras partes no deseadas!!
//            'item_more_links' => '.esc-extension-wrapper a.more-coverage-text'
        ));
	$this->setQueryParameters(array(
            'hl' => 'es'
        ));
    }
    
    public function parse() {
        $pq = phpQuery::newDocumentFile($this->buildQueryUrl());
	
	$news = array();
	foreach ($pq[$this->getSelector('items')] as $item) {
		echo $this->sanitizeHtml($pq->find($this->getSelector('item_snippet'), $item)->html());
		echo "<br />";
	}
	
	print_r($pq->html());
	die("|-the end-|");
        
        
        foreach ($pq[$this->getSelector('items')] as $item) {
		if ($this->mustUse($item)) {
			
			$href = $this->sanitizeHtml($pq->find($this->getSelector('item_url'), $item)->attr('href'));
			$timestamp = $this->sanitizeHtml($pq->find($this->getSelector('item_timestamp'), $item)->html());
			$news[] = array(
			    'url' => $this->parseUrl($href),
			    'title' => $this->sanitizeHtml($pq->find($this->getSelector('item_title'), $item)->html()),
//			    'source' => $this->sanitizeHtml($pq->find($this->getSelector('item_source'), $item)->html()),
//			    'timestamp' => $this->parseTimestamp($timestamp),
			    'snippet' => $this->sanitizeHtml($pq->find($this->getSelector('item_snippet'), $item)->html()),
//			    'more_sources_url' => $this->parseMoreSourcesUrl($pq->find($this->getSelector('item_more_links'), $item)->attr('href'))
			);
		}
        }
        
        return $news;
    }
    
    private function parseUrl() {
	    return "unaUrl";
    }
    
} // GoogleStrategy
