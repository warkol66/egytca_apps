<?php

require_once 'phpQuery/phpQuery.php';

/**
 * Clase HeadlineContentProvider.
 * 
 * Ejemplos de uso:
 * 
 *   // Usa la estrategia por defecto
 *   $resultados = HeadlineContentProvider::create('sabella messi', $campaignId)
 *      ->find();
 * 
 *   // Especificando la estrategia
 *   $resultados = HeadlineContentProvider::create('riquelme falcioni', $campaignId)
 *      ->setStrategy('googleNews')
 *      ->find();
 * 
 */
class HeadlineContentProvider {
    
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
     * Estrategia de parseo utilizada.
     * 
     * @var AbstractParserStrategy
     */
    private $strategy;
    
    /**
     * Configuracion del proveedor.
     * 
     * @var array
     */
    private $config;

    /**
     * @param mixed $keywords 
     * @param int $campaignId
     */
    public function HeadlineContentProvider($keywords, $campaignId) {
        $this->keywords = $keywords;
        $this->campaignId = $campaignId;
        $this->config = ConfigModule::get("headlines", "contentProvider");
        $this->setDefaultStrategy();
    }
    
    /**
     * Constructor estatico.
     * 
     * @param mixed $keywords
     * @param int $campaignId
     * @return Scrapper 
     */
    public static function create($keywords, $campaignId) {
        return new HeadlineContentProvider($keywords, $campaignId);
    }
    
    /**
     * Establece la estrategia segun su nombre.
     * El nombre esta definido en ConfigModule bajo: 
     *  "headlines" -> "contentProvider" -> "strategies"
     * 
     * @param string $name
     * @return HeadlineContentProvider 
     */
    public function setStrategy($name) {
        if (array_key_exists($name, $this->config["strategies"])) {
            $this->strategy = $this->buildStrategy($name);
        }
        else throw new Exception("Estategia $name inexistente");
        
        return $this;
    }
    
    private function setDefaultStrategy() {
        $this->strategy = $this->buildStrategy('googleNews');
    }
    
    private function buildStrategy($name) {
        $className = $this->config["strategies"][$name];
        return new $className($this->getSanitizedKeywords());
    }
    
    private function getSanitizedKeywords() {
        $kw = is_array($this->keywords) ? implode(' ', $this->keywords) : $this->keywords;
        return $kw;
    }
    
    /**
     * Parsea noticias y devuelve un array de HeadlineParsed.
     * 
     * @return  array
     */
    public function find() {
        $news = $this->strategy->parse();
        return $this->buildHeadlinesParsed($news);
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
    
} // HeadlineContentProvider
