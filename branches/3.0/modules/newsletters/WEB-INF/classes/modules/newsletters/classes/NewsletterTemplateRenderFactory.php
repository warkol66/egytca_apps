<?php

require_once('NewsArticlePeer.php');

/**
* Construye instancias de NewsletterTemplateRender a traves  
* del procesamiento de un NewsletterTemplate
*/
class NewsletterTemplateRenderFactory {

	private $externalReplacement = '{center}';
	private $templateReplacements = array(
			'(\{setNewsArticleId_[0-9]*\})' => 'get',
			'(\{setLastNewsArticles_[0-9]*\})' => 'getLastArticles',
		);

	function __construct() {

	}
	
	/**
	 * Incorporacion del external al contenido del template
	 * 
	 */
	private function processTemplateExternal($template) {
		
		$external = $template->getNewsletterTemplateExternal();
		
		if (!empty($external)) {
			//incorporamos el external
			$workingContent = str_replace($this->externalReplacement,$template->getContent(),$external->getContent());
		}
		else {
			//no se utiliza external
			$workingContent = $template->getContent();
		}
		
		return $workingContent;
		
	}
	
	private function processMatch($condition,$match,$callback,$string) {
		
		$matchParse = array();
		if (ereg('\{[a-zA-z]*_([0-9]*)\}',$match,$matchParse)) {

			$id = $matchParse[1];
			
			$newsArticlePeer = new NewsArticlePeer();
			$result = $newsArticlePeer->$callback($id);
			
			$replacement = '';
			
			if (is_array($result)) {
				foreach ($result as $item) {
					$replacement .= $item->toXHTML();
				}
			}
			else {
				$replacement .= $result->toXHTML();
			}
			
			return ereg_replace($condition,$replacement,$string);
		}
		
	}
	
	private function processTemplate($unprocessedContent) {

		$splittedContent = split(' ',$unprocessedContent);
		$processedContent = '';
		
		foreach ($splittedContent as $string) {
			$processedString = $string;
			foreach ($this->templateReplacements as $condition => $callback ) {
				$match = array();
				if (ereg($condition,$string,$match)) {
					//se encontro un match
					$processedString = $this->processMatch($condition,$match[1],$callback,$processedString);
				}
			}
			$processedContent .= "$processedString ";
		}
		
		return $processedContent;
		
	}
	
	private function processSubject($template) {
		$subject = $template->getName();
		
		if ($template->hasDeliveryDateOnSubject()) {
			global $system;
			$dateFormat = $system['config']['system']['parameters']['dateFormat']['value'];
			$date = date($dateFormat);
			$subject .= " - $date";
		}
		
		if ($template->hasDeliveryNumberOnSubject()) {
			require_once('NewsletterPeer.php');
			$count = NewsletterPeer::getSentCount($template);
			$count++;
			$subject .= " - $count";
		}
		
		return $subject;
	}
	
	/**
	 * Construye un Render de un Template de Newsletter
	 *
	 */
	public function build($template) {
		
		//incorporacion de external
		$unprocessedContent = $this->processTemplateExternal($template);		
		$processedContent = $this->processTemplate($unprocessedContent);
		
		$subject = $this->processSubject($template);


		$render = new NewsletterTemplateRender();
		//TODO ver si no es necesario agregar subject al template
		$render->setSubject($subject);
		$render->setBody($processedContent);
				
		return $render;
	}
}
