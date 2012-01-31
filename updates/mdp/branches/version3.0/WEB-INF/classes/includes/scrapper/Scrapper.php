<?php

require_once 'phpQuery/phpQuery.php';

/**
 * Clase Scrapper.
 * 
 * @author nico
 */
class Scrapper {
    
    private $searchEngineUrl = 'http://news.google.com.ar/';
    
    public static $SELECTORS = array(
        'items' => '#top-stories.blended-section .blended-wrapper',
        'item_url' => '.esc-lead-article-title-wrapper a.article',
        'item_title_text' => '.esc-lead-article-title-wrapper .titletext',
        'item_source' => '.esc-lead-article-source',
        'item_timestamp' => '.esc-lead-article-timestamp',
        'item_snippet' => '.esc-lead-snippet-wrapper'
    );
    
    private $keywords;
    
    private $campaignId;

    /**
     *
     * @param mixed $keywords 
     */
    public function Scrapper($keywords, $campaignId) {
        $this->keywords = $keywords;
        $this->campaignId = $campaignId;
    }
    
    public static function create($keywords) {
        return new Scrapper($keywords);
    }
    
    private function getSanitizedKeywords() {
        $kw = is_array($this->keywords) ? implode(' ', $this->keywords) : $this->keywords;
        return urldecode($kw);
    }
    
    private function sanitizeHtml($html) {
        $sanitized = strip_tags($html);
        $sanitized = trim($sanitized);
        return $sanitized;
    }
    
    public function find() {
        $news = $this->getGoogleNews();
        return $this->buildHeadlinesParsed($news);
    }
    
    private function getGoogleNews() {
        
        $q  = $this->getSanitizedKeywords();
        $pq = phpQuery::newDocumentFile('http://news.google.com.ar/?q=' . $q);

        $news = array();
        foreach ($pq[self::$SELECTORS['items']] as $item) {
            $news[] = array(
                'url'       => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_url'], $item)->attr('href')),
                'title'     => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_title_text'], $item)->html()),
                'source'    => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_source'], $item)->html()),
                'timestamp' => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_timestamp'], $item)->html()),
                'snippet'   => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_snippet'], $item)->html())
            );
        }
        
        return $news;
    }
    
    /**
     * TODO hidratar y guardar el objeto
     * 
     * @param array $news
     * @return array
     */
    private function buildHeadlinesParsed($news) {
        $headlinesParsed = array();
        foreach ($news as $parsedNews) {
            $hl = new HeadlineParsed();
            $hl->setName($parsedNews['title']);
            $headlinesParsed[] = $hl;
        }
        return $headlinesParsed;
    }

} // Scrapper
