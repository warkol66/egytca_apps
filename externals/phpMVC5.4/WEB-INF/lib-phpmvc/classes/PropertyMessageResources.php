<?php
class PropertyMessageResources extends MessageResources {
	var $locales = array();
	var $messages = array();
	function PropertyMessageResources($factory, $config, $returnNull = NULL) { parent::MessageResources($factory, $config, $returnNull);
	}
	function _getMessage($locale, $key) { $trace = $this -> log -> getLog('isTraceEnabled');
		$debug = $this -> log -> getLog('isDebugEnabled');
		if ($trace) { $this -> log -> trace('Start: PropertyMessageResources->_getMessage(...)' . '[' . __LINE__ . ']');
		} $localeKey = $this -> localeKey($locale);
		$originalKey = $this -> messageKey($localeKey, $key);
		$messageKey = '';
		$message = '';
		$underscore = 0;
		$addIt = False;
		while (True) { $this -> loadLocale($localeKey);
			$messageKey = $this -> messageKey($localeKey, $key);
			if ($debug) { $this -> log -> debug(' Loop from specific to general Locales looking for this message: ' . $localeKey . $messageKey . '[' . __LINE__ . ']');
			}
			if (array_key_exists($messageKey, $this -> messages))
				$message = $this -> messages[$messageKey];
			if ($message != '') {
				if ($addIt)
					$this -> messages[$originalKey] = $message;
				return $message;
			} $addIt = True;
			$pos = strrpos($localeKey, '_');
			if ($pos < 1)
				break;
			$localeKey = substr($localeKey, 0, $pos);
		}
		if (!$this -> defaultLocale -> equals($locale)) { $localeKey = $this -> localeKey($this -> defaultLocale);
			$messageKey = $this -> messageKey($localeKey, $key);
			if ($debug) { $this -> log -> debug(' Trying the default locale if the current locale is different: ' . $messageKey . '[' . __LINE__ . ']');
			} $this -> loadLocale($localeKey);
			$message = '';
			if (array_key_exists($messageKey, $this -> messages))
				$message = $this -> messages[$messageKey];
			if ($message != '') {
				if ($addIt) { $this -> messages[$originalKey] = $message;
				}
				return $message;
			}
		} $localeKey = '';
		$messageKey = $this -> messageKey($localeKey, $key);
		if ($debug) { $this -> log -> debug(' Last resort, try the default Locale: ' . $messageKey . '[' . __LINE__ . ']');
		} $this -> loadLocale($localeKey);
		if (array_key_exists($messageKey, $this -> messages))
			$message = $this -> messages[$messageKey];
		if ($message != '') {
			if ($addIt)
				$this -> messages[$originalKey] = $message;
			return $message;
		}
		if ($this -> returnNull) {
			return NULL;
		} else { $localeKey = $this -> localeKey($locale);
			return ("???" . $this -> messageKey($localeKey, $key) . "???");
		}
	}
	function loadLocale($localeKey) { $trace = $this -> log -> getLog('isTraceEnabled');
		$debug = $this -> log -> getLog('isDebugEnabled');
		if ($trace) { $this -> log -> trace('Start: PropertyMessageResources->loadLocale(' . $localeKey . ')' . '[' . __LINE__ . ']');
		}
		if ($debug) { $this -> log -> debug(' LocaleKey = "' . $localeKey . '" [' . __LINE__ . ']');
		}
		if (array_key_exists($localeKey, $this -> locales))
			return;
		$this -> locales[$localeKey] = $localeKey;
		if ((strpos($this -> config, '/')) || (strpos($this -> config, '\\'))) { $name = $this -> config;
		} else { $name = str_replace('.', '/', $this -> config);
		}
		if (strlen($localeKey) > 0)
			$name .= '_' . $localeKey;
		$name .= '.properties';
		if ($debug) { $this -> log -> debug(' Loading the property resource "' . $name . '" [' . __LINE__ . ']');
		} $fp = '';
		$fp = @fopen($name, 'r', 1);
		if ($fp) { $delimChar = '=';
			$maxLineLen = 1000;
			$messages = NULL;
			while (!feof($fp)) { $lineCSV = fgetcsv($fp, $maxLineLen, $delimChar);
				if (trim($lineCSV[0]) == '')
					continue;
				if (preg_match("/^\S*[#!]/", $lineCSV[0])) {
					continue;
				} $msgKey = $lineCSV[0];
				$localeMsgKey = $this -> messageKey($localeKey, $msgKey);
				$this -> messages[$localeMsgKey] = $lineCSV[1];
			} fclose($fp);
		}
	}

}
