<?php

/**
 * Class GoogleNewsStrategy.
 */
class GoogleNewsStrategy extends AbstractParserStrategy {

    public function initialize() {
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
        $pq;
        foreach ($pq[$this->getSelector('items')] as $item) {
        // TODO: implementar lo que hay en Scrapper#getGoogleNews
        }
    }
    
} // GoogleNewsStrategy
