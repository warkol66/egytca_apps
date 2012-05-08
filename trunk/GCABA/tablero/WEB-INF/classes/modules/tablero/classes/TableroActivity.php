<?php


/**
 * Skeleton subclass for representing a row from the 'tablero_Activity' table.
 *
 * Activity
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroActivity extends BaseTableroActivity {

	/** the default item name for this class */
	const ITEM_NAME = 'Activity';

	/**
	 * Indica si un afiliado/dependencia es duenio de la instancia
	 * @param $affiliateId id de afiliado/dependencia
	 * @return true si lo es, false sino
	 */
	function isOwner($affiliateId) {
		$affiliate = $this->getProject()->getObjective()->getAffiliate();
		if ($affiliate->getId() == $affiliateId)
			return true;
		
		return false;
	}
	
	function statusColor() {
		global $system;	
		$colors = $system["config"]["tablero"]["colors"];
		if ($this->isOnTime())
			return $colors["onTime"];
		if ($this->isDelayed2())
			return $colors["delayed"];			
		if ($this->isLate())
			return $colors["late"];			
	}	
	
	function isOnTime() {
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"]; 
			$delayedTime = time() + ($days * 24 * 60 * 60);
			$delayedDate = date('Y-m-d', $delayedTime);
		}
		//Agregar los otros tipos
		if ( ($this->getExpirationDate() < $delayedDate." 00:00:00" && !$this->getCompleted()) || $this->getCompleted() )
			return true;
		return false;
	}

	function isDelayed2() {
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"]; 
			$delayedTime = time() + ($days * 24 * 60 * 60);
			$delayedDate = date('Y-m-d', $delayedTime);
			$days = $system["config"]["tablero"]["activities"]["late"]; 
			$lateTime = time() + ($days * 24 * 60 * 60);
			$lateDate = date('Y-m-d', $lateTime);			
		}
		//Agregar los otros tipos
		if ( $this->getExpirationDate() < $lateDate." 00:00:00" && $this->getExpirationDate() >= $delayedDate." 00:00:00" && !$this->getCompleted() )
			return true;
		return false;		
	}	

	function isLate() {
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["late"];
			$lateTime = time() + ($days * 24 * 60 * 60);
			$lateDate = date('Y-m-d', $lateTime);			
		}
		//Agregar los otros tipos
		if ( $this->getExpirationDate() >= $lateDate." 00:00:00" && !$this->getCompleted() )
			return true;
		return false;			
	}

	/**
	 * Da formato de YYYY-MM-DD a un datetime
	 *
	 *	@return string	 
	 */	
	private function formatDate($date) {
		
		preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $date, $regs);
		return "$regs[1]-$regs[2]-$regs[3]";
		
	}
	
	/**
	 * Devuelve el Date en formato YYYY-MM-DD
	 *
	 *	@return string
	 */		
	public function getDateFormatted() {
		
		$date = $this->getDate();

		if (empty($date))
			//si no hay fecha se devuelve la fecha de hoy
			return date('Y-m-d');		
		
		return $this->formatDate($date);
	}
	
	/**
	 * Devuelve el Expiration Date en formato YYYY-MM-DD
	 *
	 *	@return string
	 */		
	public function getExpirationDateFormatted() {
		
		$date = $this->getExpirationDate();
		if (empty($date) || ($date == "1999-11-30 00:00:00")) {
			//si no hay fecha de expiracion, se devuelve la fecha de maniana
			list($year,$month,$day) = explode("-",$this->getDateFormatted());
			return $year . "-" . $month . "-" . ($day+1);		
		}		
		return $this->formatDate($date);
	}	
	
} // TableroActivity
