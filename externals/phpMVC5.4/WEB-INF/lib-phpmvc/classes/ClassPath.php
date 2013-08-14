<?php
class ClassPath {
	function setClassPath($appServerRootDir = '', $subAppPaths = '', $osType = '') {
		if ($appServerRootDir == '') {   echo 'Error: ClassPath :- No php.MVC application root directory specified';
			exit ;
		}  $appDirs = array();
		$appDirs[] = '';
		$appDirs[] = 'WEB-INF';
		$appDirs[] = 'WEB-INF/lib-phpmvc';
		$appDirs[] = 'WEB-INF/lib-phpmvc/Propel';
		if (is_array($subAppPaths)) {   $appDirs = array_merge($appDirs, $subAppPaths);
		}  $delim = NULL;
		if ($osType != '') {
			if (stristr($osType, "WIN") || stristr(PHP_OS, "WIN")) {   $delim = ';';
			} elseif (stristr($osType, "UNIX") || stristr(PHP_OS, "LINUX")) {   $delim = ':';
			} elseif (stristr($osType, "MAC") || stristr(PHP_OS, "MAC")) {   $delim = ':';
			}
		}
		if ($delim == NULL) {
			if (stristr($osType, "WIN")) {   $delim = ';';
			} else {   $delim = ':';
			}
		}  $path = $appServerRootDir;
		$pathToWebInf = $pathToWebInf = preg_replace("/WEB-INF.*$/i", '', $path);
		$pathToWebInf = str_replace("\\", "/", $pathToWebInf);
		$pathToWebInf = preg_replace("/\/$/i", '', $pathToWebInf);
		$classPath = NULL;
		foreach ($appDirs as $appDir) {   $classPath .= $pathToWebInf . '/' . $appDir . $delim;
		}  $classPath = substr($classPath, 0, -1);
		ini_set('include_path', $classPath);
		return $classPath;
	}
	function getClassPath($appServerRootDir = '', $appDirs, $osType = '') {
		if ($appServerRootDir == '') {   echo 'Error: ClassPath :- No php.MVC application root directory specified';
			exit ;
		}  $delim = NULL;
		if ($osType == '') {   $delim = PATH_SEPARATOR;
		} else {   $delim = ClassPath::getPathDelimiter($osType);
		}  $path = $appServerRootDir;
		$pathToWebInf = preg_replace("/WEB-INF.*$/i", '', $path);
		$pathToWebInf = str_replace("\\", "/", $pathToWebInf);
		$pathToWebInf = preg_replace("/\/$/i", '', $pathToWebInf);
		$classPath = NULL;
		$AbsolutePath = False;
		foreach ($appDirs as $appDir) {   $AbsolutePath = ClassPath::absolutePath($appDir);
			if ($AbsolutePath == True) {   $classPath .= $appDir . $delim;
			} else {   $classPath .= $pathToWebInf . '/' . $appDir . $delim;
			}
		}  $classPath = substr($classPath, 0, -1);
		return $classPath;
	}
	function concatPaths($path1, $path2, $osType = '') {   $delim = NULL;
		$delim = ClassPath::getPathDelimiter($osType);
		$path = $path1 . $delim . $path2;
		return $path;
	}
	function getPathDelimiter($osType = '') {   $delim = NULL;
		if ($osType != '') {
			if (stristr($osType, "WIN")) {   $delim = ';';
			} elseif (stristr($osType, "UNIX")) {   $delim = ':';
			} elseif (stristr($osType, "MAC")) {   $delim = ':';
			}
		}
		if ($delim == NULL) {
			if (stristr($osType, "WIN")) {   $delim = ';';
			} else {   $delim = ':';
			}
		}
		return $delim;
	}
	function absolutePath($systemPath) {   $fAbsolutePath = False;
		if (preg_match("/^\//", $systemPath)) {   $fAbsolutePath = True;
		} elseif (preg_match("/^[a-z]:\\\/i", $systemPath)) {   $fAbsolutePath = True;
		} elseif (preg_match("/^[a-z]:\//i", $systemPath)) {   $fAbsolutePath = True;
		}
		return $fAbsolutePath;
	}

}
?>
