<?php
/*
 * Funciones y variables comunes al sistema
 *
 * @package Config
 */ 

  require_once('Smarty_config.inc.php');

  include_once('Constants.inc.php');
  define('MAXIMOS_RESULTADOS_POR_PAGINA',20);
  //ini_set("error_reporting",E_ALL);
  //ini_set("show_errors",true);
  session_cache_limiter('nocache');
  session_start();
  extract($_SESSION,EXTR_PREFIX_ALL,'session');
  extract($_GET,EXTR_PREFIX_ALL,'get');
  extract($_POST,EXTR_PREFIX_ALL,'post');
  //error_reporting(0);


/*
 * Variable para indicar si el sitio se encuentra en estado de desarrollo
 * Captura los mails generados por el sistema y los guarda en un archivo de texto
 */ 
	global $enDesarrollo;
	$enDesarrollo = $_SESSION["parametros"]["SISTEMA_EN_DESARROLLO"];
/*
 * Variable para indicar si el sitio se encuentra en mantenimiento
 * No permite loguear ningun usuario nuevo, solo el supervisor
 */ 
	global $enMantenimiento;
	$enMantenimiento = $_SESSION["parametros"]["SISTEMA_EN_MANTENIMIENTO"];

  /**
  * getBrowser
  * 
  * Obtiene las especificaciones del Browser
  *
  * @return array con nombre del browser y version
  */
	function getBrowser(){
		if ($msie_p=strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
		{
			$msie_e=strpos($_SERVER['HTTP_USER_AGENT'],';',$msie_p+5);
			$ver=substr($_SERVER['HTTP_USER_AGENT'],$msie_p+5,$msie_e-$msie_p-5);
			$browser='msie';
		}
		elseif(strpos($_SERVER['HTTP_USER_AGENT'],'Mozilla')!==false)
		{
			$moz_p=strpos($_SERVER['HTTP_USER_AGENT'],'Mozilla')+8;
			$moz_e=strpos($_SERVER['HTTP_USER_AGENT'],' ',$moz_p);
			$ver=substr($_SERVER['HTTP_USER_AGENT'],$moz_p,$moz_e-$moz_p);
			$browser='mozilla';
		}
		else
		{
			$browser=$_SERVER['HTTP_USER_AGENT'];
			$ver='';
		}
		return(array('name'=>$browser,'version'=>$ver));
	}

	$actpath=strtok($_SERVER['PHP_SELF'],'/');
	set_error_handler("userErrorHandler");

  /**
  * makedate
  * 
  * makedate
  *
  * @return makedate
  */
	function makedate($unit = '', $time = '', $mask = '')
	{
		$validunit = '/^[-+]?\b[0-9]+\b$/';
		$validtime = '/^\b(day|week|month|year)\b$/i';
		$validmask = '/^(short|long|([dmy[:space:][:punct:]]+))$/i';

		if (!preg_match($validunit,$unit)) 
		{
			$unit = -1;
		}

		if (!preg_match($validtime,$time)) 
		{
			$time = 'day';
		}

		if (!preg_match($validmask,$mask)) 
		{
			$mask = 'yyyymmdd';
		}

		switch ($mask)
		{
			case 'short': // 7/4/2003
				$mask = "n/j/Y";
				break;
			case 'long':  // Friday, July 4, 2003
				$mask = "l, F j, Y";
				break;
			default:
				if (preg_match('/([[:space:]]|[[:punct:]])/', $mask)) 
				{
					$chars = preg_split
					(
						'/([[:space:]]|[[:punct:]])/',
						$mask,
						-1,
						PREG_SPLIT_NO_EMPTY |
						PREG_SPLIT_DELIM_CAPTURE
					);
				}
				else
				{
					$chars = preg_split
					(
						'/(m*|d*|y*)/i',
						$mask,
						-1,
						PREG_SPLIT_NO_EMPTY |
						PREG_SPLIT_DELIM_CAPTURE
					);
				}
				foreach ($chars as $key => $char) 
				{
					switch (TRUE) 
					{
						case eregi ("m{3,}",$chars[$key]): // 'mmmm' = month string
							$chars[$key] = "F";
							break;
						case eregi ("m{2}",$chars[$key]):  // 'mm'   = month as 01-12
							$chars[$key] = "m";
							break;
						case eregi ("m{1}",$chars[$key]):  // 'm'    = month as 1-12
							$chars[$key] = "n";
							break;
						case eregi ("d{3,}",$chars[$key]): // 'dddd' = day string
							$chars[$key] = "l";
							break;
						case eregi ("d{2}",$chars[$key]):  // 'dd'   = day as 01-31
							$chars[$key] = "d";
							break;
						case eregi ("d{1}",$chars[$key]):  // 'd'    = day as 1-31
							$chars[$key] = "j";
							break;
						case eregi ("y{3,}",$chars[$key]): // 'yyyy' = 4 digit year
							$chars[$key] = "Y";
							break;
						case eregi ("y{1,2}",$chars[$key]):// 'yy'   = 2 digit year
							$chars[$key] = "y";
							break;
					}
				}
				$mask = implode('',$chars);
				break;
		}
		$when = date($mask,strtotime ("$unit $time"));
		return $when;
	}

  /**
  * userErrorHandler
  * 
  * userErrorHandler
  *
  * @return userErrorHandler
  */
	function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
	{
		$dt = date("Y-m-d H:i:s (T)");
		$errortype = array (
				E_ERROR           => "Error",
				E_WARNING         => "Advertencia",
				E_PARSE           => "Error de procesamiento",
				E_NOTICE          => "Advertencia",
				E_CORE_ERROR      => "Error del motor",
				E_CORE_WARNING    => "Advertencia del motor",
				E_COMPILE_ERROR   => "Error de compilacion",
				E_COMPILE_WARNING => "Advertencia de compilacion",
				E_USER_ERROR      => "Error del usuario",
				E_USER_WARNING    => "Advertencia del usuario",
				E_USER_NOTICE     => "Advertencia del usuario",
				E_STRICT          => "Advertencia en tiempo de ejecucion"
				);
		// SET of errors for which a var trace will be saved
		$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
		$err = "<errorentry>\n";
		$err .= "\t<datetime>"      . $dt .       "</datetime>\n";
		$err .= "\t<errornum>"      . $errno .    "</errornum>\n";
		$err .= "\t<errortype>"     . $errortype[$errno] . "</errortype>\n";
		$err .= "\t<errormsg>"      . $errmsg .     "</errormsg>\n";
		$err .= "\t<scriptname>"    . $filename .   "</scriptname>\n";
		$err .= "\t<scriptlinenum>" . $linenum .    "</scriptlinenum>\n";

		if (in_array($errno, $user_errors)) 
		{
			$err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace>\n";
		}
		$err .= "</errorentry>\n\n";
		
		if (!empty($errstr) && eregi('^(sql)$', $errstr)) 
		{
			$MYSQL_ERRNO = mysql_errno();
			$MYSQL_ERROR = mysql_error();
			$err .="<errormysql>".$MYSQL_ERRNO.":".$MYSQL_ERROR."</errormysql>";
		}
		if ($errno == E_USER_ERROR || $errno == E_ERROR || $errno == E_CORE_ERROR  ||
				$errno == E_COMPILE_ERROR || $errno == mysql_errno() ) 
		{
			if(($_SESSION['parametros']['MODO_DEBUG']==1)) 
			{
				include_once("libmail.inc.php");
				$m = new Mail();
				$m->From("debug@modulosempresarios.net");
				$para = explode(',', $_SESSION['parametros']['DEBUG_MAILS']);
				$m->To($para);
				$m->Subject("SITIO: ".$_SESSION['parametros']['SITIO_NOMBRE']." / Error generado por ".$_SESSION["usuario"]." ConcesionarioID: ".($_SESSION["nivel"]>20 ? $post_concesionario : $_SESSION['concesionario']));
				$m->Body($err);
				$m->Priority(1);
				$m->Send();
			}
			die("Error procesando su requerimiento, por favor reintente o comuniquese con un operador.\n <br>".
					" Texto del error: ".$err );
		}
	}

  /**
  * loguear
  * 
  * loguear
  *
	*	@pendiente
  * @return loguear
  */
	function loguear($descripcion="") 
	{
		include_once "WEB-INF/classes/includes/Menu.class.php";
		$menu = new Menu();
    $base = new DBConnection();
    $base->connect();
  
   	if (!ereg("\\\?do=([^&]*)",$_SERVER['QUERY_STRING'],$campos))
		{
   		ereg("&do=([^&]*)&",$_SERVER['QUERY_STRING'],$campos);
		}
		$accion = $campos[1];
		$arbol = $menu->obtenerArbolPermisosAsociativo();
		$modulo = $arbol[ucwords($accion)]['modulo'];
/*		if (!empty($_SESSION['usuario']))
		{
			$sql = "SELECT * FROM mer_auditoria_accion WHERE id_auditoria_accion='$accion'";
			$base->query($sql);
			if ($base->num_rows()==0)
    	{
				$base->query("INSERT INTO mer_auditoria_accion(id_auditoria_accion,descripcion) VALUES('$accion','$accion')");
			}
    	$base->query("INSERT INTO mer_auditoria(id_usuario,fecha_hora,modulo,id_mer_auditoria_accion,descripcion) VALUES(".$_SESSION['id_usuario'].",now(),'$modulo','$accion','$descripcion')");
	  	$base->free();
		}
*/
	}

  /**
  * obtenerUsuarioSistema
  * 
  * obtenerUsuarioSistema
  *
  * @return obtenerUsuarioSistema
  */
	function obtenerUsuarioSistema()
	{
		$dir = dirname(__FILE__);
		ereg(".*\/(.*)\/public_html",$dir,$campos);
		if (!empty($campos[1]))
		{
			$usuario_sistema = $campos[1];
		}
		else
		{
			$usuario_sistema = null;
		}
		return $usuario_sistema;
	}

  /**
  * estaLogueado
  * 
  * estaLogueado
  *
  * @return estaLogueado
  */
	function estaLogueado() {
		global $enMantenimiento;

		if ( (isSet($_SESSION['usuario'])) && ($_SESSION['usuario']=="Supervisor") )
			return true;
		if ($enMantenimiento == true)
			return false;
		if(isSet($_SESSION['usuario']))
			return true;
		else
			return false;
	}

  /**
  * sitioEnMantenimiento
  * 
  * sitioEnMantenimiento
  *
  * @return sitioEnMantenimiento
  */
	function sitioEnMantenimiento() {
		global $enMantenimiento;
		return $enMantenimiento;
	}

?>
