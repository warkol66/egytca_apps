<?php



/**
 * Skeleton subclass for representing a row from the 'headlines_parsed' table.
 *
 * Headline parsed
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineParsed extends BaseHeadlineParsed {
    
    const STATUS_IDLE       = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_PROCESSED  = 3;
    const STATUS_DISCARDED  = 4;
    
	/**
	 * Crea un nuevo Headline a partir del HeadlineParsed y cambia el estado del HeadlineParsed a procesado.
	 * 
	 * @return \Headline 
	 */
	function accept() {
		
		$newHeadline = new Headline();
		$newHeadline->fromJSON($this->toJSON());
		$newHeadline->setId(NULL);
		$newHeadline->buildInternalId();
		
		$headlineExist = HeadlineQuery::create()->findOneByInternalid($newHeadline->getInternalId());
		if ($headlineExist)
			throw new Exception('headline already exists!');
		else
			$newHeadline->save();

		if ($this->getCampaignid()) {
			//Creo el clipping
			require_once('WebkitHtmlRenderer.php');
			$url = $newHeadline->getUrl();
			$imagePath = ConfigModule::get('headlines', 'clippingsPath');
			if (!file_exists($imagePath))
				mkdir ($imagePath, 0777, true);

			$imageFullname = realpath($imagePath) . "/" . $newHeadline->getId() . ".jpg";

			$renderer = new WebkitHtmlRenderer();
			$renderer->render($url, $imageFullname, true, true);
			//Fin clipping
		} else {
			require_once('AutoDownloader.php');
			$attachmentsPath = ConfigModule::get('headlines', 'clippingsPath');
			if (!file_exists($attachmentsPath))
				mkdir ($attachmentsPath, 0777, true);
			if (!file_exists($attachmentsPath))
				throw new Exception("No se pudo crear el directorio $attachmentsPath. Verifique la configuración de permisos.");

			$downloader = new AutoDownloader();
			foreach ($this->getHeadlineParsedAttachments() as $attachment) {
				$newAttachmentName = $newHeadline->getId().'-'.uniqid();
				$newAttachmentFullname = realpath($attachmentsPath)."/".$newAttachmentName;
				$newAttachmentSecondaryDataName = "r-".$newAttachmentName;
				$newAttachment = new HeadlineAttachment();
				$newAttachment->setName($newAttachmentName);
				$newAttachment->setUrl($attachment->getUrl());
				$newAttachment->setLength($attachment->getLength());
				$newAttachment->setType($attachment->getType());
				$newAttachment->setSecondaryDataName($newAttachmentSecondaryDataName);
				
				$newHeadline->addHeadlineAttachment($newAttachment);
				$newHeadline->save();
				
				$mustResample = $newAttachment->getType() == 'image/jpg' ? true : false;
				$downloader->putInQueue($newAttachment, $mustResample);
			}
		}

		$this->setStatus(HeadlineParsedQuery::STATUS_PROCESSED);
		$this->save();

		return $newHeadline;
	}

    /**
     * Antes de guardar un objeto HeadlineParsed nuevo lo dejamos en estado IDLE.
     * 
     * @param   PropelPDO $con
     * @return  boolean
     */
    public function preInsert(PropelPDO $con = null) {
        $this->setStatus(HeadlineParsedQuery::STATUS_IDLE);
        return true;
    }
    
    /**
     * sets internalid to a hash made from $string
     * @param string $string 
     */
    public function setInternalIdFromString($string) {
	    $hash = md5($string);
	    $this->setInternalid($hash);
    }
    
} // HeadlineParsed
