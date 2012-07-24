<?php

/**
 * Class TimestampParser.
 */
class TimestampParser {
    
    private $date;
    private $timestamp;
    private $timestampFormat = 'Y-m-d H:i:s';
    private static $REGEX = array(
        'es' => array(
            'minutes' => '/^hace([0-9]+)minutos?/',
            'hours'   => '/^hace([0-9]+)horas?/',
            'days'    => '/^hace([0-9]+)días?/'
        ),
        'en' => array(
            'minutes' => '/^([0-9]+)minutes?ago/',
            'hours'   => '/^([0-9]+)hours?ago/',
            'days'    => '/^([0-9]+)days?ago/',
        )
    );
    
    public function __construct($timestamp = null) {
        $this->timestamp = $timestamp;
        $this->date = new DateTime();
    }
    
    /**
     * Intenta obtener una fecha a partir del timestamp pasado al constructor.
     * Si lo logra, devuelve la fecha en formato $timestampFormat. 
     * Si no lo logra, devuelve null.
     * 
     * @return mixed
     */
    public function parse() {
        if (empty($this->timestamp)) return null;
        
        // Si no matchea con ninguno anterior pruebo si es una fecha.
        if (!$this->parseI18n("es") && !$this->parseI18n("en")) {
            try {
                $this->date = $this->parseDate($this->timestamp);
            }
            catch (Exception $e) {
                return null;
            }
        }
        
        return $this->toTimestamp();
    }
    
    private function parseDate($date) {
	    $parts = preg_split('/\//', $date);
	    if (count($parts) == 3) {
		    if (strlen($parts[0]) == 2 && strlen($parts[1]) == 2 && strlen($parts[2]) == 4)
			    return DateTime::createFromFormat('d/m/Y', $date);
	    }
	    return new DateTime($date);
    }
    
    private function parseI18n($lang) {
        $regex = self::$REGEX[$lang];
        $preged = preg_replace("/ /", "", $this->timestamp);
        
        if (preg_match($regex["minutes"], $preged)) {
            $m = preg_replace($regex["minutes"], '$1', $preged);
            $this->date->modify("-$m minutes");
            return true;
        }

        if (preg_match($regex["hours"], $preged)) {
            $h = preg_replace($regex["hours"], '$1', $preged);
            $this->date->modify("-$h hours");
            return true;
        }
        
        if (preg_match($regex["days"], $preged)) {
            $d = preg_replace($regex["days"], '$1', $preged);
            $this->date->modify("-$d days");
            return true;
        }

        return false;
    }
    
    private function toTimestamp() {
        return $this->date->format($this->timestampFormat);
    }


} // TimestampParser
