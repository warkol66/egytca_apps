<?php

/**
 * Class AbstractParserStrategy.
 */
abstract class AbstractParserStrategy {

    /**
     * Url usada para buscar noticias.
     * 
     * @var string
     */
    private $searchEngineUrl;
    
    /**
     * Selectores utilizados en el scrapeo.
     * 
     * @var array
     */
    private $selectors;
    
    /**
     * Palabras clave de la busqueda.
     * 
     * @var string 
     */
    private $keywords;
    
    /**
     * Constructor.
     * 
     * @param string $keywords 
     */
    public function AbstractParserStrategy($keywords) {
        $this->keywords = $keywords;
        $this->initialize();
    }
    
    /**
     * @param array $s 
     */
    protected function setSelectors(array $s) {
        $this->selectors = $s;
    }
    
    /**
     * @param string $url 
     */
    protected function setSearchEngineUrl($url) {
        $this->searchEngineUrl = $url;
    }
    
    /**
     * @return array
     */
    protected function getSelectors() {
        return $this->selectors;
    }
    
    /**
     * Obtiene el valor de un selector especifico.
     * 
     * @param string $name
     * @return string
     */
    protected function getSelector($name) {
        return $this->selectors[$name];
    }
    
    /**
     * @return string 
     */
    protected function getKeywords() {
        return $this->keywords;
    }
    
    /**
     * Metodo para inicializar la configuracion de la estrategia.
     */
    abstract protected function initialize();

    /**
     * Realiza el scrapeo, devolviendo la informacion de titulares en arrays 
     * asociativos, con los siguientes campos:
     * 
     *  - url                 url del titular
     *  - title               titulo
     *  - source              fuente
     *  - timestamp           fecha del titular
     *  - snippet             resumen del titular
     *  - more_sources_url    url que lleva a mas fuentes para un mismo tema.
     * 
     * @param string $keywords
     * @return array
     */
    abstract public function parse($keywords);
    
    protected function sanitizeHtml($html) {
        return trim(strip_tags($html));
    }
    
    /**
     * Construye los parametros de url.
     * 
     * @return  string
     */
    protected function buildQueryParams() {
        $params = array(
            'q' => $this->keywords,
        );
        
        return '?'. http_build_query($params);
    }
    
    protected function parseTimestamp($timestamp) {
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
    
    protected function parseMoreSourcesUrl($url) {
        return !empty($url) ? $this->searchEngineUrl . preg_replace("/^\//", "", $url) : "";
    }

} // AbstractParserStrategy
