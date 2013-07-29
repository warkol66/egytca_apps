<?php



/**
 * Skeleton subclass for representing a row from the 'board_bond' table.
 *
 * Compromiso con el challenge
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.board.classes
 */
class BoardBond extends BaseBoardBond{
	
	/*Posibles tipos de la compromisos*/
	const INTERESTED = 1;
	const KNOWLEDGE = 2;
	const NEED_HELP = 3;
	const CAN_HELP = 4;
	const NOT_RELEVANT = 5;
	const DID_SOMETHING = 6;
	
	/**
	 * Devuelve los estados posibles de la noticias y sus codigos 
	 * para la generacion de selects
	 */
	public function getTypes() {
		$status[BoardBond::INTERESTED] = 'Estoy interesado';
		$status[BoardBond::KNOWLEDGE] = 'Tengo conocimiento sobre la consigna';
		$status[BoardBond::NEED_HELP] = 'Necesito Ayuda';
		$status[BoardBond::CAN_HELP] = 'Puedo ayudar';
		$status[BoardBond::NOT_RELEVANT] = 'No es relevante para mi parroquia';
		$status[BoardBond::DID_SOMETHING] = 'Hice algo a partir de la consigna';
		return $status;
	}
	
	public function getName(){
		$id = $this->getType();
		switch($id){
			case BoardBond::INTERESTED:
				$name = 'Estoy interesado';
				break;
			case BoardBond::KNOWLEDGE:
				$name = 'Tengo conocimiento sobre la consigna';
				break;
			case BoardBond::NEED_HELP:
				$name = 'Necesito Ayuda';
				break;
			case BoardBond::CAN_HELP:
				$name = 'Puedo ayudar';
				break;
			case BoardBond::NOT_RELEVANT:
				$name = 'No es relevante para mi parroquia';
				break;
			case BoardBond::DID_SOMETHING:
				$name = 'Hice algo a partir de la consigna';
				break;
		}
		return $name;
	}
}
