<?php

/**
 * Class CalendarMediaPeer
 *
 * @package CalendarMedia
 */
class CalendarMediaPeer extends BaseCalendarMediaPeer {

	private $fromDate;
	private $toDate;
	private $category;
	private $mediaType;


	/**
	 * Especifica una tipo de medio para una busqueda personalizada.
	 *
	 * @param Category instancia de Category
	 */
	public function setMediaType($mediaType) {
		$this->mediaType = $mediaType;
	}

	/**
	 * Especifica una categoria para una busqueda personalizada.
	 *
	 * @param Category instancia de Category
	 */
		public function setCategory($category) {

		$this->category = $category;

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
	* Elimina un media a partir de los valores de la clave.
	*
	* @param int $id id del Calendarmedia
	*	@return boolean true si se elimino correctamente el Calendarmedia, false sino
	*/
	function delete($id) {
		$CalendarmediaObj = CalendarMediaPeer::retrieveByPK($id);
		$CalendarmediaObj->delete();

	//eliminamos el archivo correspondiente

	$path = CalendarMediaPeer::getSavePath($CalendarmediaObj->getMediaType());
	$destPath = $path . $CalendarmediaObj->getId();

	unlink($destPath);

	//si el tipo es imagen
	if ($CalendarmediaObj->getMediaType() == CalendarMediaPeer::CALENDARMEDIA_IMAGE) {
		$destPathResizes = $path .'/resizes/'. $CalendarmediaObj->getId();
		unlink($destPathResizes);
		$destPathThumbnails = $path . '/thumbnails/' .$CalendarmediaObj->getId();
		unlink($destPathThumbnails);
	}

		return true;
	}

	/**
	* Obtiene todos los medias paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los Calendarmedias
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	CalendarMediaPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"CalendarMediaPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una criteria a partir de las condiciones de filtro seteadas en el CalendarMediaPeer.
	 *
	 * @return Criteria instancia de Criteria
	 */
	public function getCriteria() {

	$criteria = new Criteria();

	$criteria->addJoin(CalendarMediaPeer::CALENDAREVENTID,CalendarEventPeer::ID,Criteria::INNER_JOIN);

	if (!empty($this->mediaType)) {
		$criteria->add(CalendarMediaPeer::MEDIATYPE,$this->mediaType);
	}

	if (!empty($this->category)) {
		$category = $this->category;
		$criteria->add(CalendarEventPeer::CATEGORYID,$category->getId());
	}

	if (!empty($this->fromDate) && ! empty($this->toDate)) {
		$criterion = $criteria->getNewCriterion(CalendarEventPeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(CalendarEventPeer::CREATIONDATE, $this->toDate, Criteria::LESS_EQUAL));
		$criteria->add($criterion);
	}
	else {

		if (!empty($this->fromDate)) {
			$criteria->add(CalendarEventPeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		}

		if (!empty($this->toDate)) {

			$criteria->add(CalendarEventPeer::CREATIONDATE,$this->toDate, Criteria::LESS_EQUAL);
		}
	}

	return $criteria;

	}

	/**
	* Obtiene todos los medias paginados aplicando la criteria de filtro.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los Calendarmedias
	*/
	public function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	CalendarMediaPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();

		$pager = new PropelPager($cond,"CalendarMediaPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Cambia el orden de un Calendarmedia en su tipo
	 * @param integer id del media a cambiar el orden
	 * @param integer nueva posicion.
	 */
	public function changeCalendarMediaOrder($mediaId,$pos) {

	try {
		$CalendarMedia = CalendarMediaPeer::get($mediaId);
		$CalendarMedia->setOrder($pos);
		$CalendarMedia->save();
	}
	catch (PropelException $exp) {
		return false;
	}

	return true;

	}

}
