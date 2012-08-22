<?php

class HeadlineFeedParser {
	
	protected $class;
	private $debugging;
	private $debugInfo;
	
	public function __construct($class = 'Headline') {
		$this->class = $class;
		$this->debugging = false;
	}
	
	function parse($uri) {
		
		$xmlData = file_get_contents($uri);
		if (!$xmlData)
			throw new Exception("no se pudo leer $uri");
		$parsedData = new SimpleXMLElement($xmlData);
		
		if ($this->debugging) {
			$this->debugInfo['fields'] = array();
		}
		
		$headlines = array();
		foreach ($parsedData->channel->item as $item) {
			
			$headline = new HeadlineParsed();
			$classKey = constant('HeadlinePeer::CLASSKEY_'.strtoupper($this->class));
			if (!is_null($classKey))
				$headline->setClassKey($classKey);
			else
				throw new Exception('classKey for '.$this->class.' doesn\'t exist');
			
			foreach ($item as $key => $value) {
				if ($this->addInfoToHeadline($headline, $key, $value)) {
					if ($this->debugging) {
						$this->debugInfo['fields'][$key] = 'found';
					}
				} else {
					if ($this->debugging) {
						$this->debugInfo['fields'][$key] = 'not found ***************';
					}
					// TODO: avisar que hay datos en desuso
				}
			}

			$media = MediaQuery::create()->findOneByName($headline->getMedianame());
			if (!empty($media)) {
				$media = $media->resolveAliases();
				$headline->setMediaId($media->getId());
			}
			
//                    ->setCampaignid($this->campaignId)
//                    ->setHeadlinedate($parsedNews['timestamp'])
//                    ->setKeywords($this->getSanitizedKeywords())
//                    ->setStrategy($parsedNews['strategy'])
			
			// TODO: if $headline is valid
			$headlines []= $headline;
		}
		
		return $headlines;
	}
	
	private function addInfoToHeadline($headline, $name, $value) {
		switch ($name) {
			case ('title'): $headline->setName($value); return true;
			case ('description'): $headline->setContent($value); return true;
			case ('link'): $headline->setUrl($value); return true;
			case ('pubDate'): $headline->setDatePublished($value); return true;
			case ('page'): $headline->setPage($value); return true;
			case ('section'): $headline->setSection($value); return true;
			case ('abstract'): $headline->setSummary($value); return true;
			case ('caption'): $headline->setCaption($value); return true;
			case ('category'): $this->parseMedianameAndProgram($headline, $value); return true;
			case ('guid'): $headline->setInternalIdFromString($value); return true;
			case ('author'): $headline->setAuthor($value); return true;
			case ('source'): $headline->setSource($value); return true;
			case ('lastChangeDate'): return false;//$headline->???($value); return true;
			case ('comments'): return false;//$headline->???($value); return true;
			case ('enclosure'): $this->addEnclosureToHeadline($headline, $value); return true;
			default: break;
		}
		return false;
	}
	
	private function addEnclosureToHeadline($headline, $value) {
		$attributes = $value->attributes();
		
		$attachment = new HeadlineParsedAttachment();
		
		$attachment->setLength($attributes->length);
		$attachment->setType($attributes->type);
		$attachment->setPath($attributes->url);
		
		$headline->addHeadlineParsedAttachment($attachment);
	}
	
	private function parseMedianameAndProgram($headline, $value) {
		$data = preg_split('/ - /', $value);
		$headline->setMedianame($data[0]);
		if (count($data) > 1)
			$headline->setProgram($data[1]);
	}
	
	public function debugMode($status = true) {
		$this->debugging = $status;
		return $this;
	}
	
	public function printDebugInfo($return = false) {
		if (!$this->debugging)
			throw new Exception('must start debug first!! ($parser->debugMode(true))');

		if ($return)
			return $this->debugInfo;
		else
			echo "<pre>";print_r($this->debugInfo);echo "</pre>";
	}
}
