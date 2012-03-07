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
    
    private static $DATE_FILTER_MAP = array(
        'dateFilter' => 'tbs',
        'hour'       => 'qdr:h',
        'day'        => 'qdr:d',
        'week'       => 'qdr:w',
        'month'      => 'qdr:m',
        'year'       => 'qdr:y',
    );

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
    
    public function parse() {
        $pq = $this->getDocument();
        
        $news = array();
        foreach ($pq[$this->getSelector('items')] as $item) {
            list($source, $timestamp) = $this->parseSourceAndTimestamp(
                $pq->find($this->getSelector('item_source'), $item)->html()
            );
            $news[] = array(
                'url'       => $this->parseUrl($pq->find($this->getSelector('item_url'), $item)->attr('href')),
                'title'     => $this->fixEncoding($pq->find($this->getSelector('item_title'), $item)->html()),
                'source'    => $this->sanitizeHtml($source),
                'timestamp' => $this->parseTimestamp($timestamp),
                'snippet'   => $this->fixEncoding($pq->find($this->getSelector('item_snippet'), $item)->html()),
                'more_sources_url' => $this->parseMoreSourcesUrl(
                    $pq->find($this->getSelector('item_more_links'), $item)->attr('href')
                ),
                'strategy'  => 'googleNews'
            );
        }
        
        return $news;
    }
    
    protected function parseSourceAndTimestamp($html) {
        return preg_split("/-/", $this->fixEncoding($html));
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
