<?php
class ActionMessages {
	var $GLOBAL_MESSAGE = "phpmvc.action.GLOBAL_MESSAGE";
	var $messages = array();
	var $iCount = 0;
	function add($property, $message) {
		if (array_key_exists($property, $this -> messages)) { $ami = &$this -> messages[$property];
		} else { $ami = NULL;
		} $list = NULL;
		if ($ami == NULL) { $list = array();
			$list[] = $message;
			$ami = new ActionMessageItem($list, $this -> iCount++);
			$this -> messages[$property] = $ami;
		} else { $list = &$ami -> getList();
			$list[] = $message;
		}
	}
	function clear() { $this -> messages = array();
	}
	function isEmpty() {
		if (count($this -> messages) == 0)
			return True;
		else
			return False;
	}
	function _get() {
	}
	function get($property) {
		if (array_key_exists($property, $this -> messages)) { $ami = $this -> messages[$property];
		} else { $ami = NULL;
		}
		if ($ami == NULL)
			return 'EMPTY_LIST';
		else
			return $ami -> getList();
	}
	function getItemString($property, $index = 0) {
		if (array_key_exists($property, $this -> messages)) { $ami = $this -> messages[$property];
		} else { $ami = NULL;
		}
		if ($ami == NULL) {
			return '';
		} else { $messageSet = $ami -> getList();
		}
		if (array_key_exists($index, $messageSet)) {
			return $messageSet[$index] -> getKey();
		} else {
			return '';
		}
	}
	function properties() {
		return array_keys($this -> messages);
	}
	function size($property = '') {
		if ($property == '') { $total = 0;
			foreach ($this->messages as $key => $value) { $ami = $value;
				$total += count($ami -> getList());
			}
			return $total;
		} else { $ami = $this -> messages[$property];
			if ($ami == NULL)
				return 0;
			else
				return count($ami -> getList());
		}
	}

}

class ActionMessageItem {
	var $list = NULL;
	var $iOrder = 0;
	function ActionMessageItem($list, $iOrder) { $this -> list = $list;
		$this -> iOrder = $iOrder;
	}
	function & getList() {
		return $this -> list;
	}
	function setList($list) { $this -> list = $list;
	}
	function getOrder() {
		return $this -> iOrder;
	}
	function setOrder($iOrder) { $this -> iOrder = $iOrder;
	}

}
?>
