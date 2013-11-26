<?php

require_once 'TwitterConnection.class.php';

class TwitterUsersRestoreAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		// obtengo los usuarios que no tienen screenname
		$twitterUsers = BaseQuery::create('TwitterUser')
			->filterByScreenname(null)
			->find();
			
		if($twitterUsers){
		
			$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
			$twitterConnection = new TwitterConnection($config);
			
			echo "<pre>";
			// restore action
			$i = 0;
			foreach($twitterUsers as $twitterUser){
				// recupero los datos para 50 para no exceder el limite de requests
				if ($i == 50)
						break;
				$query = array('user_id' => $twitterUser->getTwitteruserid());

				if (!empty($query)) {
					$searchRespone = $twitterConnection->search($query,0,'users');
					
					if(empty($searchRespone->errors)){
						$twitterUser->updateFromTwitter($searchRespone);
						print_r($twitterUser);
					}else{
						// logueo el mensaje de error
						TwitterLog::logTweetSearch(0, 0, null, $searchRespone->errors[0]->message);
					}
				}
				$i++;
			}
			
			echo "</pre>";
			die;
			
			$smarty->assign("message",'success');
			return $mapping->findForwardConfig('success');
		}
		
		$smarty->assign("message",'error');
		return $mapping->findForwardConfig('success');
		
	}
}
