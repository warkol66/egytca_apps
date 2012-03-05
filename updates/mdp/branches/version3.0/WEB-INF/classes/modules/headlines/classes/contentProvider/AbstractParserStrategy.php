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
     * Parametros para la consulta.
     * 
     * @var array
     */
    private $queryParams;
    
    /**
     * Constructor.
     * 
     * @param string $keywords 
     */
    public function __construct($keywords) {
        $this->keywords = $keywords;
        $this->selectors = array();
        $this->queryParams = array();
        $this->initialize();
    }
    
    /**
     * @param array $s 
     */
    protected function setSelectors(array $s) {
        $this->selectors = $s;
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
     * @param string $url 
     */
    protected function setSearchEngineUrl($url) {
        $this->searchEngineUrl = $url;
    }
    
    /**
     * @param array $params 
     */
    protected function setQueryParameters(array $params) {
        $this->queryParams = $params;
    }
    
    /**
     * @return array
     */
    protected function getQueryParameters() {
        return $this->queryParams;
    }
    
    /**
     * Agrega parametros a la consulta.
     * 
     * @param array $params 
     */
    public function addQueryParameters(array $params) {
        $this->setQueryParameters(array_merge($this->getQueryParameters(), $params));
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
     *  - strategy            estrategia que parseo el titular
     * 
     * @return array
     */
    abstract public function parse();
    
    protected function sanitizeHtml($html) {
        return trim(strip_tags($html));
    }
    
    /**
     * Construye los parametros de url.
     * 
     * @return  string
     */
    protected function buildQueryParams() {
        $params = array_merge(array('q' => $this->keywords), $this->getQueryParameters());
        
        return '?'. http_build_query($params);
    }
    
    /**
     * Construye la url para la consulta.
     * 
     * @return  string
     */
    protected function buildQueryUrl() {
        return $this->searchEngineUrl . $this->buildQueryParams();
    }
    
    protected function parseMoreSourcesUrl($url) {
        return !empty($url) ? $this->searchEngineUrl . preg_replace("/^\//", "", $url) : "";
    }
    
    protected function fixEncoding($html) {
        return utf8_encode($this->sanitizeHtml($html));
    }
    
    protected function parseTimestamp($timestamp) {
        $parser = new TimestampParser(trim($timestamp));
        return $parser->parse();
    }

} // AbstractParserStrategy
