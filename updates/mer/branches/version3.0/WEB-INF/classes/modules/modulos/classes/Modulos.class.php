<?php
/**
* Clase Módulos
* 
* Utilizada para obtener administrar las opciones de los Módulos
* @author Modulos Empresarios / Egytca
* @package mer_modulos
*/

/**
* Includes
*/
require_once("includes/DBConnection.inc.php");

/**
* Clase Módulos
* 
* Utilizada para obtener administrar las opciones de los Módulos.
* @package mer_modulos
*
*/
class Modulos {

  /**
  * Modulos
  *
  * Constructor de la clase Modulos
  *
  * Inicializa los atributos de la clase
  */
	function Modulos() {
	}

  /**
  * getModulos
  *
  * Obtiene en un array la informacion de todos los Modulos
  *
  * @return array Todos los Modulos
  */
  function getModulos() {
    $resultado = array();
		$db = new DBConnection();
    $db->connect();
    $query = "SELECT * FROM mer_modulos";
		$db->query($query);
		$resultado = $db->recordset2Array();
		return $resultado;
  }

  /**
  * getModulosActivos
  *
  * Genera un array con los Módulos Activos
  *
  * @return array Todos los Módulos Activos
  */
  function getModulosActivos() {
    $resultado = array();
		$db = new DBConnection();
    $db->connect();
    $query = "SELECT directorio,nombre FROM mer_modulos WHERE activo = 1";
		$db->query($query);
		$resultado = $db->recordset2Array();
		return $resultado;
  }

  /**
  * activaModulo
  * 
  * Actualiza como activo el módulo que recibe como parámetro
  *
  * @param	integer $id El id de el módulo
  * @return boolean true si se actualizo ok, false si no.
  */
	function activaModulo($id) {
    $resultado = array();
		$db = new DBConnection();
    $db->connect();
    $query = "UPDATE mer_modulos SET activo='1' WHERE id='$id'";
		$db->query($query);
		if($db->affected_rows() > 0) {
			return true;
		}
		else return false;
	}

  /**
  * desactivaModulo
  * 
  * Actualiza como inactivo el módulo que recibe como parámetro
  *
  * @param	integer $id El id de el módulo
  * @return boolean true si se actualizo ok, false si no.
  */
	function desactivaModulo($id) {
    $resultado = array();
		$db = new DBConnection();
    $db->connect();
    $query = "UPDATE mer_modulos SET activo='0' WHERE id='$id'";
		$db->query($query);
		if($db->affected_rows() > 0) {
			return true;
		}
		else return false;
	}

} // end of class
?>
