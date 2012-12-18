<?php

// The parent class
require_once 'om/BaseNewsMediaPeer.php';

// The object class
include_once 'NewsMedia.php';

/**
 * Class NewsMediaPeer
 *
 * @package NewsMedia
 */
class NewsMediaPeer extends BaseNewsMediaPeer {

	const NEWSMEDIA_IMAGE = 1;
	const NEWSMEDIA_VIDEO = 2;
	const NEWSMEDIA_SOUND = 3;

	const NEWSMEDIA_SAVEPATH = 'WEB-INF/classes/modules/news/files/';

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
	$types[NewsMediaPeer::NEWSMEDIA_IMAGE] = 'Imagen';
	$types[NewsMediaPeer::NEWSMEDIA_VIDEO] = 'Video';
	$types[NewsMediaPeer::NEWSMEDIA_SOUND] = 'Sonido';
	
	return $types;
	
  }
  
  /**
   * Devuelve la ruta de salvado de un media. 
   *
   *
   */
  private function getSavePath($type) {

	$path = NewsMediaPeer::NEWSMEDIA_SAVEPATH;

  	if ($type == NewsMediaPeer::NEWSMEDIA_IMAGE)
		$path .= 'images/';
  	if ($type == NewsMediaPeer::NEWSMEDIA_VIDEO)
		$path .= 'videos/';
  	if ($type == NewsMediaPeer::NEWSMEDIA_SOUND)
		$path .= 'audio/';
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
      $newsmediaObj = new NewsMedia();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsmediaObj,$setMethod) ) {          
          if (!empty($value) || $value == "0")
            $newsmediaObj->$setMethod($value);
          else
            $newsmediaObj->$setMethod(null);
        }
      }
      $newsmediaObj->save();
    } catch (Exception $exp) {
		return false;
    }

	//se creo el objeto con exito, guardamos el archivo.
	$destPath = NewsMediaPeer::getSavePath($newsmediaObj->getMediaType());
	$destPath .= $newsmediaObj->getId();

  //si el tipo es imagen
  if ($params["mediaType"] == NewsMediaPeer::NEWSMEDIA_IMAGE && !empty($file['tmp_name'])) {
    NewsMediaPeer::createImages($newsmediaObj,$file,$newsmediaObj->getId()); 
  }
  
  //si el tipo es video
  if ($params["mediaType"] == NewsMediaPeer::NEWSMEDIA_VIDEO && !empty($file['tmp_name'])) {
    NewsMediaPeer::createVideo($newsmediaObj,$file,$newsmediaObj->getId().".flv"); 
  }  
  
  //si el tipo es audio
  if ($params["mediaType"] == NewsMediaPeer::NEWSMEDIA_SOUND && !empty($file['tmp_name'])) {
    NewsMediaPeer::createSound($newsmediaObj,$file,$newsmediaObj->getId().".mp3"); 
  }   

  global $system;
  
  $saveOriginalFiles = $system["config"]["news"]["medias"]["saveOriginalFiles"]["value"];
  
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
      $newsmediaObj = NewsMediaPeer::retrieveByPK($params["id"]);    
      if (empty($newsmediaObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsmediaObj,$setMethod) ) {          
          if (!empty($value) || $value == "0")
            $newsmediaObj->$setMethod($value);
          else
            $newsmediaObj->$setMethod(null);
        }
      }
      $newsmediaObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un media a partir de los valores de la clave.
	*
  * @param int $id id del newsmedia
	*	@return boolean true si se elimino correctamente el newsmedia, false sino
	*/
  function delete($id) {
  	$newsmediaObj = NewsMediaPeer::retrieveByPK($id);
    $newsmediaObj->delete();

	//eliminamos el archivo correspondiente
	
	$path = NewsMediaPeer::getSavePath($newsmediaObj->getMediaType());
	$destPath = $path . $newsmediaObj->getId();
	
	unlink($destPath);
  
  //si el tipo es imagen
  if ($newsmediaObj->getMediaType() == NewsMediaPeer::NEWSMEDIA_IMAGE) {    
    $destPathResizes = $path .'/resizes/'. $newsmediaObj->getId();
    unlink($destPathResizes);
    $destPathThumbnails = $path . '/thumbnails/' .$newsmediaObj->getId();
    unlink($destPathThumbnails);
  }

  //si el tipo es video
  if ($newsmediaObj->getMediaType() == NewsMediaPeer::NEWSMEDIA_VIDEO) {
    $destPathFlv = $path .'/flv/' . $newsmediaObj->getId(). '.flv';
    unlink($destPathFlv);
    $destPathThumbnails = $path . '/thumbnails/' .$newsmediaObj->getId(). '.jpg';
    unlink($destPathThumbnails);
  }  

  //si el tipo es audio
  if ($newsmediaObj->getMediaType() == NewsMediaPeer::NEWSMEDIA_SOUND) {
    global $moduleRootDir;
    $destPathMp3 = $moduleRootDir.'audio/' . $newsmediaObj->getId() . '.mp3';
    unlink($destPathMp3);
  }   
  
		return true;
  }

  /**
  * Obtiene la informacion de un media.
  *
  * @param int $id id del newsmedia
  * @return array Informacion del newsmedia
  */
  function get($id) {
		$newsmediaObj = NewsMediaPeer::retrieveByPK($id);
    return $newsmediaObj;
  }

  /**
  * Obtiene todos los medias.
	*
	*	@return array Informacion sobre todos los newsmedias
  */
	function getAll($articleId = null) {
		$cond = new Criteria();
		
		if (!empty($articleId))
			$cond->add(NewsMediaPeer::ARTICLEID,$articleId);
		
		$alls = NewsMediaPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los medias paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsmedias
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsMediaPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsMediaPeer", "doSelect",$page,$perPage);
    return $pager;
   }

  /**
   * Crea una criteria a partir de las condiciones de filtro seteadas en el NewsMediaPeer.
   *
   * @return Criteria instancia de Criteria
   */
  public function getCriteria() {
	
	$criteria = new Criteria();
	
	$criteria->addJoin(NewsMediaPeer::ARTICLEID,NewsArticlePeer::ID,Criteria::INNER_JOIN);
	
	if (!empty($this->mediaType)) {
		$criteria->add(NewsMediaPeer::MEDIATYPE,$this->mediaType);
	}
	
	if (!empty($this->category)) {
		$category = $this->category;
		$criteria->add(NewsArticlePeer::CATEGORYID,$category->getId());
	}
	
	if (!empty($this->fromDate) && ! empty($this->toDate)) {
		$criterion = $criteria->getNewCriterion(NewsArticlePeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(NewsArticlePeer::CREATIONDATE, $this->toDate, Criteria::LESS_EQUAL));
		$criteria->add($criterion);
	}
	else {
		
		if (!empty($this->fromDate)) {
			$criteria->add(NewsArticlePeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		}
		
		if (!empty($this->toDate)) {
			
			$criteria->add(NewsArticlePeer::CREATIONDATE,$this->toDate, Criteria::LESS_EQUAL);
		}
	}
	
	return $criteria;
	
  }

  /**
  * Obtiene todos los medias paginados aplicando la criteria de filtro.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsmedias
  */
  public function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsMediaPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = $this->getCriteria();
   
    $pager = new PropelPager($cond,"NewsMediaPeer", "doSelect",$page,$perPage);
    return $pager;
   }

  /**
  * Copia la imagen de la noticia y crea el thumbnail.
  *
  * @param array $image Imagen
  * @param string $name Nombre 
  * @return void
  */	
  function createImages($newsmediaObj,$image,$name) {		
    $uploadFile = 'WEB-INF/classes/modules/news/files/images/resizes/' . $name;
    copy($image['tmp_name'], $uploadFile);	

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

    $uploadFile = 'WEB-INF/classes/modules/news/files/images/thumbnails/' . $name;
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

    $uploadFile = $moduleRootDir.'/WEB-INF/classes/modules/news/files/videos/flv/' . $name;
    copy($video['tmp_name'], $uploadFile);	

		$parts = explode('\.',$video['name']);

		$originalExt = $parts[count($parts)-1];

    $file = $uploadFile;
    require_once 'config/videotoolkit-config.php';
    require_once 'videotoolkit/phpvideotoolkit.php5.php';
	
    $tmp_dir = $moduleRootDir.'/WEB-INF/classes/modules/news/files/videos/tmp/';
    $video_output_dir = $moduleRootDir.'/WEB-INF/classes/modules/news/files/videos/flv/';
		$video_thumbnail_output_dir = $moduleRootDir.'/WEB-INF/classes/modules/news/files/videos/thumbnail/';
    $log_dir = $moduleRootDir.'/WEB-INF/classes/modules/news/files/videos/logs/';		

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
	$image = NewsMediaPeer::image_overlap($image, $back);
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
  function createSound($newsmediaObj,$sound,$name) {		
    global $moduleRootDir;
    $uploadFile = $moduleRootDir.'audio/' . $name;
    $result = copy($sound['tmp_name'], $uploadFile);		
  }        
  
  
  /**
   * Cambia el orden de un newsmedia en su tipo
   * @param integer id del media a cambiar el orden
   * @param integer nueva posicion.
   */
  public function changeNewsMediaOrder($mediaId,$pos) {
	
	try {
		$newsMedia = NewsMediaPeer::get($mediaId);
		$newsMedia->setOrder($pos);
		$newsMedia->save();
	}
	catch (PropelException $exp) {
		return false;
	}
	
	return true;
	
  }

}
