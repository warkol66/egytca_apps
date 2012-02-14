<?php

require_once 'phpQuery/phpQuery.php';

/**
 * Clase Scrapper.
 */
class Scrapper {
    
    /**
     * Url usada para buscar noticias.
     * Debe tener la barra '/' al final.
     * 
     * @var string
     */
    private $searchEngineUrl = 'http://news.google.com/';
    
    /**
     * Selectores utilizados en el scrapeo.
     * 
     * @var array
     */
    private static $SELECTORS = array(
        'items' => '#top-stories .blended-wrapper',
        'item_url' => '.esc-lead-article-title-wrapper a.article',
        'item_title' => '.esc-lead-article-title-wrapper .titletext',
        'item_source' => '.esc-lead-article-source',
        'item_timestamp' => '.esc-lead-article-timestamp',
        'item_snippet' => '.esc-lead-snippet-wrapper',
        'item_more_links' => '.esc-extension-wrapper a.more-coverage-text'
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
     * @param mixed $keywords 
     * @param int $campaignId
     */
    public function Scrapper($keywords, $campaignId) {
        $this->keywords = $keywords;
        $this->campaignId = $campaignId;
    }
    
    /**
     * Constructor estatico.
     * 
     * @param mixed $keywords
     * @param int $campaignId
     * @return Scrapper 
     */
    public static function create($keywords, $campaignId) {
        return new Scrapper($keywords, $campaignId);
    }
    
    private function getSanitizedKeywords() {
        $kw = is_array($this->keywords) ? implode(' ', $this->keywords) : $this->keywords;
        return $kw;
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
    
    /**
     * Construye los parametros de url.
     * 
     * @return  string
     */
    private function buildQueryParams() {
        $params = array(
            'q' => $this->getSanitizedKeywords(),
            'num' => '50'
        );
        
        return '?'. http_build_query($params);
    }
    
    private function getGoogleNews() {
        
        $q  = $this->buildQueryParams();
        $pq = phpQuery::newDocumentFile($this->searchEngineUrl . $q);
//        echo $pq->html();
        $news = array();
        foreach ($pq[self::$SELECTORS['items']] as $item) {
            $timestamp = $this->sanitizeHtml($pq->find(self::$SELECTORS['item_timestamp'], $item)->html());
            $news[] = array(
                'url'       => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_url'], $item)->attr('href')),
                'title'     => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_title'], $item)->html()),
                'source'    => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_source'], $item)->html()),
                'timestamp' => $this->parseTimestamp($timestamp),
                'snippet'   => $this->sanitizeHtml($pq->find(self::$SELECTORS['item_snippet'], $item)->html()),
                'more_sources_url' => $this->parseMoreSourcesUrl($pq->find(self::$SELECTORS['item_more_links'], $item)->attr('href'))
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
					$exist = HeadlineParsedQuery::create()->findOneByInternalid($internalId);
					if (!$exist) {
            $media = MediaQuery::create()->findOneByName($parsedNews['source']);
	    if (!empty($media)) {
		$media = $media->resolveAliases();
            	$parsedNews['mediaId'] = $media->getId();
	    }
							
            try {
                $h = $this->buildObject()
                    ->setInternalid($internalId)
                    ->setCampaignid($this->campaignId)
                    ->setMediaid($parsedNews['mediaId'])
                    ->setMedianame($parsedNews['source'])
                    ->setName($parsedNews['title'])
                    ->setContent($parsedNews['snippet'])
                    ->setDatepublished($parsedNews['timestamp'])
                    ->setHeadlinedate($parsedNews['timestamp'])
                    ->setUrl($parsedNews['url'])
                    ->setMoresourcesurl($parsedNews['more_sources_url'])
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
        $hash = md5($this->campaignId . $parsedNews['url']);
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
    
    private function parseMoreSourcesUrl($url) {
        return !empty($url) ? $this->searchEngineUrl . preg_replace("/^\//", "", $url) : "";
    }

} // Scrapper
