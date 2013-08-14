<?php
class MessageFormat extends Format {
	function MessageFormat($pattern) { parent::Format($pattern);
	}
	function formatMsg($args = '', $arg0 = '', $arg1 = '', $arg2 = '', $arg3 = '') {
		if (!is_array($args) && $arg0 == '' && $arg1 == '' && $arg2 == '' && $arg3 == '')
			return $this -> pattern;
		if ((!is_array($args)) && ($arg0 != '' || $arg1 != '' || $arg2 != '' || $arg3 != '')) {
			if ($arg0 != '')
				$args[0] = $arg0;
			if ($arg1 != '')
				$args[1] = $arg1;
			if ($arg2 != '')
				$args[2] = $arg2;
			if ($arg3 != '')
				$args[3] = $arg3;
		}
		if (is_string($this -> pattern) && strlen($this -> pattern) > 0) { $pattern = $this -> pattern;
		} else {
			return "Opps, we got a problem with the message pattern";
		} $params = array('{0}', '{1}', '{2}', '{3}');
		foreach ($args as $key => $val) { $pattern = str_replace($params[$key], $val, $pattern);
		}
		return $pattern;
	}

}
?>
