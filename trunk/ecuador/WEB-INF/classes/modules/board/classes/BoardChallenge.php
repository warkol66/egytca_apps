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
		$status[BlogEntry::NOT_PUBLISHED] = 'No Publicada';
		$status[BlogEntry::PUBLISHED] = 'Publicada';
		$status[BlogEntry::ARCHIVED] = 'Archivada';
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
			$boardChallengeObj = Common::setObjectFromParams($boardChallenge,$params);

		return $boardChallenge;
	}
}
