<?php

require_once 'phpQuery/phpQuery.php';

/**
 * Clase Scrapper.
 */
class Scrapper {
    
    /**
     * Url usada para buscar noticias.
     * 
     * @var string
     */
    private $searchEngineUrl = 'http://news.google.com.ar/?';
    
    /**
     * Selectores utilizados en el scrapeo.
     * 
     * @var array
     */
    private static $SELECTORS = array(
        'items' => '#top-stories.blended-section .blended-wrapper',
        'item_url' => '.esc-lead-article-title-wrapper a.article',
        'item_title' => '.esc-lead-article-title-wrapper .titletext',
        'item_source' => '.esc-lead-article-source',
        'item_timestamp' => '.esc-lead-article-timestamp',
        'item_snippet' => '.esc-lead-snippet-wrapper'
    );
    
    /**
     * Palabras clave utilizadas en la busqueda.
     * 
     * @var mixed
     */
    private $keywords;
    
    /**
     * Campaign a la que se refiere la busqueda.
     * 
     * @var int
     */
    private $campaignId;

    /**
     *
     * @param mixed $keywords 
     */
    public function Scrapper($keywords, $campaignId) {
        $this->keywords = $keywords;
        $this->campaignId = $campaignId;
    }
    
    public static function create($keywords, $campaignId) {
        return new Scrapper($keywords, $campaignId);
    }
    
    private function getSanitizedKeywords() {
        $kw = is_array($this->keywords) ? implode(' ', $this->keywords) : $this->keywords;
        return urlencode($kw);
    }
    
    private function sanitizeHtml($html) {
        $sanitized = strip_tags($html);
        $sanitized = trim($sanitized);
        return $sanitized;
    }
    
    /**
     * Parsea noticias y devuelve un array de HeadlineParsed.
     * 
     * @return  array
     */
    public function find() {
        $news = $this->getGoogleNews();
        return $this->buildHeadlinesParsed($news);
    }
    
    private function buildQueryParams() {
        $params = array(
            'q' => $this->getSanitizedKeywords()
        );
        
        return http_build_query($params);
    }
    
    private function getGoogleNews() {
        
        $q  = $this->buildQueryParams();
        $pq = phpQuery::newDocumentFile($this->searchEngineUrl . $q);

        $news = array();
        foreach ($pq[self::$SELECTORS['items']] as $item) {
            $timestamp = $this->sanitizeHtml($pq->find(self::$SELECTORS['item_timestamp'], $item)->html());
            $news[] = array(
                'url'       => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_url'], $item)->attr('href')),
                'title'     => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_title'], $item)->html()),
                'source'    => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_source'], $item)->html()),
                'timestamp' => $this->parseTimestamp($timestamp),
                'snippet'   => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_snippet'], $item)->html())
            );
        }
        
        return $news;
    }
    
    /**
     * Crea los objetos HeadlineParsed a partir de los datos recopilados.
     * 
     * @param array $news
     * @return array
     */
    private function buildHeadlinesParsed($news) {
        $campaign = CampaignQuery::create()->findPk($this->campaignId);
        $headlinesParsed = array();
        foreach ($news as $parsedNews) {
            $internalId = $this->buildInternalId($parsedNews);
            try {
                $h = $this->buildObject()
                    ->setInternalid($internalId)
                    ->setCampaignid($this->campaignId)
                    ->setName($parsedNews['title'])
                    ->setContent($parsedNews['snippet'])
                    ->setDatepublished($parsedNews['timestamp'])
                    ->setHeadlinedate($parsedNews['timestamp'])
                    ->setUrl($parsedNews['url'])
                    ->setKeywords($this->getSanitizedKeywords())
                ;
                $h->save();
                $headlinesParsed[] = $h;
            }
            catch (PropelException $e) {
//                echo "headline $internalId existente <br />";
//                echo $e->getTraceAsString();
            }
        }
        return $headlinesParsed;
    }
    
    /**
     * @return  HeadlineParsed 
     */
    private function buildObject() {
        return new HeadlineParsed();
    }
    
    private function buildInternalId($parsedNews) {
        $hash = md5($this->campaignId . $parsedNews['title']);
        return $hash;
    }
    
    private function parseTimestamp($timestamp) {
        $timestampSplitted = preg_split('/', $timestamp);
        if (count($timestampSplitted) == 3) {
            return $timestamp;
        }
        else {
            return "";
        }
        
//        TODO: Opcion deseable pero el is_int no anda =/
//        $hours = preg_replace("/hace ([0-9]+) hora[s]?/", "$1", $timestamp);
//        if (is_int($hours)) {
//            echo "ts es int ". $hours ."<br />";
//        }
            
    }

} // Scrapper
