<?php

/**
 * Class TopsyStrategy.
 * 
 * Parametros de tiempo:
 * 
 *  Ultima hora
 *    'dateFilter' => 'hour' 
 *  Ultimo dia
 *    'dateFilter' => 'day' 
 *  Ultima semana
 *    'dateFilter' => 'week' 
 *  Ultima mes
 *    'dateFilter' => 'month' 
 *  Ultimo año
 *    'dateFilter' => 'year' 
 * 
 */
class TopsyStrategy extends AbstractParserStrategy {
	
	private static $DATE_FILTER_MAP = array(
		'dateFilter' => 'window',
		'hour'       => 'h',
		'day'        => 'd',
		'week'       => 'w',
		'month'      => 'm',
		'year'       => 'y',
	);
	
	public function initialize() {
		// http://www.topsy.com/s/kun+aguero/link?window=d
		$this->setSearchEngineUrl('http://www.topsy.com/s/');
		$this->setSelectors(array(
			
			'items' => '#body-wrap .result-box .list .list-link-v3',
			'item_url' => '.title .external',
			'item_title' => '.title',
			'item_source' => '.title .external',
			'item_timestamp' => '.actions .date-link',
			'item_snippet' => '.body',
			'next_link' => '#body-wrap .pager-box-body .next'
		));
	}
	
	/**
	 * Construye los parametros de url.
	 * 
	 * @return  string
	 */
	protected function buildQueryParams() {
		$keywords = str_replace(" ", "+", $this->getKeywords());
		return $keywords.'/link?'.http_build_query($this->getQueryParameters());
	}
	
	public function setQueryParameters(array $params) {
		$newParams = array();
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'dateFilter':
					$newParams = array_merge_recursive($newParams, array(
						self::$DATE_FILTER_MAP['dateFilter'] => self::$DATE_FILTER_MAP[$value]
					));
					break;
				default:
					$newParams = array_merge_recursive($newParams, array($key => $value));
			}
		}
		parent::setQueryParameters($newParams);
	}
	
	public function parse($url = null) {
		
		$debug = false;
		
		$pq = $this->getDocument($url);
		
		$news = array();
		$resultsErrorsExist = false;
		foreach ($pq[$this->getSelector('items')] as $item) {
			
			$timestamp = $this->fixEncoding($pq->find($this->getSelector('item_timestamp'), $item)->html());
			$source = $this->fixEncoding($pq->find($this->getSelector('item_source'), $item)->attr('href'));
			
			if ($debug) {
				echo "timestamp before parsing: $timestamp<br />";
			}
			
			$url = $this->fixEncoding($pq->find($this->getSelector('item_url'), $item)->attr('href'));
			$title = $this->fixEncoding($pq->find($this->getSelector('item_title'), $item)->html());
			$source = $this->parseSource($source);
			$timestamp = $this->parseTimestamp($timestamp);
			$snippet = $this->fixEncoding($pq->find($this->getSelector('item_snippet'), $item)->html());
			
			if ($debug) {
				echo "url: $url<br />";
				echo "title: $title<br />";
				echo "source: $source<br />";
				echo "timestamp: $timestamp<br />";
				echo "snippet: $snippet<br />";
				echo "<br />";
			}
			
			if ( !$resultsErrorsExist && ($url == '' || $title == ''
				|| $source == '' || $timestamp == '' || $snippet == '') ) {
				
				$this->addError('invalid_headline');
				$resultsErrorsExist = true;
			}
			
			$news[] = array(
				'url'       => $url,
				'title'     => $title,
				'source'    => $source,
				'timestamp' => $timestamp,
				'snippet'   => $snippet,
				'strategy'  => 'topsy'
			);
		}
		
		$nextOffsetLink = $pq->find($this->getSelector('next_link'))->attr('href');
		preg_match("/offset=(?<nextOffset>[^&]*)/", $nextOffsetLink, $matches);
		$this->setNextQueryParameters(
			array('offset' => $matches['nextOffset'])
		);
		
		if ($debug) {
			echo "next-offset-link: $nextOffsetLink<br />";
			echo "next-offset: ".$matches['nextOffset']."<br />";
		}
		
		return $news;
	}
	
	protected function parseSource($url) {
		preg_match("/:\/\/(?<source>[^\/]*)/", $url, $matches);
		return $matches['source'];
	}
    
} // TopsyStrategy
