<?php



/**
 * Skeleton subclass for representing a row from the 'calendar_media' table.
 *
 * Media del calendario
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarMedia extends BaseCalendarMedia{
	
	const CALENDARMEDIA_IMAGE = 1;	
	const CALENDARMEDIA_SAVEPATH = 'WEB-INF/classes/modules/calendar/files/images/';
	
	/**
	 * Devuelve los estados posibles de la eventos y sus codigos
	 * para la generacion de selects
	 */
	public function getMediaTypes() {

		$types[CalendarMedia::CALENDARMEDIA_IMAGE] = 'Imagen';

	return $status;
	}
	
	public function getMediaTypeName() {
		
		$type = $this->getMediaType();
		
		switch ($type) {
			
			case CalendarMedia::CALENDARMEDIA_IMAGE : return 'Imagen';
			
		}
		
	}
	
	public function setDescription($v) {
		parent::setDescription(stripslashes($v));
	}
	
		/**
	* Devuelve la ruta de salvado de un media. 
	*
	*
	*/
	public function getSavePath() {

		return CalendarMedia::CALENDARMEDIA_SAVEPATH;

	}
	
	/** Migrado de Peer
	* Copia la imagen del evento y crea el thumbnail.
	*
	* @param array $image Imagen
	* @param string $name Nombre
	* @return void
	*/
	function createImages($CalendarmediaObj,$image,$name) {
		global $moduleRootDir;
		
		$uploadFile = $moduleRootDir . 'WEB-INF/classes/modules/calendar/files/images/resizes/' . $name;
		copy($image['tmp_name'], $uploadFile);

		global $system;
		
		print_r($system["config"]["news"]["image"]);
		die();
		$width = $system["config"]["calendar"]["image"]["resize"]["width"];
		$height = $system["config"]["calendar"]["image"]["resize"]["height"];
		$resizeFormat = $system["config"]["calendar"]["image"]["resize"]["resizeFormat"];
		$jpegQuality = $system["config"]["news"]["image"]["jpegQuality"];
		
		echo($width);
		die();

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

		global $system;
		$width = $system["config"]["calendar"]["image"]["thumbnail"]["width"];
		$height = $system["config"]["calendar"]["image"]["thumbnail"]["height"];
		$resizeFormat = $system["config"]["calendar"]["image"]["thumbnail"]["resizeFormat"];
		$jpegQuality = $system["config"]["news"]["image"]["jpegQuality"];
		
		imagejpeg($tn, $uploadFile, 100);

		$uploadFile = 'WEB-INF/classes/modules/calendar/files/images/thumbnails/' . $name;
		copy($image['tmp_name'], $uploadFile);

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
	
	/** Migrado de peer
	 * Cambia el orden de un Calendarmedia en su tipo
	 * @param integer id del media a cambiar el orden
	 * @param integer nueva posicion.
	 */
	public function changeCalendarMediaOrder($mediaId,$pos) {

	try {
		$CalendarMedia = CalendarMediaQuery::create()->findOneById($mediaId);
		$CalendarMedia->setOrder($pos);
		$CalendarMedia->save();
	}
	catch (PropelException $exp) {
		return false;
	}

	return true;

	}
}
