<?php

/**
 * Class GoogleNewsStrategy.
 * 
 * Parametros de tiempo:
 * 
 *  Ultima hora
 *    'dateFilter' => 'hour' 
 *  Ultimo dia
 *    'dateFilter' => 'day' 
 *  Ultima semana
 *    'dateFilter' => 'week' 
 *  Ultima mes
 *    'dateFilter' => 'month' 
 *  Ultimo año
 *    'dateFilter' => 'year' 
 * 
 */
class GoogleNewsStrategy extends AbstractParserStrategy {
    

    public function initialize() {
        //http://www.google.com.ar/search?hl=es&gl=ar&tbm=nws&q=sabella&tbs=qdr:w&start=0
        $this->setSearchEngineUrl('http://www.google.com.ar/search');
        $this->setSelectors(array(
            'items' => '#ires .g table',
            'item_url' => '.r a',
            'item_title' => '.r a',
            'item_source' => 'td .f:first',
            'item_timestamp' => 'td .f:first',
            'item_snippet' => 'td div',
            'item_more_links' => '.gl:last'
        ));
        $this->setQueryParameters(array(
            'hl' => 'es',
            'gl' => 'ar',
            'tbm' => 'nws',
            'btnmeta_news_search' => 1
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
		
		if (!is_null($url))
			return $this->parseMore($url);
		
		$pq = $this->getDocument();
		
		$news = array();
		$resultsErrorsExist = false;
		foreach ($pq[$this->getSelector('items')] as $item) {
			list($source, $timestamp) = $this->parseSourceAndTimestamp(
				$pq->find($this->getSelector('item_source'), $item)->html()
			);
		
			if ($debug) {
				echo "timestamp text for processing: $timestamp<br />";
				echo "<br />";
			}
			
			$url = $this->parseUrl($pq->find($this->getSelector('item_url'), $item)->attr('href'));
			$title = $this->fixEncoding($pq->find($this->getSelector('item_title'), $item)->html());
			$source = $this->sanitizeHtml($source);
			$timestamp = $this->parseTimestamp($timestamp);
			$snippet = $this->fixEncoding($pq->find($this->getSelector('item_snippet'), $item)->html());
			$moreSourcesUrl = $this->parseMoreSourcesUrl(
				$pq->find($this->getSelector('item_more_links'), $item)->attr('href')
			);
		
			if ($debug) {
				echo "url: $url<br />";
				echo "title: $title<br />";
				echo "source: $source<br />";
				echo "timestamp: $timestamp<br />";
				echo "snippet: $snippet<br />";
				echo "moreSourcesUrl: $moreSourcesUrl<br />";
				echo "<br />";
			}
			
			if ( !$resultsErrorsExist && ($url == '' || $title == ''
				|| $source == '' || $timestamp == '' || $snippet == '') ) {
				
				$this->addError('invalid_headline');
				$resultsErrorsExist = true;
			}
			
			$news[] = array(
				'url'       => $url,
				'title'     => $title,
				'source'    => $source,
				'timestamp' => $timestamp,
				'snippet'   => $snippet,
				'more_sources_url' => $moreSourcesUrl,
				'strategy'  => 'googleNews'
			);
		}
		
		return $news;
	}
    
	public function parseMore($url) {
		
		$moreSelectors = array(
			'items' => '#mc-left .story',
			'item_title' => '.titletext',
			'item_url' => '.title a',
			'item_source' => '.sub-title .source',
			'item_timestamp' => '.sub-title .date',
			'item_snippet' => '.body .snippet'
		);
		
		
		$pq = $this->getDocument($url);
		
		$news = array();
		$resultsErrorsExist = false;
		foreach ($pq[$moreSelectors['items']] as $item) {
			
			$title = $this->fixEncoding($pq->find($moreSelectors['item_title'], $item)->html());
			$url = $pq->find($moreSelectors['item_url'], $item)->attr('href');
			$source = $this->fixEncoding($pq->find($moreSelectors['item_source'], $item)->html());
			$timestamp = $this->parseTimestamp($this->fixEncoding(
				$pq->find($moreSelectors['item_timestamp'], $item)->html())
			);
			$snippet = $this->fixEncoding($pq->find($moreSelectors['item_snippet'], $item)->html());
			
			if ( !$resultsErrorsExist && ($url == '' || $title == ''
				|| $source == '' || $timestamp == '' || $snippet == '') ) {
				
				$this->addError('invalid_headline');
				$resultsErrorsExist = true;
			}
			
			$news[] = array(
				'url'       => $url,
				'title'     => $title,
				'source'    => $source,
				'timestamp' => $timestamp,
				'snippet'   => $snippet,
				'strategy'  => 'googleNews'
			);
		}
		
		return $news;
	}
    
    protected function parseSourceAndTimestamp($html) {
	    preg_match(/* /(?<source>¿que poner?) */ "/\s-\s(?<timestamp>[^-]*$)/", $this->fixEncoding($html), $matches);
	    
	    // idealmente esto debería conseguirse arriba con la regexp adecuada
	    $source = preg_replace("/\s-[^-]*$/", '', $this->fixEncoding($html));
//	    $ts = preg_replace("/$source\s-\s([^-]*)$/", '$1', $this->fixEncoding($html)); por algun motivo esto dejo de andar en algunas fechas
	    
	    return array($source, $matches['timestamp']);
    }
    
    protected function parseMoreSourcesUrl($url) {
        return $url;
    }
    
    protected function buildQueryParams() {
        $this->translateDateFilter();
        return parent::buildQueryParams();
    }
    
    protected function parseUrl($url) {
	    $urlAndMore = urldecode(preg_replace("/^\/url\?q=/", "", $url));
	    $urlAndMore_chunks = preg_split("/&/", $urlAndMore);
	    return $urlAndMore_chunks[0];
    }
    
    private function translateDateFilter() {
        $params = $this->getQueryParameters();
        if (array_key_exists("dateFilter", $params)) {
            $dateFilter = $params["dateFilter"];
            $params[self::$DATE_FILTER_MAP["dateFilter"]] = self::$DATE_FILTER_MAP[$dateFilter];
            unset($params["dateFilter"]);
            $this->setQueryParameters($params);
        }
    }
    
} // GoogleNewsStrategy
