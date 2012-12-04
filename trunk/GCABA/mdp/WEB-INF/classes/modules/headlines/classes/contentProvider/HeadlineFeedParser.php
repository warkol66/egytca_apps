<?php

class HeadlineFeedParser {

	protected $class;
	protected $classKey;
	private $debugging;
	private $debugInfo;

	public function __construct($class = 'Headline') {
		$this->class = $class;
		$this->classKey = constant('HeadlinePeer::CLASSKEY_'.strtoupper($this->class));
		if (is_null($this->classKey))
			throw new Exception('classKey for '.$this->class.' doesn\'t exist');
		$this->debugging = false;
	}

	function parse($uri) {
		
		$xmlData = file_get_contents($uri);
		if (!$xmlData)
			throw new Exception("no se pudo leer $uri");
		
		try {
			$parsedData = new SimpleXMLElement($xmlData);
		} catch (Exception $e) {
			$xmlData = preg_replace("/[\x01\x1F]/", '', $xmlData);
			$parsedData = new SimpleXMLElement($xmlData);
		}
		
		if ($this->debugging) {
			$this->debugInfo['fields'] = array();
		}

		$headlines = array();
		foreach ($parsedData->channel->item as $item) {

			$headline = new HeadlineParsed();
			$headline->setClassKey($this->classKey);

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

			$headline->setStrategy('feed');

			// TODO: if $headline is valid
			$headlines []= $headline;
		}

		return $headlines;
	}

	private function addInfoToHeadline($headline, $name, $value) {
		switch ($name) {
			case 'title': $headline->setName($value); return true;
			case 'description': $headline->setContent($value); return true;
			case 'link': $headline->setUrl($value); return true;
			case 'pubDate': $headline->setDatePublished($value); return true;
			case 'page': $headline->setPage($value); return true;
			case 'section': $headline->setSection($value); return true;
			case 'abstract': $headline->setSummary($value); return true;
			case 'caption': $headline->setCaption($value); return true;
			case 'category': $this->parseMedianameAndProgram($headline, $value); return true;
			case 'guid': $headline->setInternalIdFromString($value); return true;
			case 'author': $headline->setAuthor($value); return true;
			case 'source': $headline->setSource($value); return true;
			case 'lastChangeDate': $headline->setLastChangeDate($value); return true;
			case 'comments': return false;//$headline->???($value); return true;
			case 'enclosure': $this->addEnclosureToHeadline($headline, $value);
												$headline->setLength($value->attributes()->length);
												return true;
			default: break;
		}
		return false;
	}

	private function addEnclosureToHeadline($headline, $value) {
		$attributes = $value->attributes();

		$attachment = new HeadlineParsedAttachment();

		$attachment->setLength($attributes->length);
		$attachment->setType($attributes->type);
		$attachment->setUrl($attributes->url);

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

class HeadlineParsedParser {
	
	private $type;
	private $typeMap;
	private $feed;
	private $feedsPath;
	private $makeFeedBackup;
	private $headlines;
	private $savedHeadlines;
	private $existentHeadlinesCount;
	private $invalidHeadlinesCount;
	private $logEntryId;
	
	public function __construct($type, $makeFeedBackup = true) {
		$this->type = $type;
		$this->makeFeedBackup = $makeFeedBackup;
		$this->typeMap = ConfigModule::get('headlines', 'typeMap');
	}
	
	/**
	 * parses a feed and saves the HeadlineParsed objects
	 * 
	 * @param string $feedUri feed uri. if null, the default uri for the feed type is used.
	 * @throws Exception
	 */
	public function parse($feedUri = null) {
		
		if (is_null($feedUri))
			$feedUri = $this->typeMap[$this->type]['url'];
		
		$this->feedsPath = ConfigModule::get("headlines", "feedBackupsPath");
		$this->feed = $this->feedsPath.'/temp-feed.xml';
		file_put_contents($this->feed, file_get_contents($feedUri));
		
		$logEntry = new HeadlineParseLogEntry();
		$logEntry->setHeadlinetype($this->type);
		$logEntry->setUser(Common::getLoggedUser());
		$logEntry->setUrl($this->feed);
		$logEntry->setStatus('ongoing');
		$logEntry->save();
		
		$this->logEntryId = $logEntry->getId();
		
		$this->savedHeadlines = array();
		$this->existentHeadlinesCount = 0;
		$this->invalidHeadlinesCount = 0;
		
		$headlineParser = new HeadlineFeedParser($this->typeMap[$this->type]['class']);
		try {
			if ($this->makeFeedBackup)
				$this->zipData();
			$this->headlines = $headlineParser->debugMode($this->debug)->parse($this->feed);
			$logEntry->setStatus('success');
		} catch (Exception $e) {
			$logEntry->setStatus('failure');
			$logEntry->setErrormessage($e->getMessage());
			throw $e;
		}
		
		foreach ($this->headlines as $h) {
			if (HeadlineParsedQuery::create()->filterByInternalid($h->getInternalId())->count() > 0) {
				$this->existentHeadlinesCount++;
			} else {
				try {
					$h->save();
					$this->savedHeadlines []= $h;
				} catch (Exception $e) {
					$this->invalidHeadlinesCount++;
				}
			}
		}

		$logEntry->setParsedcount(count($this->headlines));
		$logEntry->setCreatedcount(count($this->savedHeadlines));
		$logEntry->setExistentcount($this->existentHeadlinesCount);
		$logEntry->setInvalidcount($this->invalidHeadlinesCount);
		$logEntry->save();

		unlink($this->feed);
	}
	
	/**
	 * 
	 * @return array HeadlineParsed objects parsed, including those already
	 * existent or that couldn't be saved
	 */
	public function getHeadlines() {
		return $this->headlines;
	}
	
	/**
	 * 
	 * @return array new HeadlineParsed objects created
	 */
	public function getSavedHeadlines() {
		return $this->savedHeadlines;
	}
	
	/**
	 * 
	 * @return int already existent HeadlineParsed objects count
	 */
	public function getExistentHeadlinesCount() {
		return $this->existentHeadlinesCount;
	}
	
	/**
	 * 
	 * @return int invalid HeadlineParsed objects count
	 */
	public function getInvalidHeadlinesCount() {
		return $this->invalidHeadlinesCount;
	}
	
	/**
	 * makes a zipped backup of the feed
	 * @throws Exception
	 */
	private function zipData() {
		$destination = "$this->feedsPath/$this->logEntryId.zip";
		$zip = new ZipArchive();
		if ($zip->open($destination, ZIPARCHIVE::CREATE) !== true)
			throw new Exception("unable to open $destination");
		
		$zip->addFile($this->feed, "$this->logEntryId.xml");
		$zip->close();
		
		if (!file_exists($destination))
			throw new Exception("unable to create $destination");
	}
}
