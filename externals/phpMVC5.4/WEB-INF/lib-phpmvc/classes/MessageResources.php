<?php
class MessageResources {
	var $log = NULL;
	var $config = NULL;
	var $defaultLocale = NULL;
	var $factory = NULL;
	var $defaultFactory = NULL;
	var $formats = array();
	var $returnNull = False;
	function getConfig() {
		return $this -> config;
	}
	function getDefaultLocale() {
		return $this -> defaultLocale;
	}
	function setDefaultLocale($locale) { $this -> defaultLocale = $locale;
	}
	function getFactory() {
		return $this -> factory;
	}
	function getReturnNull() {
		return $this -> returnNull;
	}
	function setReturnNull($returnNull) { $this -> returnNull = $returnNull;
	}
	function MessageResources($factory, $config, $returnNull = False) { $this -> factory = $factory;
		$this -> config = $config;
		$this -> returnNull = $returnNull;
		$this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isTraceEnabled', False);
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isErrorEnabled', False);
	}
	function _getMessage($locale, $key) {;
	}
	function getMessage($locale, $key, $args = '', $arg0 = '', $arg1 = '', $arg2 = '', $arg3 = '') { $trace = $this -> log -> getLog('isTraceEnabled');
		$debug = $this -> log -> getLog('isDebugEnabled');
		if ($trace) { $this -> log -> trace('Start: MessageResources->getMessage(...)' . '[' . __LINE__ . ']');
		}
		if ($locale == NULL)
			$locale = $this -> defaultLocale;
		$format = NULL;
		$localeKey = $this -> localeKey($locale);
		$formatKey = $this -> messageKey($localeKey, $key);
		if (array_key_exists($formatKey, $this -> formats))
			$format = $this -> formats[$formatKey];
		if ($format == NULL) { $formatString = $this -> _getMessage($locale, $key);
			if ($formatString == NULL) {
				if ($this -> returnNull)
					return NULL;
				else
					return '???' . $formatKey . '???';
			} $format = new MessageFormat($this -> escape($formatString));
			$this -> formats[$formatKey] = $format;
		}
		return $format -> formatMsg($args, $arg0, $arg1, $arg2, $arg3);
	}
	function isPresent($locale = NULL, $key) { $message = $this -> getMessage($locale, $key);
		if ($message == NULL)
			return False;
		elseif (eregi("^???.*???$"))
			return False;
		else
			return True;
	}
	function escape($string) {
		if (($string == '') || (strpos($string, '\'') < 1))
			return $string;
		$string = str_replace("\'", "\\\'", $string);
		return $string;
	}
	function localeKey($locale) {
		if ($locale == NULL) {
			return '';
		} else {
			return $locale -> toString();
		}
	}
	function messageKey($localeKey, $key) { $messageKey = '';
		if ($localeKey != '')
			$messageKey .= $localeKey . '.';
		return $messageKey .= $key;
	}
	function getMessageResources($config) {
		if ($this -> defaultFactory == NULL)
			$this -> defaultFactory = MessageResourcesFactory::createFactory();
		return $this -> defaultFactory -> createResources($config);
	}

}
?>
