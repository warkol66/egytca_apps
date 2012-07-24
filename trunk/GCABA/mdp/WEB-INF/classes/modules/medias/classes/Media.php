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
		
		$medias = MediaQuery::create()->filterByMediaRelatedByAliasof($this)->find();
		foreach ($medias as $media) {
			$media->setAliasof($this->resolveAliases()->getId());
			$media->save();
		}
		
		$headlines = HeadlineQuery::create()->filterByMedia($this)->find();
		foreach ($headlines as $headline) {
			$headline->setMediaid($this->resolveAliases()->getId());
			$headline->save();
		}
		
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
	}
	
	/**
	 * Devuelve el eslabon más lejano en la cadena de aliases
	 * 
	 * @return Media Ultimo media referenciado por la cadena de aliases
	 */
	function resolveAliases($alreadyResolved = null) {
		
		if (is_null($this->getAliasof()))
			return $this;
		
		if (is_null($alreadyResolved))
			$alreadyResolved = array();
		
		if (in_array($this->getId(), $alreadyResolved))
			throw new Exception("circular reference found in aliases");
		
		$alreadyResolved[] = $this->getId();
		
		$aliasedMedia = MediaQuery::create()->findOneById($this->getAliasof());
		if (is_null($aliasedMedia))
			throw new Exception("aliasOf is not a valid ID");
		
		return $aliasedMedia->resolveAliases($alreadyResolved);
		
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
