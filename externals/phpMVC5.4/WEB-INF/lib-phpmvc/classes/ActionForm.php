<?php
class ActionForm {
	var $actionServer = NULL;
	var $multipartRequestHandler = NULL;
	function getActionServer() {
		return $this -> actionServer;
	}
	function getActionServerWrapper() {
		return NULL;
	}
	function getMultipartRequestHandler() {
		return $this -> multipartRequestHandler;
	}
	function setActionServer(&$actionServer) { $this -> actionServer = &$actionServer;
	}
	function setMultipartRequestHandler($multipartRequestHandler) { $this -> multipartRequestHandler = $multipartRequestHandler;
	}
	function reset($mapping, $request) { $this -> resetHttp($mapping, $request);
	}
	function resetHttp($mapping, $request) {;
	}
	function validate($mapping, $request) { $validate = $this -> validateHttp($mapping, $request);
		if (!$validate) {
			return NULL;
		}
		return $validate;
	}
	function validateHttp($mapping, $request) {
		return NULL;
	}
	function saveErrors(&$request, $errors) {
		if (($errors == NULL) || $errors -> isEmpty()) { $request -> removeAttribute(Action::getKey('ERROR_KEY'));
			return;
		} $request -> setAttribute(Action::getKey('ERROR_KEY'), $errors);
	}
	function saveFormBean(&$request, &$form) {
		if (($form == NULL)) { $request -> removeAttribute(Action::getKey('FORM_BEAN_KEY'));
			return;
		} $request -> setAttribute(Action::getKey('FORM_BEAN_KEY'), $form);
	}
	function saveValueObject(&$request, &$valueObject) {
		if (($valueObject == NULL)) { $request -> removeAttribute(Action::getKey('VALUE_OBJECT_KEY'));
			return;
		} $request -> setAttribute(Action::getKey('VALUE_OBJECT_KEY'), $valueObject);
	}

}
?>
