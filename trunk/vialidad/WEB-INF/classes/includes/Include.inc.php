<?php
/*
 * Funciones y variables comunes al sistema
 *
 * @package Config
 */

	if (headers_sent($filename, $linenum))
		echo "Debug: Headers already sent in $filename on line $linenum\n";

	ini_set("show_errors",true);
	session_cache_limiter('nocache');
	session_start();

	//Configuracion de Usuario en Caso de ejecucion por linea de comando
	if ($_ENV['PHPMVC_MODE_CLI'] == true) {
		//cargamos el usuario system modo supervisor para login de los actions
		$user = UserPeer::getByUsername('system');
		$_SESSION["login_user"] = $user;
		$_SESSION["loginUser"] = $user;
	}

	//Configuracion de Error Reporting
	global $system;
	if (isset($system)) {

		$conversionTable = array(
			'NONE'=> E_ERROR,
			'E_ALL & ~E_NOTICE'=> E_ALL - E_NOTICE,
			'E_ALL' => E_ALL,
			'E_ALL & E_STRICT' => E_ALL + E_STRICT,
			'E_STRICT' => E_STRICT,
			'E_ALL & ~E_NOTICE ~E_WARNING'=> E_ALL - E_NOTICE - E_WARNING
			);

		$level = $system["config"]["system"]["errorReporting"]["value"];
		if ($conversionTable[html_entity_decode($level)] == 0)
			ini_set("error_reporting",E_ALL);
		else
			ini_set("error_reporting",$conversionTable[html_entity_decode($level)]);

		ini_set("ignore_repeated_errors",1);

	}

	$actpath = strtok($_SERVER['PHP_SELF'],'/');

	set_error_handler("userErrorHandler");

	register_shutdown_function('shutdownFunction');

	function shutDownFunction() {
		$error = error_get_last();
		if ($error['type'] == 1)
			userErrorHandler($error["type"],$error["message"],$error["file"],$error["line"]);
	}

	/**
	* userErrorHandler
	* userErrorHandler
	* @return userErrorHandler
	*/
	function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars) {

		global $system;

		$dt = date("Y-m-d H:i:s (T)");
		$errortype = array (
			E_ERROR          => 'ERROR',
			E_WARNING        => 'WARNING',
			E_PARSE          => 'PARSING ERROR',
			E_NOTICE         => 'NOTICE',
			E_CORE_ERROR     => 'CORE ERROR',
			E_CORE_WARNING   => 'CORE WARNING',
			E_COMPILE_ERROR  => 'COMPILE ERROR',
			E_COMPILE_WARNING => 'COMPILE WARNING',
			E_USER_ERROR     => 'USER ERROR',
			E_USER_WARNING   => 'USER WARNING',
			E_USER_NOTICE    => 'USER NOTICE',
			E_STRICT         => 'STRICT NOTICE'
		);

		if ((version_compare(PHP_VERSION, '5.2.0')) > 0) {
			$errortype5_2 = array (
				E_RECOVERABLE_ERROR  => 'RECOVERABLE ERROR'
			);
			$errortype = $errortype + $errortype5_2 ;
		}

		if ((version_compare(PHP_VERSION, '5.3.0')) > 0) {
			$errortype5_3 = array (
				E_DEPRECATED     => 'E_DEPRECATED',
				E_USER_DEPRECATED => 'E_USER_DEPRECATED'
			);
			$errortype = $errortype + $errortype5_3 ;
		}

		// SET of errors for which a var trace will be saved
		$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
		$err = "<errorentry>\n";
		$err .= "\t<datetime>"      . $dt .       "</datetime>\n";
		$err .= "\t<errornum>"      . $errno .    "</errornum>\n";
		$err .= "\t<errortype>"     . $errortype[$errno] . "</errortype>\n";
		$err .= "\t<errormsg>"      . $errmsg .     "</errormsg>\n";
		$err .= "\t<scriptname>"    . $filename .   "</scriptname>\n";
		$err .= "\t<scriptlinenum>" . $linenum .    "</scriptlinenum>\n";

		if (in_array($errno, $user_errors)){
			$err .= "\t<vartrace>" . wddx_serialize_value($vars, "Vars") . "</vartrace>\n";
		}
		$err .= "</errorentry>\n";
		if (isset($_SERVER['HTTP_REFERER']))
			$err .= "<referrer>" . $_SERVER['HTTP_REFERER'] . "</referrer>\n";
		$err .= "<request>"  . $_SERVER['REQUEST_URI']  . "</request>\n\n";

		if (!empty($errstr) && preg_match('/^(sql)$/', $errstr)) {
			$MYSQL_ERRNO = mysql_errno();
			$MYSQL_ERROR = mysql_error();
			$err .="<errormysql>".$MYSQL_ERRNO.":".$MYSQL_ERROR."</errormysql>";
		}

		if ($errno == E_USER_ERROR || $errno == E_ERROR || $errno == E_CORE_ERROR  ||
				$errno == E_COMPILE_ERROR || $errno == mysql_errno()) {

			if(($system['config']['system']['parameters']['debugMode']['value']=='YES')) {

				require_once('EmailManagement.php');
				$manager = new EmailManagement();

				$user = Common::getLoggedUser();
				if (is_object($user))
					$userInfo = $user->getUsername();
				else
					$userInfo = "Visitor";

				$subject = "SITIO: ".$system['config']['system']['parameters']['siteShortName']." / Error generado por ".$userInfo;
				$email = explode(',', $system['config']['system']['parameters']['debugMail']);
				$mailFrom = $system['config']['system']['parameters']['fromEmail'];

				$message = $manager->createHTMLMessage($subject,$err);
				$result = $manager->sendMessage($email,$mailFrom,$message);
			}

			die("<br /><strong>Error procesando su requerimiento, por favor reintente o comuniquese con el administrador.</strong>\n <br /><br />".
					"Texto del error: ".$err );
		}
	}

	/**
	* lcfirst
	* lcfirst para php < 5.3.0
	* @return primer caracter de string en minuscula
	*/
	if (false === function_exists('lcfirst')) {
		function lcfirst( $str ) {
			return (string)(strtolower(substr($str,0,1)).substr($str,1));
		}
	}