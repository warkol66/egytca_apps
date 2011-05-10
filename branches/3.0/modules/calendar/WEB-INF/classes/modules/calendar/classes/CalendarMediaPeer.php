<?php

/**
 * Class CalendarMediaPeer
 *
 * @package CalendarMedia
 */
class CalendarMediaPeer extends BaseCalendarMediaPeer {

	const CALENDARMEDIA_IMAGE = 1;

	const CALENDARMEDIA_SAVEPATH = 'WEB-INF/classes/modules/calendar/files/';

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
	 * Devuelve un array con todos los tipos de media existentes y sus codigos
	 */
	public function getMediaTypes() {

	$types = array();
	$types[CalendarMediaPeer::CALENDARMEDIA_IMAGE] = 'Imagen';

	return $types;

	}

	/**
	 * Devuelve la ruta de salvado de un media.
	 *
	 *
	 */
	private function getSavePath($type) {

	$path = CalendarMediaPeer::CALENDARMEDIA_SAVEPATH;

		if ($type == CalendarMediaPeer::CALENDARMEDIA_IMAGE)
		$path .= 'images/';

	return $path;

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
	* Crea un media nuevo.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @param archivo temporal en el servidor a ser copiado
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($params,$file) {
		try {
			$CalendarmediaObj = new CalendarMedia();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($CalendarmediaObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$CalendarmediaObj->$setMethod($value);
					else
						$CalendarmediaObj->$setMethod(null);
				}
			}
			$CalendarmediaObj->save();
		} catch (Exception $exp) {
		return false;
		}

	//se creo el objeto con exito, guardamos el archivo.
	$destPath = CalendarMediaPeer::getSavePath($CalendarmediaObj->getMediaType());
	$destPath .= $CalendarmediaObj->getId();

	//si el tipo es imagen
	if ($params["mediaType"] == CalendarMediaPeer::CALENDARMEDIA_IMAGE && !empty($file['tmp_name'])) {
		CalendarMediaPeer::createImages($CalendarmediaObj,$file,$CalendarmediaObj->getId());
	}

	 global $system;

	$saveOriginalFiles = $system["config"]["calendar"]["medias"]["saveOriginalFiles"]["value"];

	if ($saveOriginalFiles == "YES")
			return copy($file["tmp_name"],$destPath);
	else
			return true;

	}


	/**
	* Actualiza la informacion de un media.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$CalendarmediaObj = CalendarMediaPeer::retrieveByPK($params["id"]);
			if (empty($CalendarmediaObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($CalendarmediaObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$CalendarmediaObj->$setMethod($value);
					else
						$CalendarmediaObj->$setMethod(null);
				}
			}
			$CalendarmediaObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
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
	* Obtiene la informacion de un media.
	*
	* @param int $id id del Calendarmedia
	* @return array Informacion del Calendarmedia
	*/
	function get($id) {
		$CalendarmediaObj = CalendarMediaPeer::retrieveByPK($id);
		return $CalendarmediaObj;
	}

	/**
	* Obtiene todos los medias.
	*
	*	@return array Informacion sobre todos los Calendarmedias
	*/
	function getAll($calendarEventId = null) {
		$cond = new Criteria();

		if (!empty($calendarEventId))
			$cond->add(CalendarMediaPeer::CALENDAREVENTID,$calendarEventId);

		$alls = CalendarMediaPeer::doSelect($cond);
		return $alls;
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
	* Copia la imagen del evento y crea el thumbnail.
	*
	* @param array $image Imagen
	* @param string $name Nombre
	* @return void
	*/
	function createImages($CalendarmediaObj,$image,$name) {
		$uploadFile = 'WEB-INF/classes/modules/calendar/files/images/resizes/' . $name;
		copy($image['tmp_name'], $uploadFile);

		global $system;
		$width = $system["config"]["calendar"]["image"]["resize"]["width"];
		$height = $system["config"]["calendar"]["image"]["resize"]["height"];
		$resizeFormat = $system["config"]["calendar"]["image"]["resize"]["resizeFormat"];

		$file = $uploadFile;

		$info = getimagesize($file);
		$actualWidth = $info[0];
		$actualHeight = $info[1];
		$mime_type = $info['mime'];

		switch ($resizeFormat) {
			case "1":
				$newWidth = $width;
				$newHeight = $height;
				break;
			case "2":
				$newHeight = $height;
				$perc = $newHeight / $actualHeight;
				$newWidth = $actualWidth * $perc;
				break;
			case "3":
				$newWidth = $width;
				$perc = $newWidth / $actualWidth;
				$newHeight = $actualHeight * $perc;
				break;
			case "4":
				$newHeight = $height;
				$newWidth = $width;
				$percWidth = $newWidth / $actualWidth;
				$percHeight = $newHeight / $actualHeight;
				$perc = min($percWidth, $percHeight);
				$newHeight = $actualHeight * $perc;
				$newWidth = $actualWidth * $perc;
				break;
		}

		$CalendarmediaObj->setWidth($newWidth);
		$CalendarmediaObj->setHeight($newHeight);
		$CalendarmediaObj->save();

		$tn = imagecreatetruecolor($newWidth, $newHeight);

		switch ($mime_type) {
			case "image/jpeg":
				$newImage = imagecreatefromjpeg($file);
				break;
			case "image/png":
				$newImage = imagecreatefrompng($file);
				break;
			case "image/gif":
				$newImage = imagecreatefromgif($file);
				break;
		}

		imagecopyresampled($tn, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $actualWidth, $actualHeight);

		imagejpeg($tn, $uploadFile, 100);

		$uploadFile = 'WEB-INF/classes/modules/calendar/files/images/thumbnails/' . $name;
		copy($image['tmp_name'], $uploadFile);

		global $system;
		$width = $system["config"]["calendar"]["image"]["thumbnail"]["width"];
		$height = $system["config"]["calendar"]["image"]["thumbnail"]["height"];
		$resizeFormat = $system["config"]["calendar"]["image"]["thumbnail"]["resizeFormat"];

		$file = $uploadFile;
		list($actualWidth, $actualHeight) = getimagesize($file);

		switch ($resizeFormat) {
			case "1":
				$newWidth = $width;
				$newHeight = $height;
				break;
			case "2":
				$newHeight = $height;
				$perc = $newHeight / $actualHeight;
				$newWidth = $actualWidth * $perc;
				break;
			case "3":
				$newWidth = $width;
				$perc = $newWidth / $actualWidth;
				$newHeight = $actualHeight * $perc;
				break;
		}

		$tn = imagecreatetruecolor($newWidth, $newHeight);

		switch ($mime_type) {
			case "image/jpeg":
				$newImage = imagecreatefromjpeg($file);
				break;
			case "image/png":
				$newImage = imagecreatefrompng($file);
				break;
		}

		imagecopyresampled($tn, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $actualWidth, $actualHeight);

		imagejpeg($tn, $uploadFile, 100);

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
