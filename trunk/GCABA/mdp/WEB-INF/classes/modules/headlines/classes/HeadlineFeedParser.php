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
		
		$fieldsMap = array(
			'title' => 'setName',
			'description' => 'setContent',
			'link' => 'setUrl',
			'pubDate' => 'setDatePublished',
			'page' => 'setPage',
			'section' => 'setSection',
			'abstract' => 'setSummary',
			'caption' => 'setCaption',
//			'lastChangeDate' => 'setContent',
//			'category' => 'setMedia by name??? or create?',
//			'comments' => ????
//			'enclosure' => ????
//			'guid' => ???
			'author' => 'setAuthor',
			'source' => 'setSource'
		);
		
		$headlines = array();
		if ($this->debugging) {
			$this->debugInfo['fields'] = array();
		}
		foreach ($parsedData->channel->item as $item) {
			$headline = new $this->class();
			foreach ($item as $key => $value) {
				if ($fieldsMap[$key]) {
					$setMethod = $fieldsMap[$key];
					$headline->$setMethod($value);
					if ($this->debugging) {
						$this->debugInfo['fields'][$key] = 'found';
					}
				} else {
					if ($this->debugging) {
						$this->debugInfo['fields'][$key] = 'not found ***************';
					}
					// TODO: avisar que hay datos en desuso
					
					// DELETEME
					if (false && $key == 'comments') {
						echo '<hr/>';
						echo $key."<br/>";
						foreach ($value as $q) {
							echo "- ".$q."<br/>";
						}
						echo $value."<br/>";
						echo "class: ".get_class($value)."<br/>";
						print_r($value);
						echo '<hr/>';
					}
				}
			}
			
			// TODO: if $headline is valid
			$headlines []= $headline;
		}
		
		return $headlines;
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
