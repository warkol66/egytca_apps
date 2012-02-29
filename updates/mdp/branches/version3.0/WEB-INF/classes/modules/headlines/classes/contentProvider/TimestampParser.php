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
    
    public function parse() {
        if (empty($this->timestamp)) return null;
        
        // Si no matchea con ninguno anterior pruebo si es una fecha.
        if (!$this->parseI18n(self::$REGEX["es"]) && !$this->parseI18n(self::$REGEX["en"])) {
            try {
                $this->date = new DateTime($this->timestamp);
            }
            catch (Exception $e) {
                return null;
            }
        }
        
        return $this->toTimestamp();
    }
    
    private function parseI18n($regex) {
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
