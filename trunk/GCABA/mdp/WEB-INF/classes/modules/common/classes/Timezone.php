<?php

class Timezone {

	private $code;
	private $description;
	
	/**
	 * Constructor
	 * 
	 * @param $code codigo de zona horaria
	 * @param $description descripcion
	 *
	 */
	function __construct($code,$description) {

		$this->code = $code;
		$this->description = $description;
	
	}

	/**
	 * Devuelve el codigo de la zona horaria
	 * @returns string
	 *
	 */
	public function getCode() {
	
		return $this->code;
	
	}
	
	/**
	 * Devuelve la descripcion del Timezone
	 * @returns string
	 *
	 */
	public function getDescription() {
	
		return $this->description;	
	
	}
	
	/*
	 * Devuelve la cantidad de segundos de diferencia de una cierta timezone con respecto al GMT-0
	 * @param string timezone code
	 * @returns integer cantidad de segundos de diferencia con GMT-0
	 */
	public function getSecondsFromGMT() {
		
		//3600 segundos por hora
		return 3600 * $this->getCode();
	
	}


}
