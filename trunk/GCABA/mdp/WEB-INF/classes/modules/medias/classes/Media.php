<?php



/**
 * Skeleton subclass for representing a row from the 'medias_media' table.
 *
 * Archivo de medios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.medias.classes
 */
class Media extends BaseMedia {
	
	
	function preSave(PropelPDO $con = null) {
		parent::preSave($con);
		
		$aliasedMedia = $this->getMediaRelatedByAliasof();
		if (!is_null($aliasedMedia))
			$this->setAliasof($aliasedMedia->resolveAliases()->getId());
		
		return true;
	}
	
	function postSave(PropelPDO $con = null) {
		parent::postSave($con);
		
		$resolvedId = $this->resolveAliases()->getId();
		
		MediaQuery::create()->filterByMediaRelatedByAliasof($this)
			->update(array('Aliasof' => $resolvedId));
		
		HeadlineQuery::create()->filterByMedia($this)
			->update(array('Mediaid' => $resolvedId));
		

		$headlinesParsed = HeadlineParsedQuery::create()->find();
		foreach ($headlinesParsed as $headlineParsed) {
			
			/*
			 * Si tiene mediaName pero no mediaId, y el mediaName corresponde a un media
			 * existente, seteo como mediaId el id de ese media.
			 */
			if (is_null($headlineParsed->getMediaid())) {
				$mediaByName = MediaQuery::create()->findOneByName($headlineParsed->getMedianame());
				if (!is_null($mediaByName))
					$headlineParsed->setMediaid($mediaByName->getId());
			}
			
			if (!is_null($headlineParsed->getMediaid())) {
				$finalMedia = $headlineParsed->getMedia()->resolveAliases();
				$headlineParsed->setMediaid($finalMedia->getId());
				$headlineParsed->setMediaName($finalMedia->getName());
			}
			
			$headlineParsed->save();
		}

/*
$headlinesParsed = HeadlineParsedQuery::create()
		->filterByMediaid($this->getId())
	->_or()
		->filterByMedianame($this->getName())		
  ->update(array('Mediaid' => $this->resolveAliases()->getId(), 'Medianame' => $this->resolveAliases()->getName));


*/		



	}
	
	/**
	 * Devuelve el eslabon más lejano en la cadena de aliases
	 * 
	 * @return Media Ultimo media referenciado por la cadena de aliases
	 */
	function resolveAliases() {
		
		$referenced = $this;
		$alreadyResolved = array();
		while (!is_null($referenced->getAliasof())) {
			if (in_array($referenced->getId(), $alreadyResolved))
				throw new Exception("circular reference found in aliases");
			$alreadyResolved []= $referenced->getId();
			$media = MediaQuery::create()->findOneById($referenced->getAliasof());
			$referenced = $media;
		}
		
		return $referenced;
	}

 /**
	 * Devuelve el tipo de media.
	 */
	function getType(){
		return MediaTypeQuery::create()->findOneById($this->getTypeId());
	}
	
	/*
	 * Devuelve true si el media tiene el mediaMarket
	 * y false en caso contrario.
	 */
	function hasMediaMarket($mediaMarket) {
		foreach ($this->getMediaMarkets() as $associated) {
			if ($associated->getId() == $mediaMarket->getId()) {
				return true;
			}
		}
		return false;
	}
	
	/*
	 * Devuelve true si el media tiene el mediaAudience
	 * y false en caso contrario.
	 */
	function hasMediaAudience($mediaAudience) {
		foreach ($this->getMediaAudiences() as $associated) {
			if ($associated->getId() == $mediaAudience->getId()) {
				return true;
			}
		}
		return false;
	}
	
	/*
	 * Devuelve true si el media tiene el alias
	 * y false en caso contrario.
	 */
	function hasAlias($alias) {
		$associatedCount = MediaQuery::create()
			->filterByAliasof($this->getId())
			->filterById($alias->getId())
			->count();
		
		return $associatedCount > 0;
	}

} // Media
