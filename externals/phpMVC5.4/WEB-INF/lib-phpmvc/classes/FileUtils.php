<?php
class FileUtils {
	function trustedFile($file) {
		if (!eregi("^([a-z]+)://", $file) && fileowner($file) == getmyuid()) {
			return True;
		}
		return False;
	}
	function utime() { $time = explode(' ', microtime());
		$usec = (double)$time[0];
		$sec = (double)$time[1];
		return $sec + $usec;
	}
	function zapTmpFiles($targetDir, $fileTTL) { $handle = opendir($targetDir);
		while (False !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") { $timeNow = time();
				$timeFile = filemtime("$targetDir/$file");
				if (($timeNow - $timeFile) >= $fileTTL) {
					if (!unlink("$targetDir/$file")) { $error = '';
						return False;
					}
				}
			}
		} closedir($handle);
		return True;
	}
	function saveObject($sessFile, $obj) { $strObj = serialize($obj);
		$fp = fopen($sessFile, 'w');
		fputs($fp, $strObj);
		fclose($fp);
	}
	function restoreObject($sessFile) { $obj = NULL;
		if (file_exists($sessFile)) { $strObj = implode('', @file($sessFile));
			$obj = unserialize($strObj);
			return $obj;
		} else { touch($sessFile);
			return $obj;
		}
	}
	function listDir($dirPath) { $fileArray = NULL;
		if ($handle = opendir($dirPath)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") { $fileArray[] = $file;
				}
			} closedir($handle);
		}
		return $fileArray;
	}

}
?>
