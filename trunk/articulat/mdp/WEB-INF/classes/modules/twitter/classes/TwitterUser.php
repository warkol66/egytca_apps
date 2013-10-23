<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_user' table.
 *
 * Twitter / Users
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterUser extends BaseTwitterUser{
	
	/*Posibles niveles de influencia del usuario*/
	const NOT_INFLUENTIAL = 1;
	const NEUTRAL = 2;
	const INFLUENTIAL = 3;
	
	public static function getInfluenceLevels(){
		$levels[TwitterUser::INFLUENTIAL] = 'Influyente';
		$levels[TwitterUser::NEUTRAL] = 'Medianamente influyente';
		$levels[TwitterUser::NOT_INFLUENTIAL] = 'No influyente';
		return $levels;
	}
	
	/**
	* Genera el string a entregar por defecto reemplazando el __toString() del modelo
	*
	*	@return string string texto pro defecto a mostar cuando se llama al objeto twitterUser
	*/
	public function __toString() {
		$string = '';
		$name = $this->getName();
		$screenname = $this->getScreenname();

		if (ConfigModule::get("twitterUsers","toStringFormat") == "Name Screenname ")
			$string .= $name . ' ' . $screenname;
		else {
			if (!empty($screenname) && !empty($name))
				$string .= '@' . $screenname . ', ' . $name;
			else if (!empty($screenname))
				$string .= $screenname . ', ' . $name;
			else
				$string .= $name;
		}
		return $string;

	}
	
	/* Si el usuario que intentamos crear existe devuelve el existente
	 * Si no crea uno nuevo y lo devuelve
	 * 
	 * @param $newUser: arreglo para crear el usuario fromArray()
	 * return: TwitterUser
	 * */
	public function addUser($newUser) {
		//me fijo si el usuario ya existe
		$existent = TwitterUserQuery::create()->findOneByTwitterUserIdStr($newUser['Twitteruseridstr']);
		
		if(!is_object($existent)){
			$user = new TwitterUser();
			$user->fromArray($newUser);
			$user->save();
			return $user;
		}
		return $existent;
	}
	
	public function updateFromTwitter($searchRespone){
		
		$this->setDescription($searchRespone->description);
		$this->setUrl($searchRespone->url);
		$this->setScreenname($searchRespone->screen_name);
		$this->setName($searchRespone->name);
		$this->setFollowers($searchRespone->followers_count);
		$this->setFriends($searchRespone->friends_count);
		$this->setStatuses($searchRespone->statuses_count);
		$this->save();
		
	}
	
	/* Obtiene el actor asociado a un usuario de twitter
	 * 
	 * */
	public function getActor(){
		$actor = ActorQuery::create()->findOneByInternaltwitteruserid($this->getId());
		return $actor;
	}
	
	

}
