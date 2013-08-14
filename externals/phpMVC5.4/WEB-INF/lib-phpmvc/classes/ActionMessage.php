<?php
class ActionMessage {
	var $key = NULL;
	var $values = array();
	function ActionMessage($key, $value0 = '', $value1 = '', $value2 = '', $value3 = '', $values = '') { $this -> key = $key;
		$this -> values = NULL;
		if ($value0 != '') { $this -> values[] = $value0;
		}
		if ($value1 != '') { $this -> values[] = $value1;
		}
		if ($value2 != '') { $this -> values[] = $value2;
		}
		if ($value3 != '') { $this -> values[] = $value3;
		}
		if ($values != '' && is_array($values)) { $this -> values = NULL;
			$this -> values = $values;
		}
	}
	function getKey() {
		return $this -> key;
	}
	function getValues() {
		return $this -> values;
	}

}
?>
