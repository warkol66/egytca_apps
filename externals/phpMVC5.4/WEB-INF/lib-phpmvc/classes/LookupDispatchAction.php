<?php
class LookupDispatchAction extends DispatchAction {
	var $lookupMap = NULL;
	var $keyMethodMap = NULL;
	var $log = NULL;
	function LookupDispatchAction($config = '') { parent::DispatchAction($config);
		$this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function execute($mapping, $form, &$request, &$response) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { $this -> log -> trace('Start: LookupDispatchAction->execute(...)' . '[' . __LINE__ . ']');
		} $locale = $request -> getAttribute('locale');
		if (get_class($locale) != 'locale')
			$locale = NULL;
		$msgRes = $this -> messages;
		$parameter = $mapping -> getParameter();
		if ($parameter == NULL) { $args = array($mapping -> getPath());
			$message = $msgRes -> getMessage('', 'dispatch.handler', $args);
			return $message;
		} $name = $request -> getParameter($parameter);
		if ($name == NULL) { $args = array($mapping -> getPath(), $parameter);
			$message = $msgRes -> getMessage('', 'dispatch.parameter', $args);
			return $message;
		}
		if ($this -> lookupMap == NULL) { $this -> lookupMap = array();
			$keyMethodMap = $this -> getKeyMethodMap();
			foreach ($keyMethodMap as $key => $value) { $text = NULL;
				$htmlenc = $msgRes -> getMessage($locale, $key);
				$text = $this -> unhtmlentities($htmlenc);
				if (($text != NULL) && (!array_key_exists($text, $this -> lookupMap))) { $this -> lookupMap[$text] = $key;
				} $this -> keyMethodMap = $keyMethodMap;
			}
		} $key = $this -> lookupMap[$name];
		$methodName = $this -> keyMethodMap[$key];
		return $this -> dispatchMethod($mapping, $form, $request, $response, $methodName);
	}
	function getKeyMethodMap() {
	}
	function unhtmlentities($string) { $trans_tbl = get_html_translation_table(HTML_ENTITIES);
		$trans_tbl = array_flip($trans_tbl);
		return strtr($string, $trans_tbl);
	}

}
?>
