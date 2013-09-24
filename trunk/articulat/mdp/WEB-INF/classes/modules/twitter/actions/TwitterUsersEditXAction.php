<?php

require_once 'TwitterConnection.class.php';

class TwitterUsersEditXAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$user = TwitterUserQuery::create()->findOneByInternalid($_POST['id']);
		
		// actualizo los datos del usuario
		if(is_object($user)){
			$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
			$twitterConnection = new TwitterConnection($config);
			
			$query = array('screen_name' => $user->getScreenname(), 'user_id' => $user->getId());
			if (!empty($query)) {
				
				$searchRespone = $twitterConnection->search($query,0,'users');
				$user->setDescription($searchRespone->description);
				$user->setFollowers($searchRespone->followers_count);
				$user->setFriends($searchRespone->friends_count);
				$user->save();
			}

			$smarty->assign('twitterUser',$user);
			return $mapping->findForwardConfig('success');
		}

	}
}
