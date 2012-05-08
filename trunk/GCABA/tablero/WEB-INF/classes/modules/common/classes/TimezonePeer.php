<?php

require_once('Timezone.php');

class TimezonePeer {

	private $values;
	private $numberToKey;

	/*
	 * Constructor
	 *
	 */
	function __construct() {
	
		$this->values = array();
		$this->values['0'] = new Timezone('0','England/Scotland/Iceland (GMT-0)');
		$this->values['1'] = new Timezone('1','Spain/France/Italy/Germany (GMT+1)');
		$this->values['2'] = new Timezone('2','Greece/South Africa/Finland/Israel (GMT+2)');
		$this->values['3'] = new Timezone('3','Tanzania/Kenya/Saudi Arabia/Madagascar (GMT+3)');
		$this->values['4'] = new Timezone('4','Armenia/Georgia/United Arab Emirates (GMT+4)');
		$this->values['5'] = new Timezone('5','Pakistan/Maldives (GMT+5)');
		$this->values['6'] = new Timezone('6','Kazakhstan/Bangladesh (GMT+6)');
		$this->values['7'] = new Timezone('7','Thailand/Vietnam/Cambodia/Laos (GMT+7)');
		$this->values['8'] = new Timezone('8','Hong Kong/Taiwan/Singapore (GMT+8)');
		$this->values['9'] = new Timezone('9','Japan/North Korea/South Korea(GMT+9)');
		$this->values['10'] = new Timezone('10','Australia/Papua New Guinea (GMT+10)');
		$this->values['11'] = new Timezone('11','Solomon Islands (GMT+11)');
		$this->values['12'] = new Timezone('12','New Zealand/Fiji(GMT+12)');
		$this->values['-1'] = new Timezone('-1','Cape Verde/Azores (GMT-1)');
		$this->values['-2'] = new Timezone('-2','Antarctica (GMT-2)');
		$this->values['-3'] = new Timezone('-3','Argentina/Uruguay (GMT-3)');
		$this->values['-4'] = new Timezone('-4','Paraguay/Brazil West/Chile (GMT-4)');
		$this->values['-4.5'] = new Timezone('-4.5','Venezuela (GMT-4.5)');
		$this->values['-5'] = new Timezone('-5','Cuba/Ecuador/Colombia (GMT-5)');
		$this->values['-6'] = new Timezone('-6','USA Central/Mexico/Honduras/Nicaragua (GMT-6)');
		$this->values['-7'] = new Timezone('-7','USA Arizona/USA Mountain/Mexico Sinaloa/Mexico Sonora (GMT-7)');
		$this->values['-8'] = new Timezone('-8','USA Pacific/Canada Yukon & Pacific/Mexico Baja Calif Norte (GMT-8)');
		$this->values['-9'] = new Timezone('-9','USA Alaska/Gambier Island (GMT-9)');
		$this->values['-10'] = new Timezone('-10','USA Hawaii/Tahiti/Christmas Islands (GMT-10)');
		$this->values['-11'] = new Timezone('-11','Samoa/Midway Island/Canton Enderbury Islands (GMT-11)');
		$this->values['-12'] = new Timezone('-12','Kwajalein (GMT-12)');		

	}

	/*
	 * Devuelve todas las zonas horarias habilitadas en el sistema.
	 * @param array de instancias de Timestamp
	 *
	 */
	public function getAll() {
		return $this->values;
	}
	
	/*
	 * Obtiene la hora actual del servidor en GMT-0
	 * Esta sera utilizada para guardarla en la base de datos la hora actual del servidor en GMT-0
	 *
	 */
	public function getServerTimeOnGMT0() {
	
		$serverTime = time();
		return $serverTime - date('Z', $serverTime);
	
	}
	
	/*
	 * Devuelve una timestamp en otra zona horaria
	 * @param $datetime datetime en GMT-0
	 * @param $timezoneCode codigo de zona de GMT
	 * @returns datetime convertido a la correspondiente zona horaria pedida 
	 */
	public function getGMT0TimeOnTimezone($datetime,$timezoneCode) {
	
		//convertimos el datetime a un timestamp
		$timestamp = strtotime($datetime);
		//obtenemos la timezone correspondiente

		$timezone = $this->values[$timezoneCode];
		//calculo la diferencia con GMT-0 de la zona horaria que pedida
		$difference = $timezone->getSecondsFromGMT();
		//se suma la diferencia a la hora en GMT-0 recibida como parametro.
		//se devuelve en el formato de un datetime

		if ($datetime == '' || $datetime == NULL)
			return;
		else
			return date("Y-m-d H:i:s",$timestamp + $difference);
	
	}
	
	/*
	 * Devuelve una timestamp en otra zona horaria
	 * @param $datetime datetime en GMT-0
	 * @param $timezoneCode codigo de zona de GMT
	 * @returns datetime convertido a la correspondiente zona horaria pedida 
	 */
	public function getGMT0DatetimeFromTimezone($datetime,$timezoneCode) {
		//convertimos el datetime a un timestamp
		$timestamp = strtotime($datetime);
		//obtenemos la timezone correspondiente
		$timezone = $this->values[$timezoneCode];
		//calculo la diferencia con GMT-0 de la zona horaria que pedida
		$difference = $timezone->getSecondsFromGMT();
		//se suma la diferencia a la hora en GMT-0 recibida como parametro.
		//se devuelve en el formato de un datetime
		return date("Y-m-d H:i:s",$timestamp - $difference);
	
	}


}
