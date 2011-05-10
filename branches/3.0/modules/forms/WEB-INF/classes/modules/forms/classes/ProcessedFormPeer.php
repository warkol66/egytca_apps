<?php

/**
 * Class ProcessedFormPeer
 *
 * @package ProcessedForm
 */
class ProcessedFormPeer extends BaseProcessedFormPeer {

	/**
	 * Especifica una cadena de busqueda. Cada palabra de la cadena sera extraida y buscada en
	 * titulos, descripcion, copete, etc.
	 * @param string cadena de busqueda.
	 */
	public function setForm($form) {
		$this->form = $form;
	}

	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setFromDate($fromDate) {

		$this->fromDate = $fromDate;

	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setToDate($toDate) {

		$this->toDate = $toDate;

	}


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
	* Crea un processedform nuevo.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($params) {
		try {
			$processedformObj = new ProcessedForm();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($processedformObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$processedformObj->$setMethod($value);
					else
						$processedformObj->$setMethod(null);
				}
			}
			$processedformObj->save();
			return $processedformObj;
		} catch (Exception $exp) {
			return false;
		}
	}

	public function createFromPOST($form,$postvars) {

		$information = '';
		$senderText = $form->getSenderEmailField();
		if (!empty($senderText))
			$information .= '<p>'.$senderText.'</p>';

		$dom = new DomDocument();
		$dom->loadHTML('<html><body>'.$form->getContent().'</body></html>');
		$labels = $dom->getElementsByTagName("label");

		//procesamiento de form
		foreach (array_keys($postvars) as $key) {
			if ($key != 'do' && $key != 'formId' && $key != 'captcha') {

				$label = '';

				foreach ($labels as $labelElement)
					if ($labelElement->getAttribute('for') == $key)
						$label = $labelElement->nodeValue;

				if (empty($label))
					$label = $key;

				if (substr($key, 0, 7)=="doBreak")
					$information .= "<br /><hr /><br />";
				else if (substr($key, 0, 4)=="doBr")
					$information .= "<br /><br />";
				else
					$information .= "<strong>" . ucfirst($label) . ':</strong> ' . $postvars[$key] . "<br />";
			}
		}

		$processedForm = array();
		$processedForm['formId'] = $form->getid();
		$processedForm['formFillingDate'] = time();
		$processedForm['ip'] = $_SERVER['REMOTE_ADDR'];
		$processedForm['processedContent'] = $information;

		if (!empty($postvars['email']))
			$processedForm['destinationEmail'] = $postvars['email'];

		return ProcessedFormPeer::create($processedForm);

	}

	public function createFromPOSTDOM($form,$postvars) {

		$information = '';
		$senderText = $form->getSenderEmailField();
		if (!empty($senderText))
			$information .= '<p>'.$senderText.'</p>';
		$classDef = file_get_contents('css/styleForm.css');
		$dom = new DomDocument();
		$dom->loadHTML('<html><head><style type="text/css"><!--'.$classDef.'--></style></head><body><p></p>'.$form->getContent().'</body></html>');

		$node = $dom->getElementsByTagName('p')->item(0);
		$element = $dom->createElement('p', $senderText);
		$element->setAttribute('class','senderText');
		$node->parentNode->replaceChild($element,$node);



		foreach (array_keys($postvars) as $key) {

			if ($key != 'do' && $key != 'formId' && $key != 'captcha'){
				foreach ($dom->getElementsByTagName("input") as $node)
					if ($node->getAttribute('name') == $key && $node->getAttribute('type') != "hidden" && $node->getAttribute('type') != 'checkbox'){
						if ($node->getAttribute('type') == "radio" && $node->getAttribute('value') == $postvars[$key]) {
							$element = $dom->createElement('span', $postvars[$key]);
							$element->setAttribute('class','formAnswer');
							$node->parentNode->replaceChild($element, $node);
						}
						else if ($node->getAttribute('type') != "radio" && $node->getAttribute('type') != 'checkbox') {
							$element = $dom->createElement('span', $postvars[$key]);
							$element->setAttribute('class','formAnswer');
							$node->parentNode->replaceChild($element, $node);
						}
					}
				foreach ($dom->getElementsByTagName("textarea") as $node)
					if ($node->getAttribute('name') == $key && $node->getAttribute('type') != "hidden"){
						$element = $dom->createElement('span', $postvars[$key]);
						$element->setAttribute('class','formAnswer');
						$node->parentNode->replaceChild($element, $node);
					}
				foreach ($dom->getElementsByTagName("select") as $node)
					if ($node->getAttribute('name') == $key && $node->getAttribute('type') != "hidden"){
						$element = $dom->createElement('span', $postvars[$key]);
						$element->setAttribute('class','formAnswer');
						$node->parentNode->replaceChild($element, $node);
				}

				foreach ($dom->getElementsByTagName("input") as $node)
					if ($node->getAttribute('name') == $key && $node->getAttribute('type') == "checkbox"){
						$element = $dom->createElement('span', $postvars[$key]);
						$element->setAttribute('class','formAnswer');
						foreach ($dom->getElementsByTagName("label") as $label)
							if ($label->getAttribute('for') == $key)
								$label->parentNode->removeChild($label);
						$node->parentNode->replaceChild($element, $node);
				}
			}
		}

		//Lo siguiente es para remover los labels vacios y radio sin respuesta, pero hay que hacerlo varias veces
		//porque al tener varios hijos con el mismo nombre, el foreach parece no hacerlo bien en un solo ciclo.
		for($i = 0; $i < 10; $i++){

			foreach ($dom->getElementsByTagName("label") as $node)
				if ($node->hasAttribute('for') === FALSE)
					$node->parentNode->removeChild($node);

			foreach ($dom->getElementsByTagName("input") as $node)
				if ($node->getAttribute('type') == 'radio')
					$node->parentNode->removeChild($node);
				else if ($node->getAttribute('type') == 'checkbox') {
					foreach ($dom->getElementsByTagName("label") as $label)
						if ($label->getAttribute('for') == $node->getAttribute('name'))
							$label->parentNode->removeChild($label);
					$node->parentNode->removeChild($node);
				}
		}
		$information = $dom->saveHTML();

		//Elimino el js
		$splittedContent = explode("\n",$information);
		$processedContent = '';
		$jsFound = 0;
		foreach ($splittedContent as $string) {
			if (preg_match('/<script type="text\/javascript">/i',$string) || preg_match('\<\/script>/i',$string))
				$jsFound++;
			if (!$jsFound & 1)
				$processedContent .= "$string\n";
		}

		$processedForm = array();
		$processedForm['formId'] = $form->getid();
		$processedForm['formFillingDate'] = time();
		$processedForm['ip'] = $_SERVER['REMOTE_ADDR'];
		$processedForm['processedContent'] = $processedContent;

		if (!empty($postvars['email'])) {
			$processedForm['destinationEmail'] = $postvars['email'];
		}

		return ProcessedFormPeer::create($processedForm);

	}

	/**
	* Actualiza la informacion de un processedform.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$processedformObj = ProcessedFormPeer::retrieveByPK($params["id"]);
			if (empty($processedformObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($processedformObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$processedformObj->$setMethod($value);
					else
						$processedformObj->$setMethod(null);
				}
			}
			$processedformObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Elimina un processedform a partir de los valores de la clave.
	*
	* @param int $id id del processedform
	*	@return boolean true si se elimino correctamente el processedform, false sino
	*/
	function delete($id) {
		$processedformObj = ProcessedFormPeer::retrieveByPK($id);
		$processedformObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un processedform.
	*
	* @param int $id id del processedform
	* @return array Informacion del processedform
	*/
	function get($id) {
		$processedformObj = ProcessedFormPeer::retrieveByPK($id);
		return $processedformObj;
	}

	/**
	* Obtiene todos los processedforms.
	*
	*	@return array Informacion sobre todos los processedforms
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = ProcessedFormPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los processedforms paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los processedforms
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	ProcessedFormPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"ProcessedFormPeer", "doSelect",$page,$perPage);
		return $pager;
	 }


	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();

		if (!empty($this->fromDate) && ! empty($this->toDate)) {

			$criterion = $criteria->getNewCriterion(ProcessedFormPeer::FORMFILLINGDATE, $this->fromDate, Criteria::GREATER_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(ProcessedFormPeer::FORMFILLINGDATE, date("Y-m-d H:i:s", strtotime($this->toDate . " +1 day")), Criteria::LESS_EQUAL));
			$criteria->add($criterion);
		}
		else {

			if (!empty($this->fromDate))
				$criteria->add(ProcessedFormPeer::FORMFILLINGDATE, $this->fromDate, Criteria::GREATER_EQUAL);

			if (!empty($this->toDate))
				$criteria->add(ProcessedFormPeer::FORMFILLINGDATE, date("Y-m-d H:i:s", strtotime($this->toDate . " +1 day")), Criteria::LESS_EQUAL);
		}

		if (!empty($this->form)) {
			$form = $this->form;
			$criteria->add(ProcessedFormPeer::FORMID,$form->getId());
		}

		return $criteria;

	}

	/**
	* Obtiene todos los noticias paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los newsarticles
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	ProcessedFormPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"ProcessedFormPeer", "doSelect",$page,$perPage);
		return $pager;
	 }


}





