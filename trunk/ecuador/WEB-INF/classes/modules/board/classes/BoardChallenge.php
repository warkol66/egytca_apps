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
}
