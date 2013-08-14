<?php
class Action {
	var $defaultLocale = NULL;
	var $actionServer = NULL;
	function getKey($key) {
		switch($key) { case 'ACTION_SERVER_KEY' :
				$keyVal = 'phpmvc.action.ACTION_SERVER';
				break;
			case 'APPLICATION_KEY' :
				$keyVal = 'phpmvc.action.APPLICATION';
				break;
			case 'DATA_SOURCE_KEY' :
				$keyVal = 'phpmvc.action.DATA_SOURCE';
				break;
			case 'ERROR_KEY' :
				$keyVal = 'phpmvc.action.ERROR';
				break;
			case 'EXCEPTION_KEY' :
				$keyVal = 'phpmvc.action.EXCEPTION';
				break;
			case 'LOCALE_KEY' :
				$keyVal = 'phpmvc.action.LOCALE';
				break;
			case 'MAPPING_KEY' :
				$keyVal = 'phpmvc.action.mapping.instance';
				break;
			case 'MESSAGE_KEY' :
				$keyVal = 'phpmvc.action.ACTION_MESSAGE';
				break;
			case 'MESSAGES_KEY' :
				$keyVal = 'phpmvc.action.MESSAGES';
				break;
			case 'MULTIPART_KEY' :
				$keyVal = 'phpmvc.action.mapping.multipartclass';
				break;
			case 'APP_SERVER_KEY' :
				$keyVal = 'phpmvc.action.APP_SERVER_MAPPING';
				break;
			case 'TRANSACTION_TOKEN_KEY' :
				$keyVal = 'phpmvc.action.TOKEN';
				break;
			case 'FORM_BEAN_KEY' :
				$keyVal = 'phpmvc.action.FORM_BEAN';
				break;
			case 'VALUE_OBJECT_KEY' :
				$keyVal = 'phpmvc.action.VALUE_OBJECT';
				break;
			default :
				$keyVal = 'phpmvc.action.ERROR_KEY_NOT_FOUND';
		}
		return $keyVal;
	}
	function & getActionServer() {
		return $this -> actionServer;
	}
	function setActionServer(&$actionServer) { $this -> actionServer = &$actionServer;
	}
	function execute($mapping, $form, &$request, &$response) {
		return NULL;
	}
	function saveErrors(&$request, $errors) {
		if (($errors == NULL) || $errors -> isEmpty()) { $request -> removeAttribute($this -> getKey('ERROR_KEY'));
			return;
		} $request -> setAttribute($this -> getKey('ERROR_KEY'), $errors);
	}
	function saveFormBean(&$request, &$form) {
		if (($form == NULL)) { $request -> removeAttribute($this -> getKey('FORM_BEAN_KEY'));
			return;
		} $request -> setAttribute($this -> getKey('FORM_BEAN_KEY'), $form);
	}
	function saveValueObject(&$request, &$valueObject) {
		if (($valueObject == NULL)) { $request -> removeAttribute($this -> getKey('VALUE_OBJECT_KEY'));
			return;
		} $request -> setAttribute($this -> getKey('VALUE_OBJECT_KEY'), $valueObject);
	}

}
?>
