<?php

/**
 * Class GoogleStrategy.
 */
class GoogleStrategy extends AbstractParserStrategy {

    public function initialize() {
        //http://www.google.com.ar/search?q=sabella&hl=es&gl=ar&start=10
        $this->setSearchEngineUrl('http://news.google.com');
        $this->setSelectors(array(
            'items' => '#top-stories .blended-wrapper',
            'item_url' => '.esc-lead-article-title-wrapper a.article',
            'item_title' => '.esc-lead-article-title-wrapper .titletext',
            'item_source' => '.esc-lead-article-source',
            'item_timestamp' => '.esc-lead-article-timestamp',
            'item_snippet' => '.esc-lead-snippet-wrapper',
            'item_more_links' => '.esc-extension-wrapper a.more-coverage-text'
        ));
    }
    
    public function parse($keywords) {
        $pq = phpQuery::newDocumentFile($this->buildQueryUrl());
        
        $news = array();
        foreach ($pq[$this->getSelector('items')] as $item) {
            $timestamp = $this->sanitizeHtml($pq->find($this->getSelector('item_timestamp'), $item)->html());
            $news[] = array(
                'url'       => $this->sanitizeHtml($pq->find($this->getSelector('item_url'), $item)->attr('href')),
                'title'     => $this->sanitizeHtml($pq->find($this->getSelector('item_title'), $item)->html()),
                'source'    => $this->sanitizeHtml($pq->find($this->getSelector('item_source'), $item)->html()),
                'timestamp' => $this->parseTimestamp($timestamp),
                'snippet'   => $this->sanitizeHtml($pq->find($this->getSelector('item_snippet'), $item)->html()),
                'more_sources_url' => $this->parseMoreSourcesUrl($pq->find($this->getSelector('item_more_links'), $item)->attr('href'))
            );
        }
        
        return $news;
    }
    
} // GoogleStrategy
