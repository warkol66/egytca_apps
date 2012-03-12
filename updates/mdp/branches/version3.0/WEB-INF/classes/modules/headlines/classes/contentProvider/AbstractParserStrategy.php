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
     * Parametros a recibir en la proxima consulta.
     * 
     * @var array
     */
    private $nextQueryParams;
    
    /**
     * Contenedor de los errores surgidos en una consulta.
     * 
     * @var array
     */
    private $errors;
    
    /**
     * Constructor.
     * 
     * @param string $keywords 
     */
    public function __construct($keywords) {
        $this->keywords = $keywords;
        $this->selectors = array();
        $this->queryParams = array();
        $this->nextQueryParams = array();
        $this->errors = array();
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
     * Devuelve los parametros que se necesitan recibir en la proxima consulta.
     * 
     * @return array
     */
    public function getNextQueryParameters() {
        return $this->nextQueryParams;
    }
    
    /**
     * @return string 
     */
    protected function getKeywords() {
        return $this->keywords;
    }
    
    /**
     * @return boolean
     */
    public function hasErrors() {
        return !empty($this->errors);
    }
    
    protected function setErrors(array $e) {
        $this->errors = $e;
    }
    
    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
    
    protected function addError($code, $message = null) {
        $this->errors[] = array('code' => $code, 'message' => $message);
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
     * Devuelve el documento utilizado en el scrapeo.
     * 
     * @return phpQueryObject
     */
    protected function getDocument() {
        $document = phpQuery::newDocumentFileHTML($this->buildQueryUrl(), "utf-8");
        
        if ($this->isResponse503()) $this->addError('service_unavailable');
        
        $html = $document->find('html')->html();
        if (empty($html)) $this->addError('empty_response');
            
        return $document;
    }
    
    private function isResponse503() {
        foreach (phpQuery::$RESPONSE_HEADERS as $header) {
            if ($header == "HTTP/1.0 503 Service Unavailable") return true;
        }
        return false;
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
        return $this->convertSmartQuotes($this->sanitizeHtml($html));
    }
    
    private function convertSmartQuotes($string) 
    {
        $search = array(utf8_encode(chr(ord("„"))),
                        utf8_encode(chr(ord("`"))),
                        utf8_encode(chr(ord("´"))),
                        utf8_encode(chr(147)),  // 0093
                        utf8_encode(chr(148)),  // 0094
                        utf8_encode(chr(151))); // 0097

        $replace = array(",", 
                         "'", 
                         "'", 
                         "\"", 
                         "\"",
                         "-"); 

        return str_replace($search, $replace, $string); 
    } 
    
    protected function parseTimestamp($timestamp) {
        $parser = new TimestampParser(trim($timestamp));
        return $parser->parse();
    }

} // AbstractParserStrategy
