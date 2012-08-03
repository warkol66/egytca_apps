<?php

class HeadlinesXMLParseAction extends BaseAction {
	
	function HeadlinesXMLParseAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$xmlData = file_get_contents('feed.xml');
		$parsedData = new SimpleXMLElement($xmlData);
		
		$fieldsMap = array(
			'title' => 'name',
			'description' => 'content',
			'link' => 'url',
			'pubDate' => 'datePublished'
		);
		
		$headlines = array();
		$fields = array(); // DELETEME
		foreach ($parsedData->channel->item as $item) {
			$headline = new Headline();
			foreach ($item as $key => $value) {
				if ($fieldsMap[$key]) {
					$setMethod = 'set'.ucfirst(strtolower($fieldsMap[$key]));
					$headline->$setMethod($value);
					$fileds[$key] = 'found'; // DELETEME
				} else {
					$fileds[$key] = 'not found ***************'; // DELETEME
				}
			}
			
			// TODO: if $headline is valid
			$headlines []= $headline;
		}
		echo '<hr/>';
		
		echo '<a name="top">top</a>';
		echo '<ul>';
		echo '<li><a href="#fields">fields</a></li>';
		echo '<li><a href="#first_printr">first headline print_r</a></li>';
		echo '<li><a href="#all_parsed">all headlines parsed</a></li>';
		echo '<li><a href="#xml_data">xml data</a></li>';
		echo '</ul>';
		
		echo '<hr/>';
		
		echo '<h2><a name="fields">fields</a></h2>';
		echo '<a href="#top">top</a>';
		echo '<pre>';print_r($fileds);echo '</pre><br/>';
		
		echo '<hr/>';
		
		echo '<h2><a name="first_printr">first headline print_r</a></h2>';
		echo '<a href="#top">top</a>';
		foreach ($headlines as $headline) {
			echo '<pre>';print_r($headline);echo '</pre><br/>';
			
			break;
		}
		
		echo '<hr/>';
		
		echo '<h2><a name="all_parsed">all parsed headlines</a></h2>';
		echo '<a href="#top">top</a>';
		echo '<ul>';
		foreach ($headlines as $headline) {
			echo '<li>'.$headline.'</li>';
		}
		echo '</ul>';
		
		echo '<hr/>';
		
		echo '<h2><a name="xml_data">xml data</a></h2>';
		echo '<a href="#top">top</a>';
		echo '<pre>';print_r($parsedData);echo '</pre><br/>';

		echo '<hr/>';
		echo '<a href="#top">top</a>';

	}
}
