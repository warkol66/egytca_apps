<?php

/**
 * Class FormPeer
 *
 * @package Form
 */
class FormPeer extends BaseFormPeer {

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		global $system;
		return $system["config"]["system"]["rowsPerPage"];
	}

	/**
	* Crea un form nuevo.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($params) {
		try {
			$formObj = new Form();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($formObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$formObj->$setMethod($value);
					else
						$formObj->$setMethod(null);
				}
			}
			$formObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Actualiza la informacion de un form.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$formObj = FormPeer::retrieveByPK($params["id"]);
			if (empty($formObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($formObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$formObj->$setMethod($value);
					else
						$formObj->$setMethod(null);
				}
			}
			$formObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Elimina un form a partir de los valores de la clave.
	*
	* @param int $id id del form
	*	@return boolean true si se elimino correctamente el form, false sino
	*/
	function delete($id) {
		$formObj = FormPeer::retrieveByPK($id);
		$formObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un form.
	*
	* @param int $id id del form
	* @return array Informacion del form
	*/
	function get($id) {
		$formObj = FormPeer::retrieveByPK($id);
		return $formObj;
	}

	/**
	* Obtiene todos los forms.
	*
	*	@return array Informacion sobre todos los forms
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = FormPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los forms paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los forms
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	FormPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"FormPeer", "doSelect",$page,$perPage);
		return $pager;
	 }


	/**
	 * Reemplaza tags de formulario en un string.
	 * @param $unprocessedContent string
	 */
	public function processForms($unprocessedContent) {

		$splittedContent = explode("\n",$unprocessedContent);
		$processedContent = '';

		foreach ($splittedContent as $string) {
			$processedString = $string;
			$match = array();
			if (preg_match('/\{setFormId_[0-9]*\}/',$string,$match)) {
				//se encontro un match
				$processedString = $this->processMatch($match[0],$processedString);
			}

			$processedContent .= "$processedString \n";
		}

		return $processedContent;

	}

	private function processMatch($match,$processedString) {
		$result = $match;
		$matchParse = array();
		if (preg_match('/\{([a-zA-z]*)_([0-9]*)\}/',$match,$matchParse)) {
			if ($matchParse[1] == 'setFormId') {
				$id = $matchParse[2];
				$form = FormPeer::get($id);
				$replacement = $form->getContentForDisplay();
				$result = preg_replace('/\{setFormId_[0-9]*\}/',$replacement,$match);
			}

		}

		return $result;

	}

}
