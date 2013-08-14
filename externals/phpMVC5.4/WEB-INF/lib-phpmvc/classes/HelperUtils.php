<?php
class HelperUtils {
	function zapArrayElement($key, &$array) { $idx = array_search($key, array_keys($array));
		if ($idx === NULL || $idx === False) {
			return False;
		} else { array_splice($array, $idx, 1);
			return True;
		}
	}

}
