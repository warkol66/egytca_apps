<?php
class APlugIn {
	var $init = False;
	var $className = '';
	var $key = '';
	var $plugIn = NULL;
	function setClassName($value) { $this -> className = $value;
	}
	function setKey($value) { $this -> key = $value;
	}
	function getKey() {
		return $this -> key;
	}
	function addProperty($name, $value) { $propertyName = 'set' . ucfirst($name);
		if (strtolower($value) == 'true') { $value = True;
		} elseif (strtolower($value) == 'false') { $value = False;
		}
		if (method_exists($this, $propertyName)) { $this -> $propertyName($value);
		} else { $plugInVars = get_class_vars(get_class($this -> plugIn));
			if (array_key_exists($name, $plugInVars)) { $p = &$this -> plugIn;
				$p -> $name = $value;
			} else { $p = &$this -> plugIn;
				switch ($name) { case 'template_dir' :
						$p -> setTemplateDir($value);
						break;
					case 'compile_dir' :
						$p -> setCompileDir($value);
						break;
					case 'config_dir' :
						$p -> setConfigDir($value);
						break;
					case 'cache_dir' :
						$p -> setCacheDir($value);
						break;
					default :
						$driverName = ucfirst(get_class($this));
						print 'Error: ' . $driverName . '->addProperty(): Method: ' . $propertyName . " not found<br>\n";
				}
			}
		}
	}
	function APlugIn() {
	}
	function init($config = '') {
		if ($this -> init) {
			return;
		}; $this -> init = True;
	}
	function destroy() { $this -> plugIn = NULL;
		;
	}

}
?>
