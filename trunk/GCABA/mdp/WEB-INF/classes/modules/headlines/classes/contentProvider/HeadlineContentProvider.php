<?php

$dir = dirname(__FILE__);

require_once 'phpQuery/phpQuery.php';
require_once $dir . '/AbstractParserStrategy.php';
require_once $dir . '/GoogleNewsStrategy.php';
require_once $dir . '/GoogleStrategy.php';
require_once $dir . '/TopsyStrategy.php';
require_once $dir . '/CompoundStrategy.php';
require_once $dir . '/TimestampParser.php';

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
 *   // Especificando parametros de consulta
 *   $resultados = HeadlineContentProvider::create('riquelme falcioni', $campaignId)
 *      ->setStrategy('googleNews')
 *      ->setParameters(array(
 *          'start' => 10, // pagina 2
 *          'dateFilter' => 'day' // ultimo dia
 *      ))
 *      ->find();
 * 
 *   // Utilizando varias fuentes
 *   $resultados = HeadlineContentProvider::create('riquelme falcioni', $campaignId)
 *      ->setStrategy(array('googleNews', 'google', 'twitter', 'bing'))
 *      // Los parametros deben estar separados segun su fuente
 *      ->setParameters(array(
 *          'googleNews' => array(
 *              'start' => 10, // pagina 2
 *              'dateFilter' => 'day' // ultimo dia
 *          ),
 *          'google' => array(
 *              // ...
 *          ),
 *          'twitter' => array(
 *              // ...
 *          )
 *      ))
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
    public function HeadlineContentProvider($keywords, $campaignId = null) {
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
    public static function create($keywords, $campaignId = null) {
        return new HeadlineContentProvider($keywords, $campaignId);
    }
    
    /**
     * Establece la estrategia segun su nombre.
     * El nombre esta definido en ConfigModule bajo: 
     *  "headlines" -> "contentProvider" -> "strategies"
     * 
     * @param mixed $name
     * @return HeadlineContentProvider 
     */
    public function setStrategy($name) {
        if (is_array($name)) {
            $strategies = array();
            foreach ($name as $strategyName) {
                if ($this->isValidStrategy($strategyName)) {
                    $strategies[$strategyName] = $this->buildStrategy($strategyName);
                }
//                else throw new Exception("Estategia $name inexistente");
                $this->strategy = $this->buildStrategy('compound');
                $this->strategy->setStrategies($strategies);
            }
        }
        else {
            if ($this->isValidStrategy($name)) {
                $this->strategy = $this->buildStrategy($name);
            }
//            else throw new Exception("Estategia $name inexistente");
        }
        
        return $this;
    }
    
    /**
     * @return AbstractParserStrategy
     */
    protected function getStrategy() {
        return $this->strategy;
    }

    private function isValidStrategy($name) {
        return array_key_exists($name, $this->config["strategies"]);
    }
    
    private function setDefaultStrategy() {
        $this->strategy = $this->buildStrategy('default');
    }
    
    private function buildStrategy($name) {
        $className = $this->config["strategies"][$name];
        return new $className($this->getSanitizedKeywords());
    }
    
    /**
     * Establece los parametros de la consulta.
     * 
     * @param array $params
     * @return HeadlineContentProvider 
     */
    public function setParameters(array $params = array()) {
        $this->strategy->addQueryParameters($params);
        return $this;
    }
    
    /**
     * Devuelve los parametros para la proxima consulta.
     * 
     * @return array
     */
    public function getParameters() {
        return $this->strategy->getNextQueryParameters();
    }
    
    /**
     * Verifica si hubo errores en el parseo.
     * 
     * @return boolean
     */
    public function hasErrors() {
        return $this->strategy->hasErrors();
    }
    
	/**
	 * Obtiene codigo y mensaje de los errores ocurridos en el parseo de una
	 * consulta.
	 * 
	 * @return array
	 */
	public function getErrors() {
		$errors = array();
		foreach ($this->strategy->getErrors() as $error) {
			$error['message'] = $this->config['errors'][$error['code']];
			if (!in_array($error, $errors))
				$errors[] = $error;
		}
		return $errors;
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
    public function find(&$ignored = null, &$total = null) {
        $news = $this->strategy->parse();
        return $this->buildHeadlinesParsed($news, $ignored, $total);
    }
    
    public function findALot($maxParsedResults) {
	    
	    $stopTrigger = 10/10;
	    $headlinesParsed = array();
	    $parsedCount = 0;
//	    $debug = true;
	    
	    while ($parsedCount < $maxParsedResults) {
		    
		    $loopResults = $this->find($ignored, $total);
		    
		    $headlinesParsed = array_merge($headlinesParsed, $loopResults);
		    $this->setParameters($this->getParameters());
		    
		    $parsedCount += $total;
		    
		    if ($debug) {
			    echo "iterarion parsed count: ".$total."<br />";
			    echo "iterarion ignored count: ".$ignored."<br />";
			    echo "iterarion created count: ".count($loopResults)."<br />";
			    echo "headlinesParsed count: ".count($headlinesParsed)."<br />";
			    echo "total parsed count: ".$parsedCount."<br />";
			    echo "<br />";
		    }
		    
		    $noResults = $total == 0;
		    $error = $this->getErrors();
		    $repeated = $ignored / $total > $stopTrigger;
		    if ($noResults || $error || $repeated) {
			    if ($debug) {
				    echo "loop stopped - reason:<br />";
				    if ($noResults)
					    echo "search brought no results<br />";
				    elseif ($error)
					    echo "error ocurred<br />";
				    else // if ($repeated)
					    echo "too many ignored results (repeated headlines)<br />";
				    echo "<br />";
			    }
			    break;
		    }
		    
		    if ($debug) {
			    if ( !(count($headlinesParsed) < $maxParsedResults) )
				    echo "limit exceeded - operation finished<br />";
		    }
	    }
	    
	    return $headlinesParsed;
	    
    }
    
    /**
     * Parsea noticias relacionadas a otro headline y devuelve un array de HeadlineParsed.
     * 
     * @return  array
     */
    public function findMore($id) {
	    $headline = HeadlineParsedQuery::create()->findOneById($id);
	    if (is_null($headline)) {
		    throw new Exception('invalid ID');
	    } else {
		    $url = $headline->getMoresourcesurl();
		    $news = $this->strategy->parse($url);
		    return $this->buildHeadlinesParsed($news);
	    }
    }
    
    /**
     * Crea los objetos HeadlineParsed a partir de los datos recopilados.
     * 
     * @param array $news
     * @return array
     */
    private function buildHeadlinesParsed($news, &$ignored = null, &$total = null) {
        $headlinesParsed = array();
	$ignored = 0;
	$total = 0;
        foreach ($news as $parsedNews) {
		$total++;
            $internalId = $this->buildInternalId($parsedNews);
            $parsedNews['mediaId'] = null;
//            $parsedNews['more_sources_url'] = null; ¿por qué estaba esta linea?
            $media = MediaQuery::create()->findOneByName($parsedNews['source']);
            if (!empty($media)) {
                $media = $media->resolveAliases();
                $parsedNews['mediaId'] = $media->getId();
            }
	    
	    if (HeadlineParsedQuery::create()->filterByInternalid($internalId)->count() > 0) {
		    $ignored++;
//		    echo "headline $internalId existente <br />";
//		    echo $e->getTraceAsString();
	    } else {
		try {
		    $h = $this->buildObject()
			->setClassKey(HeadlinePeer::CLASSKEY_WEBHEADLINE)
			->setInternalid($internalId)
			->setMediaid($parsedNews['mediaId'])
			->setMedianame($parsedNews['source'])
			->setName($parsedNews['title'])
			->setContent($parsedNews['snippet'])
			->setDatepublished($parsedNews['timestamp'])
			->setHeadlinedate($parsedNews['timestamp'])
			->setUrl($parsedNews['url'])
			->setMoresourcesurl($parsedNews['more_sources_url'])
			->setKeywords($this->getSanitizedKeywords())
			->setStrategy($parsedNews['strategy'])
		    ;
		    if (!is_null($this->campaignId))
			    $h->setCampaignid($this->campaignId);
		    $h->save();
		    $headlinesParsed[] = $h;
		}
		catch (PropelException $e) {
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
    
} // HeadlineContentProvider
