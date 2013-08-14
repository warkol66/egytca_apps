<?php
class BootUtils {
	function loadAppConfig(&$actionServer, &$appServerConfig, $configPath = '', $cfgId = 'config', $cfgValue = '', $appServerRootDir = '', $globalPrependXML = '') {  		$initXMLConfig = False;
		$cfgDataMTime = 0;
		$cfgXMLMTime = 0;
		$forceCompile = False;
		$oApplicationConfig = '';
		$phpmvcConfigXMLFile = 'phpmvc-config.xml';
		$phpmvcConfigDataFile = 'phpmvc-config.data';
		if ($cfgValue != '') { 			$phpmvcConfigXMLFile = $cfgValue['name'];
			$forceCompile = $cfgValue['fc'];
			$phpmvcConfigDataFile = preg_replace("/\..*/", '', $phpmvcConfigXMLFile);
			$phpmvcConfigDataFile .= '.data';
		}
		if ($configPath == '') { 			$configPath = './WEB-INF';
		}
		if ((!file_exists($configPath . '/' . $phpmvcConfigDataFile)) || $forceCompile == True) {	 			$initXMLConfig = True;
		} else { 			$cfgDataMTime = filemtime($configPath . '/' . $phpmvcConfigDataFile);
			$cfgXMLMTime = filemtime($configPath . '/' . $phpmvcConfigXMLFile);
			if ($cfgXMLMTime > $cfgDataMTime) { 				$initXMLConfig = True;
			}
			if (!$initXMLConfig) {
				global $moduleRootDir;
				$modulesPath = $moduleRootDir . "WEB-INF/classes/modules";
				$modules = scandir($modulesPath);
				$i = 0;
				while ($i < count($modules) && !$initXMLConfig) { 					$module = $modules[$i];
					if (substr("$module", -1) != "." && $module != ".svn" && is_dir($modulesPath . '/' . $module)) { 						$expectedFile = $moduleRootDir . "WEB-INF/classes/modules/" . $module . "/setup/phpmvc-config-" . $module . ".xml";
						if (file_exists($expectedFile)) { 							$cfgXMLMTime = filemtime($expectedFile);
							if ($cfgXMLMTime > $cfgDataMTime) { 								$initXMLConfig = True;
							}
						}
					} 					$i++;
				}
			}
		}
		if ($initXMLConfig == False) { 			$strConfig = implode('', @file($configPath . '/' . $phpmvcConfigDataFile));
			$oApplicationConfig = @unserialize($strConfig);
			if ($oApplicationConfig) { 				$strClassID = $_strClassID = '';
				$strClassID = $oApplicationConfig -> getClassID();
				$_strClassID = ApplicationConfig::_getClassID();
				$aClassID = explode(':', $strClassID);
				$classVersionID = $aClassID[2];
				$_aClassID = explode(':', $_strClassID);
				$_classVersionID = $_aClassID[2];
				if ($_classVersionID != $classVersionID) { 					$initXMLConfig = True;
					$oApplicationConfig = NULL;
				}  				$actionServer -> appServerConfig = $appServerConfig;
			} else {  				$initXMLConfig = True;
				echo "<b>Warning:</b>Cached ApplicationConfig data file seems corrupted ...<br>";
				echo "Trying to recompile the application configuration file: ";
				echo "$configPath/$phpmvcConfigXMLFile<br><br>";
			}
		}
		if ($initXMLConfig) {
			global $moduleRootDir;
			$modulesPath = $moduleRootDir . "WEB-INF/classes/modules";
			$xmlPath = $moduleRootDir . "WEB-INF/" . $phpmvcConfigXMLFile;
			$fullXmlPath = $moduleRootDir . "WEB-INF/phpmvc-config-all.xml";
			$xmlContent = file_get_contents($xmlPath);
			$xmlContent = str_replace("</phpmvc-config>", "", $xmlContent);
			$modules = scandir($modulesPath);
			foreach ($modules as $module) {
				if (substr("$module", -1) != "." && $module != ".svn" && is_dir($modulesPath . '/' . $module)) { 					$expectedFile = $moduleRootDir . "WEB-INF/classes/modules/" . $module . "/setup/phpmvc-config-" . $module . ".xml";
					if (file_exists($expectedFile)) { 						$content = file_get_contents($expectedFile);
						$xmlContent .= $content;
					}
				}
			} 			 			$xmlContent .= "</phpmvc-config>";
			file_put_contents($fullXmlPath, $xmlContent);
			$actionServer -> setConfigPath($configPath . '/phpmvc-config-all.xml');
			if ($appServerRootDir == '') { 				$path = __FILE__;
				preg_match("/^(.*)web-inf.*$/i", $path, $regs);
				$phpmvcRoot = $regs[1];
				$phpmvcRoot = substr($phpmvcRoot, 0, -1);
				$appServerRootDir = $phpmvcRoot;
			}
			if ($globalPrependXML == '') { 				$globalPrependXML = 'lib-phpmvc/PhpMvcOneXML.php.ws';
			}
			if (!file_exists($appServerRootDir . '/WEB-INF/' . $globalPrependXML)) { 				echo "<b>Warning:</b> Cannot find the XML prepend file : <br>" . $appServerRootDir . '/WEB-INF/' . $globalPrependXML . "<br>" . "In BootUtils::loadAppConfig(...)<br>";
				return;
			}
			include_once $appServerRootDir . '/WEB-INF/' . $globalPrependXML;
			$oApplicationConfig = $actionServer -> init($appServerConfig);
			$strConfig = serialize($oApplicationConfig);
			$fp = fopen($configPath . '/' . $phpmvcConfigDataFile, 'w');
			fputs($fp, $strConfig);
			fclose($fp);
		}
		return $oApplicationConfig;
	}
	function getActionPath($_REQ_VARS, $actionID = 'do', $actPathMin = 1, $actPathMax = 35) {  		$pattern = '/^[a-z0-9_]{' . $actPathMin . ',' . $actPathMax . '}$/i';
		foreach ($_REQ_VARS as $varName => $varVal) {
			if ($varName != '' && $varName == $actionID) {
				if (preg_match($pattern, $varVal)) {
					return $varVal;
				}
			}
		}
		return NULL;
	}

}
?>
