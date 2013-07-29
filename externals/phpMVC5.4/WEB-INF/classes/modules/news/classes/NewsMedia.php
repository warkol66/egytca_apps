<?php

require_once 'om/BaseNewsMedia.php';


/**
 * Skeleton subclass for representing a row from the 'news_media' table.
 *
 * Media de las noticias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    news
 */
class NewsMedia extends BaseNewsMedia {
	
	const NEWSMEDIA_IMAGE = 1;
	const NEWSMEDIA_VIDEO = 2;
	const NEWSMEDIA_SOUND = 3;

	const NEWSMEDIA_SAVEPATH = 'WEB-INF/classes/modules/news/files/';
	
	/**
	* Devuelve un array con todos los tipos de media existentes y sus codigos
	*/
	public function getMediaTypes() {

	$types = array();
	$types[CalendarMedia::CALENDARMEDIA_IMAGE] = 'Imagen';

	return $types;

	}
	
	public function getMediaTypeName() {
		
		$type = $this->getMediaType();
		
		switch ($type) {
			
			case NewsMedia::NEWSMEDIA_IMAGE : return 'Imagen';
			case NewsMedia::NEWSMEDIA_VIDEO : return 'Video';
			case NewsMedia::NEWSMEDIA_SOUND : return 'Sonido';
			
		}
		
	}

		/**
	* Devuelve la ruta de salvado de un media. 
	*
	*
	*/
	public function getSavePath($type) {

	$path = NewsMedia::NEWSMEDIA_SAVEPATH;

	if ($type == NewsMedia::NEWSMEDIA_IMAGE)
		$path .= 'images/';
	if ($type == NewsMedia::NEWSMEDIA_VIDEO)
		$path .= 'videos/';
	if ($type == NewsMedia::NEWSMEDIA_SOUND)
		$path .= 'audio/';
	return $path;

	}
	
	public function setDescription($v) {
		parent::setDescription(stripslashes($v));
	}
	
	/**
	* Copia la imagen de la noticia y crea el thumbnail.
	*
	* @param array $image Imagen
	* @param string $name Nombre 
	* @return void
	*/	
	function createImages($newsmediaObj,$image,$name) {
		global $moduleRootDir;
		
		$uploadFile = $moduleRootDir . 'WEB-INF/classes/modules/news/files/images/resizes/' . $name;
		move_uploaded_file($image['tmp_name'], $uploadFile);

		global $system;	
		$width = $system["config"]["news"]["image"]["resize"]["width"];
		$height = $system["config"]["news"]["image"]["resize"]["height"];
		$resizeFormat = $system["config"]["news"]["image"]["resize"]["resizeFormat"];
		$jpegQuality = $system["config"]["news"]["image"]["jpegQuality"];

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

		$newsmediaObj->setWidth($newWidth);
		$newsmediaObj->setHeight($newHeight);
		$newsmediaObj->save();

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
		$width = $system["config"]["news"]["image"]["thumbnail"]["width"];
		$height = $system["config"]["news"]["image"]["thumbnail"]["height"];
		$resizeFormat = $system["config"]["news"]["image"]["thumbnail"]["resizeFormat"];
		$jpegQuality = $system["config"]["news"]["image"]["jpegQuality"];

		imagejpeg($tn, $uploadFile, $jpegQuality); 	

		$uploadFile = $moduleRootDir . 'WEB-INF/classes/modules/news/files/images/thumbnails/' . $name;
		move_uploaded_file($image['tmp_name'], $uploadFile);	

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

		imagejpeg($tn, $uploadFile, $jpegQuality); 	      

	}   

	/**
	* Superpone imagenes
	*
	* @param image $background Imagen de fondo 
	* @param image $foreground Imagen de sobreimpresion 
	* @return imagen superpuesta
	*/	
	function image_overlap($background, $foreground){
		$insertWidth = imagesx($foreground);
		$insertHeight = imagesy($foreground);
		
		$imageWidth = imagesx($background);
		$imageHeight = imagesy($background);
		
		$overlapX = 0;
		$overlapY = 0;
		imagecolortransparent($foreground,imagecolorat($foreground,0,0));                
		imagecopymerge($background,$foreground,$overlapX,$overlapY,0,0,$insertWidth,$insertHeight,100);   
		
		return $background;
	}
	
	/**
	* Copia el video y crea el flv.
	*
	* @param NewsMedia $newsmediaObj Objeto NewsMedia 
	* @param array $video Video
	* @param string $name Nombre 
	* @return void
	*/	
	function createVideo($newsmediaObj,$video,$name) {		
	global $moduleRootDir;

	$uploadFile = $moduleRootDir.'WEB-INF/classes/modules/news/files/videos/flv/' . $name;
	copy($video['tmp_name'], $uploadFile);	

		$parts = explode('\.',$video['name']);

		$originalExt = $parts[count($parts)-1];

	$file = $uploadFile;
	require_once 'config/videotoolkit-config.php';
	require_once 'videotoolkit/phpvideotoolkit.php5.php';

	$tmp_dir = $moduleRootDir.'WEB-INF/classes/modules/news/files/videos/tmp/';
	$video_output_dir = $moduleRootDir.'WEB-INF/classes/modules/news/files/videos/flv/';
	$video_thumbnail_output_dir = $moduleRootDir.'WEB-INF/classes/modules/news/files/videos/thumbnail/';
	$log_dir = $moduleRootDir.'WEB-INF/classes/modules/news/files/videos/logs/';		

	global $system;	
	$width = $system["config"]["news"]["video"]["resize"]["width"];
	$height = $system["config"]["news"]["video"]["resize"]["height"];
	$samprate = $system["config"]["news"]["video"]["resize"]["samprate"];
	$bitrate = $system["config"]["news"]["video"]["resize"]["bitrate"];
		$frameThumbnail = $system["config"]["news"]["video"]["frameThumbnail"];

		if ($originalExt != "flv") {

		$toolkit = new PHPVideoToolkit($tmp_dir);

		$toolkit->on_error_die = FALSE;

		$ok = $toolkit->setInputFile($file);
		if (!$ok) {
		  echo $toolkit->getLastError()."<br /><br />\r\n";
		  return;
		}		

			$toolkit->setVideoOutputDimensions($width, $height);

		//	bit rate of audio (valid vaues are 16,32,64)
		//$bitrate = 64;

		//	sampling rate (valid values are 11025, 22050, 44100)
		//$samprate = 44100;

		$toolkit->setFormatToFLV($samprate, $bitrate);

		$ok = $toolkit->setOutput($video_output_dir, $name.'.flv', PHPVideoToolkit::OVERWRITE_EXISTING);
		if (!$ok) {
		  echo $toolkit->getLastError()."<br /><br />\r\n";
		  return;
		}

		$result = $toolkit->execute(true, true);

		$command = $toolkit->getLastCommand();
	// 		echo $command[0]."<br />\r\n";
	// 		echo $command[1]."<br />\r\n";

		if ($result !== PHPVideoToolkit::RESULT_OK) {
		  $toolkit->moveLog($log_dir.$filename_minus_ext.'.log');
		  echo $toolkit->getLastError()."<br /><br />\r\n";
		  return;
		}

		$process_time = $toolkit->getLastProcessTime();
		
		$toolkit->reset();
	}

	//Creo el thumbnail
	$toolkit = new PHPVideoToolkit($tmp_dir);

	$toolkit->on_error_die = FALSE;

	$ok = $toolkit->setInputFile($file);
	if (!$ok) {
	  echo $toolkit->getLastError()."<br /><br />\r\n";
	  return;
	}		

	$toolkit->setVideoOutputDimensions($width, $height);	

	$toolkit->extractFrame($frameThumbnail);

	$ok = $toolkit->setOutput($video_thumbnail_output_dir, $newsmediaObj->getId().'.jpg', PHPVideoToolkit::OVERWRITE_EXISTING);

	if(!$ok) {
	// 			if there was an error then get it 
		echo '<b>'.$toolkit->getLastError()."</b><br />\r\n";
		$toolkit->reset();
		continue;
	}
		
	// 	execute the ffmpeg command
	$result = $toolkit->execute(false, true);	

	$toolkit->reset();

	//Load and resize the image
	$uploaded = imagecreatefromjpeg($video_thumbnail_output_dir.$newsmediaObj->getId().'.jpg');
	$image = imagecreatetruecolor($width, $height);
	imagecopyresampled($image, $uploaded, 0, 0, 0, 0, $width, $height, imagesx($uploaded), imagesy($uploaded));   
	imagealphablending($image,true); //allows us to apply a 24-bit watermark over $image

	//Load the sold watermark
	$back = imagecreatefrompng($moduleRootDir.'/img/bk320.png');
	imagealphablending($back,true);

	//Apply watermark and save
	$image = image_overlap($image, $back);
	imagecopy($image,$back,0,0,0,0,$width,$height);
	$success = imagejpeg($image,$video_thumbnail_output_dir.$newsmediaObj->getId().'.jpg',85);

	imagedestroy($image);
	imagedestroy($uploaded);
	imagedestroy($back);	

	}

	/**
	* Copia el sonido.
	*
	* @param NewsMedia $newsmediaObj Objeto NewsMedia 
	* @param array $sound Audio
	* @param string $name Nombre 
	* @return void
	*/	
	function createSound($sound,$name) {		
		global $moduleRootDir;
		$uploadFile = $moduleRootDir . 'WEB-INF/classes/modules/news/files/audio/' . $name;
		move_uploaded_file($sound['tmp_name'], $uploadFile);
	}
	
	/**
   * Cambia el orden de un newsmedia en su tipo
   * @param integer id del media a cambiar el orden
   * @param integer nueva posicion.
   */
  public function changeNewsMediaOrder($mediaId,$pos) {
	
	try {
		$newsMedia = NewsMediaQuery::create()->findOneById($mediaId);
		$newsMedia->setOrder($pos);
		$newsMedia->save();
	}
	catch (PropelException $exp) {
		return false;
	}
	
	return true;
	
  }   



} // NewsMedia
