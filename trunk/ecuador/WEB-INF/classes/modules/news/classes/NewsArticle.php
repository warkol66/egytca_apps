<?php

require_once 'om/BaseNewsArticle.php';
require_once('NewsArticlePeer.php');

/**
 * Skeleton subclass for representing a row from the 'news_article' table.
 *
 * Articulos de noticias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    news
 */
class NewsArticle extends BaseNewsArticle {
	
	const NOTPUBLISHED = 1;
	const PUBLISHED = 2;
	const ARCHIVED = 3;
	
	/**
	* Devuelve los estados posibles de la noticias y sus codigos 
	* para la generacion de selects
	*/
	public function getStatus() {

	$status[NewsArticle::NOTPUBLISHED] = 'No Publicada';
	$status[NewsArticle::PUBLISHED] = 'Publicada';
	$status[NewsArticle::ARCHIVED] = 'Archivada';

	return $status;
	}
	
	static function getHeaders() {
		$headers = array();
		$headers[0] = "Título";
		$headers[1] = "Fecha";
		$headers[2] = "Archivar";
		$headers[3] = "Provincia";
		$headers[4] = "Categoría";
		return $headers;
	}
	
	/**
	 * Devuelve el nombre del estado actual en que se encuentra la noticia
	 *
	 */
	public function getStatusName() {
		$status = NewsArticlePeer::getStatus();
		return $status[$this->getStatus()];
	}

	/**
	 * Obtains the medias from the article
	 * @param integer value of the media constant
	 * @return array array of instances of NewsMedia.
	 */
	private function getMedias($mediaType) {
		
		require_once("NewsMediaPeer.php");
		
		$criteria = new Criteria();	

		$criteria->add(NewsMediaPeer::MEDIATYPE,$mediaType);
		$criteria->addAscendingOrderByColumn(newsMediaPeer::ORDER);
		
		$medias = $this->getNewsMedias($criteria);
		
		return $medias;		
	}
	
	public function getVideos() {
		require_once("NewsMediaPeer.php");
		return $this->getMedias(NewsMediaPeer::NEWSMEDIA_VIDEO);
	}	
	
	public function getSounds() {
		require_once("NewsMediaPeer.php");
		return $this->getMedias(NewsMediaPeer::NEWSMEDIA_SOUND);
	}
	
	public function getImages() {
		require_once("NewsMediaPeer.php");
		return $this->getMedias(NewsMediaPeer::NEWSMEDIA_IMAGE);
	}	
	
	
	public function hasMedias($mediaType) {
		require_once("NewsMediaPeer.php");
		$criteria = new Criteria();	
		$criteria->add(NewsMediaPeer::MEDIATYPE,$mediaType);
		$mediaCount = $this->countNewsMedias($criteria);
		if ($mediaCount>0)
			return true;
		else
			return false;		
	}
	
	public function hasVideos() {
		require_once("NewsMediaPeer.php");
		return $this->hasMedias(NewsMediaPeer::NEWSMEDIA_VIDEO);
	}	

	public function hasSounds() {
		require_once("NewsMediaPeer.php");
		return $this->hasMedias(NewsMediaPeer::NEWSMEDIA_SOUND);
	}

	public function hasImages() {
		require_once("NewsMediaPeer.php");
		return $this->hasMedias(NewsMediaPeer::NEWSMEDIA_IMAGE);
	}	
	
	
	public function getFirstImage() {
		require_once("NewsMediaPeer.php");
		$criteria = new Criteria();	
		$criteria->add(NewsMediaPeer::ARTICLEID,$this->getId());		
		$criteria->add(NewsMediaPeer::MEDIATYPE,NewsMediaPeer::NEWSMEDIA_IMAGE);
		$criteria->addAscendingOrderByColumn(newsMediaPeer::ORDER);
		$image = NewsMediaPeer::doSelectOne($criteria);
		return $image;		
	}
	
	public function getFirstVideo() {
		require_once("NewsMediaPeer.php");
		$criteria = new Criteria();	
		$criteria->add(NewsMediaPeer::ARTICLEID,$this->getId());		
		$criteria->add(NewsMediaPeer::MEDIATYPE,NewsMediaPeer::NEWSMEDIA_VIDEO);
		$criteria->addAscendingOrderByColumn(newsMediaPeer::ORDER);
		$video = NewsMediaPeer::doSelectOne($criteria);
		return $video;		
	}

	function setBody($v) {
		
		return parent::setBody(stripslashes($v));
	}

	/**
	 * Genera la criteria necesaria para obtener todos los comentarios aprobados para el
	 * Articulos
	 * @return Criteria
	 */
	private function getApprovedCommentsCriteria() {
		
		require_once('NewsComment.php');
		require_once('NewsCommentPeer.php');
		
		$criteria = new Criteria();
		$criteria->add(NewsCommentPeer::ARTICLEID,$this->getId());
		$criteria->add(NewsCommentPeer::STATUS,NEWSCOMMENT_APPROVED);
		
		return $criteria;
		
	}

	/**
	 * * Obtiene los articulos aprobados que pueden ser mostrados por interfaz
	 * del articulo
	 * @return array de instancias de NewsComment
	 */ 
	public function getApprovedComments() {
		
		$criteria = $this->getApprovedCommentsCriteria();
		return NewsCommentPeer::doSelect($criteria);
		
	}
	
	/**
	 * Obtiene la cantidad de articulos aprobados que pueden ser mostrados por interfaz
	 * del articulo
	 * @return integer
	 */ 
	public function getApprovedCommentsCount() {
		
		$criteria = $this->getApprovedCommentsCriteria();
		return NewsCommentPeer::doCount($criteria);
		
	}
	
	public function delete(PropelPDO $con = null) {
		$moduleConfig = Common::getModuleConfiguration($module);
		if ($newsArticlesConfig['useComments']['value'] == "YES") {
			require_once('NewsCommentPeer.php');
			$comments = $this->getNewsComments();
			foreach ($comments as $comment) {
				$comment->delete();
			}
		}
		require_once('NewsMediaPeer.php');
		$medias = $this->getNewsMedias();
		foreach ($medias as $media) {
			$media->delete();
		}
		return parent::delete();
	}
	
	/**
	 * Sobrecarga de save para impactar en la base la ultima actulizacion del articulo
	 * al guardarlos
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 */
	public function save(PropelPDO $con = null) {
		
		$this->setLastUpdate(date('Y-m-d h:i:s'));
		parent::save($con);
		
	}

	/**
	 * Da una representacion del objeto en XHTML
	 * @param boolean indica si se quiere tambien el cuerpo de la noticia
	 * @return     String
	 */	
	public function toXHTML($fullMode=false) {
		global $system;

		$siteUrl = $system["config"]["system"]["parameters"]["siteUrl"];
		$output  = '<div class="news01">';
		$output .= "<h1><a href='".$siteUrl."/Main.php?do=newsArticlesView&id=".$this->getId()."' target='_blank'>".$this->getTitle().'</a></h1>';
		$output .= '<p>'.$this->getSummary().'</p>';
		if ($fullMode)
			$output .= '<p>'.$this->getBody().'</p>';
		$output .= "<div class='masInfo'><a href='".$siteUrl."/Main.php?do=newsArticlesView&id=".$this->getId()."' target='_blank'>Ver nota completa</a></h1>";
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	
	public function getSurvey() {

		$moduleNews= ModulePeer::get('surveys');

		if (!empty($moduleNews) && ($moduleNews->getActive() == 1)) {
			//existe el modulo de encuestas
			require_once("SurveyPeer.php");
			$criteria = new Criteria();
			$criteria->add(SurveyPeer::ARTICLEID,$this->getId());
			$result = SurveyPeer::doSelectOne($criteria);

			return $result;
			
		}
		
		return false;
		
	}
	
	/**
	 * Incrementa la cantidad de vistas que tiene el articulo
	 * y lo persiste
	 */
	public function increaseViews() {
		
		try {
			$counter = $this->getViews();
			$counter++;
			$this->setViews($counter);
			parent::save();

		} catch (PropelException $e) {
			return false;
		}

		return true;
		
	}
	
	public function toArray() {
		$array = array();
		$array[0] = $this->getTitle();
		$array[1] = $this->getCreationDate();
		$array[2] = $this->getArchiveDate();
		$region = $this->getRegion();
		if (!empty($region))
			$array[3] = $region->getName();
		else
			$array[3] = "";
		$category = $this->getCategory();
		if (!empty($category)) 
			$array[4] = $category->getName();
		else
			$array[4] = "";
		return $array;	
	}
	
	
	/**
	* Crea un Preview de una articulo.
	* Devuelve una instancia de articulo el cual no ha salvado en la base de datos.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/  
	function createPreview($params) {

	  $newsArticleObj = new NewsArticle();
	  foreach ($params as $key => $value) {
		$setMethod = "set".$key;
		if ( method_exists($newsArticleObj,$setMethod) ) {          
		  if (!empty($value) || $value == "0")
			$newsArticleObj->$setMethod($value);
		  else
			$newsArticleObj->$setMethod(null);
		}
	  }

	  return $newsArticleObj;
	}


} // NewsArticle
