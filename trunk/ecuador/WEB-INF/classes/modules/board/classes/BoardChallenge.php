<?php



/**
 * Skeleton subclass for representing a row from the 'board_challenge' table.
 *
 * Challenges del Board
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.board.classes
 */
class BoardChallenge extends BaseBoardChallenge{
	
	/*Posibles estados de la consigna*/
	const NOT_PUBLISHED = 1;
	const PUBLISHED = 2;
	const ARCHIVED = 3;
	
	/**
	 * Devuelve los estados posibles de la consigna y sus codigos 
	 * para la generacion de selects
	 */
	public function getStatuses() {
		$status[BoardChallenge::NOT_PUBLISHED] = 'No Publicada';
		$status[BoardChallenge::PUBLISHED] = 'Publicada';
		$status[BoardChallenge::ARCHIVED] = 'Archivada';
		return $status;
	}
	
	/**
	* Crea un Preview de una consigna.
	* Devuelve una instancia de consigna el cual no ha salvado en la base de datos.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/  
	function createPreview($params) {

			$boardChallengeObj = new BoardChallenge();
			$boardChallengeObj = Common::setObjectFromParams($boardChallengeObj,$params);

		return $boardChallengeObj;
	}
	
	function selectBetweenDates($paramStart, $paramEnd){
		$between = BoardChallengeQuery::create()
			->condition('c0','BoardChallenge.StartDate >= ?', $paramStart)
			->condition('c1','BoardChallenge.StartDate <= ?', $paramEnd)
			->combine(array('c0','c1'), 'and', 'c01')
			->condition('c2','BoardChallenge.EndDate <= ?', $paramEnd)
			->condition('c3','BoardChallenge.EndDate >= ?', $paramStart)
			->combine(array('c2','c3'), 'and', 'c23')
			->condition('c4','BoardChallenge.StartDate <= ?', $paramStart)
			->condition('c5','BoardChallenge.EndDate >= ?', $paramEnd)
			->combine(array('c4','c5'), 'and', 'c45')
			->combine(array('c01','c23'), 'or', 'c02')
			->where(array('c02','c45'), 'or')
			->find();
			
		return $between;
	}
	
	/**
     * Code to be run before inserting to database
     * @param PropelPDO $con 
     * @return boolean 
     */
    public function preInsert(PropelPDO $con = null) {
    	$uniqueUrl = BoardChallenge::getUrlFromTitle($this->getTitle());
    	$this->setUrl($uniqueUrl);
        return true;
    }
    
    /**
	 * Devuelve una Url única que corresponde a la consigna a partir de su titulo.
	 * 
	 * La url es generada encadenando las palabras con '_' y agregando un sufijo numérico 
	 * si es necesario para mantener la unicidad. Los caracteres que forman parte del ASCII 
     * extendido son transliterados a ASCII. Cualquier caractér inválido es descartado.
	 * 
	 *
	 * @param $title título.
	 * @return url del blog.
	 */
	public static function getUrlFromTitle($title) {
		$url = preg_replace('/\s+/', '_', $title);               // \s: whitespace characters
		$url = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $url);  // esto es para pasar cosas como 'é' a 'e'
		$url = preg_replace('/\W/', '', $url);                   // \W: non-word characters
		$url = preg_replace('/(^_)|(_$)/', '', $url);                   // es posible que hayan quedado '_' al principio o al final.
		$url = preg_replace('/_+/', '_', $url);					 // cualquier cantidad de '_' consecutiva debe reducirse.
		$url = strtolower($url);
		$sufix = '';
		$counter = 1;
		BoardChallengeQuery::disableSoftDelete();      //necesario para que devuelva en la consulta las que estan eliminadas.
		do {
			$uniqueUrl = $url . $sufix; 
			$unicity = BoardChallengeQuery::create()->filterByUrl($uniqueUrl)->count();
			$sufix = '_' . $counter;
			$counter++;
		} while($unicity !== 0);
		BoardChallengeQuery::enableSoftDelete();
		
		return $uniqueUrl;
	}
	
	/**
	 * Incrementa la cantidad de vistas que tiene el articulo
	 * y lo persiste
	 */
	public function increaseViews() {
		
		try {
			$counter = $this->getViews();
			$counter++;
			$this->setViews($counter);
			parent::save();

		} catch (PropelException $e) {
			return false;
		}

		return true;
		
	}
	
	/**
	 * Obtiene la cantidad de articulos aprobados que pueden ser mostrados por interfaz
	 * del articulo
	 * @return integer
	 */ 
	public function getApprovedCommentsCount() {
		
		$approved = BoardCommentQuery::create()
			->filterByChallengeId($this->getId())
			->filterByStatus(BoardComment::APPROVED)
			->find();
			
		return count($approved);
		
	}
	
	public function getLogData(){
		return substr($this->getTitle(),0,50);
	}
	
	public function getCurrent(){
		$now = date("Y-m-d H:i:s");
		$current = BoardChallengeQuery::create()->filterByStartDate(array('max' => $now))->filterByEndDate(array('min' => $now))->findOne();
		if(is_object($current))
			return $current;
	}
	
	/**
	 * Da una representacion del objeto en XHTML
	 * @param boolean indica si se quiere tambien el cuerpo de la entrada
	 * @return     String
	 */	
	public function toXHTML($fullMode=false) {
		global $system;

		$siteUrl = $system["config"]["system"]["parameters"]["siteUrl"];

		$output  = '<div class="article"  style="width: 550px; color: #A90000; font-size: 1.1em; font-weight: normal; text-align: left; height: auto; border-bottom-width: 1px; border-bottom-color: #CCCCCC; border-bottom-style: solid; margin: 5px 5px 0px; padding: 0px;" align="left">';
		$output .= '<h3 style="color: #666666; font-size: 1.1em; font-weight: bold; text-transform: uppercase; margin: 0px; padding: 0pt;">';
		$output .= '<a href="' . $siteUrl . '/Main.php?do=boardView&id=' . $this->getId() . '" target="_blank" style="color: #A90000; text-decoration: none;">' . $this->getTitle() . '</a></h3>';
		if ($fullMode)
			$output .= '<p>'.$this->getBody().'</p>';
		$output .= '<div class="masInfo"><a href="' . $siteUrl . '/Main.php?do=boardView&id=' . $this->getId() . '" target="_blank" style="color: #003366; background-image: url(http://www.lideresparroquiales.org/images/ico_vermasinfo.png); background-position: left; background-repeat: no-repeat; font-size: 1.1em; font-weight: normal; text-decoration: none; padding: 0px 0px 0px 15px;">Ver desafío completo</a></h1>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
}
