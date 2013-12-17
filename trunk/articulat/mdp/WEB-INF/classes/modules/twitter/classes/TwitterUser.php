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
	
	const GENDER_UNSELECTED = 0;
	const GENDER_FEMALE = 0;
	const GENDER_MALE = 1;
	
	public static function getGenders() {
		$genders = array(
			TwitterUser::GENDER_FEMALE => 'female',
			TwitterUser::GENDER_MALE => 'male');
		return $genders;
	}

	public static function getGenderTranslated($gender) {
		$genders = array(
			TwitterUser::GENDER_FEMALE => 'Femenino',
			TwitterUser::GENDER_MALE => 'Masculino');
		return $genders[$gender];
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
		$user = TwitterUserQuery::create()->filterByTwitterUserIdStr($newUser['Twitteruseridstr'])->findOneOrCreate();
		
		$user->fromArray($newUser);

		$followers = $user->getFollowers();
		$friends = $user->getFriends();
		$statuses = $user->getStatuses();
		$ratio = $followers / $friends;
		$influence = 0;
		if (($ratio >= 10 && $statuses > 5000)  || $statuses > 75000)
			$influence = 3;
		else if (($ratio >= 5 && $ratio < 10 && $statuses > 5000) || $statuses > 35000)
			$influence = 2;
		else if (($ratio > .8 && $ratio < 5 && $statuses > 5000) || $statuses > 15000)
			$influence = 1;

		$user->setInfluence($influence);

		$user->save();
		return $user;
	}
	
	public function updateFromTwitter($searchRespone){
		
		$this->setDescription($searchRespone->description);
		$this->setUrl($searchRespone->url);
		$this->setProfileimage($searchRespone->profile_image_url);
		$this->setScreenname($searchRespone->screen_name);
		$this->setName($searchRespone->name);
		$this->setFollowers($searchRespone->followers_count);
		$this->setFriends($searchRespone->friends_count);
		$this->setStatuses($searchRespone->statuses_count);
		
		$influence = $this->calculateInfluence($searchRespone);
		if ($this->getInfluence() == 0 || $this->getInfluence() < $influence)
			$this->setInfluence($influence);

		$this->save();
		
	}

	public function calculateInfluence($searchRespone) {
		$followers = $searchRespone->followers_count;
		$friends = $searchRespone->friends_count;
		$statuses = $searchRespone->statuses_count;
		$ratio = $followers / $friends;
		$influence = 0;
		if (($ratio >= 10 && $statuses > 5000)  || $statuses > 75000)
			$influence = 3;
		else if (($ratio >= 5 && $ratio < 10 && $statuses > 5000) || $statuses > 35000)
			$influence = 2;
		else if (($ratio > .8 && $ratio < 5 && $statuses > 5000) || $statuses > 15000)
			$influence = 1;

		return $influence;
	}
	
	/* Obtiene el actor asociado a un usuario de twitter
	 * 
	 * */
	public function getActor(){
		$actor = ActorQuery::create()->findOneByInternaltwitteruserid($this->getId());
		return $actor;
	}
	
	

}
