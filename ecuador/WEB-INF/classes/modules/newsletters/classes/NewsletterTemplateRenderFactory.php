<?php

require_once('NewsletterTemplateRender.php');
/**
* Construye instancias de NewsletterTemplateRender a traves  
* del procesamiento de un NewsletterTemplate
*/
class NewsletterTemplateRenderFactory {

	private $externalReplacement = '{center}';
	private $templateReplacements = array(
			'(\{setNewsArticleId_[0-9]*\})' => 'findOneById',
			'(\{setLastNewsArticles_[0-9]*\})' => 'getLastArticles',
			'(\{setLastBlogEntries_[0-9]*\})' => 'getLastEntries',
			'(\{setBlogEntryId_[0-9]*\})' => 'findOneById',
			'(\{setChallenge\})' => 'getCurrent'
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
		if (ereg('\{setNewsArticleId_([0-9]*)\}',$match,$matchParse) || ereg('\{setLastNewsArticles_([0-9]*)\}',$match,$matchParse)) {

			$id = $matchParse[1];
			
			$newsArticlePeer = new NewsArticlePeer();
			$result = NewsArticleQuery::create()->$callback($id);
			//si se pidieron varios la consulta devuelve objectCollecion, lo paso a array para poder usar el toXHTML
			if(method_exists($result, 'getData'))
				$result = $result->getData();
			
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
			
		}elseif(ereg('\{setLastBlogEntries_([0-9]*)\}',$match,$matchParse) || ereg('\{setBlogEntryId_([0-9]*)\}',$match,$matchParse)){
			
			$id = $matchParse[1];
			
			$result = BlogEntryQuery::create()->$callback($id);
			//si se pidieron varios la consulta devuelve objectCollecion, lo paso a array para poder usar el toXHTML
			if(method_exists($result, 'getData'))
				$result = $result->getData();
			
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
			
		}elseif(ereg('\{setChallenge\}',$match,$matchParse)){
			
			$id = $matchParse[1];
			
			$result = BoardChallengeQuery::create()->$callback($id);
			
			$replacement = '';
			if (!empty($result))
				$replacement .= $result->toXHTML();
			
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
			//require_once('NewsletterPeer.php');
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
