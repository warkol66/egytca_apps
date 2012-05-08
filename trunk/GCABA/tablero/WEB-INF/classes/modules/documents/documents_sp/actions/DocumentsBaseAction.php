<?php
/**
* DocumentsBaseAction
*
* @package documents
*/

require_once("BaseAction.php");

/**
 * Clase Basica especifica del modulo de downloads que se utiliza
 * para tener ciertos comportamientos basicos comunes a varios actions del mudulo.
 */
class DocumentsBaseAction extends BaseAction {

	function DocumentsBaseAction() {
		
		;
		
	}
	
	function documentPasswordValidation($document,$password) {
		
		require_once('DocumentPeer.php');
		
		//si el documento no esta protegido por password se le brinda acceso
		if (!$document->isPasswordProtected())
			return true;
		
		//en caso contrario se hace la verificacion de password
		return $document->checkPassword($password);
		
		
	}

}
