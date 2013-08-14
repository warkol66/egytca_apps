<?php
class DispatchAction extends Action {
	var $messages = NULL;
	var $methods = array();
	var $log = NULL;
	function DispatchAction($config = 'LocalStrings') { $returnNull = False;
		$defaultLocale = new Locale();
		$factory = NULL;
		$pmr = NULL;
		$this -> messages = new PropertyMessageResources($factory, $config, $returnNull);
		$this -> messages -> setDefaultLocale($defaultLocale);
		$this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isTraceEnabled', False);
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isErrorEnabled', False);
	}
	function dispatchMethod($mapping, $form, &$request, &$response, $name) { $trace = $this -> log -> getLog('isTraceEnabled');
		$debug = $this -> log -> getLog('isDebugEnabled');
		$error = $this -> log -> getLog('isErrorEnabled');
		if ($trace) { $this -> log -> trace('Start: DispatchAction->dispatchMethod(...)' . '[' . __LINE__ . ']');
		} $locale = $request -> getAttribute('locale');
		if (get_class($locale) != 'locale')
			$locale = NULL;
		$method = NULL;
		$method = $this -> getMethod($name);
		if ($method == NULL) { $args = array($mapping -> getPath(), $name);
			$message = $this -> messages -> getMessage($locale, 'dispatch.method', $args);
			if ($error) { $this -> log -> error('DispatchAction->dispatchMethod(...)' . '[' . __LINE__ . '] ' . $message);
			}
			return NULL;
		} $forward = NULL;
		$forward = $this -> $name($mapping, $form, $request, $response);
		if ($forward == NULL) { $args = array($mapping -> getPath(), $name);
			$message = $this -> messages -> getMessage($locale, "dispatch.error", $args);
			if ($error) { $this -> log -> error('DispatchAction->dispatchMethod(...)' . '[' . __LINE__ . '] ' . $message);
			}
			return NULL;
		}
		return $forward;
	}
	function execute($mapping, $form, &$request, &$response) { $trace = $this -> log -> getLog('isTraceEnabled');
		$debug = $this -> log -> getLog('isDebugEnabled');
		$error = $this -> log -> getLog('isErrorEnabled');
		if ($trace) { $this -> log -> trace('Start: DispatchAction->execute(...)' . '[' . __LINE__ . ']');
		} $locale = $request -> getAttribute('locale');
		if (get_class($locale) != 'locale')
			$locale = NULL;
		$parameter = $mapping -> getParameter();
		if ($parameter == NULL) { $args = array($mapping -> getPath());
			$message = $this -> messages -> getMessage($locale, "dispatch.handler", $args);
			if ($error) { $this -> log -> error('DispatchAction->execute(...)' . '[' . __LINE__ . '] ' . $message);
			}
			return NULL;
		} $name = $request -> getParameter($parameter);
		if ($name == NULL) { $args = array($mapping -> getPath(), $parameter);
			$message = $this -> messages -> getMessage($locale, "dispatch.parameter", $args);
			if ($error) { $this -> log -> error('DispatchAction->execute(...)' . '[' . __LINE__ . '] ' . $message);
			}
			return NULL;
		}
		return $this -> dispatchMethod($mapping, $form, $request, $response, $name);
	}
	function getMethod($name) { $trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { $this -> log -> trace('Start: DispatchAction->getMethod(...)' . '[' . __LINE__ . ']');
		} $method = NULL;
		if (array_key_exists($name, $this -> methods))
			$method = $this -> methods[$name];
		if ($method == NULL) { $class_methods = get_class_methods(get_class($this));
			foreach ($class_methods as $method_name) {
				if (strtolower($name) == strtolower($method_name)) { $this -> methods[$name] = $name;
					$method = $name;
					break;
				}
			}
		}
		return $method;
	}

}
?>
