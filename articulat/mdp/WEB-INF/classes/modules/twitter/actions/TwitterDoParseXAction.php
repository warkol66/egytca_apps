<?php

require_once 'TwitterConnection.class.php';

class TwitterDoParseXAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
		$twitterConnection = new TwitterConnection($config);
		
		$query = $_POST['q'];
		$campaignId = $_POST['campaignId'];
		if (!empty($query)) {
			
			$tweets = array();
			$embeds = array();
			
			foreach (split(' ', $query) as $term) {
			
				$searchRespone = $twitterConnection->search($term,10,'search');
				foreach ($searchRespone->statuses as $responseTweet) {
					// obtengo el html para embeber el tweet
					$embedQuery = array('id' => $responseTweet->id);
					$embed = $twitterConnection->search($embedQuery,0,'embed');
					$embed = $embed->html;
					
					$tweet = TwitterTweet::createFromApiTweet($responseTweet, $campaignId, $embed);
					$tweets[] = $tweet;
					//$tweets[] = $responseTweet;
				}
			}
			
			//echo "<pre>";print_r($tweets);echo "</pre>";
		}
		//die;
		$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');
	}
}
