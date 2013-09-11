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
	
	/* Si el usuario que intentamos crear existe devuelve el existente
	 * Si no crea uno nuevo y lo devuelve
	 * 
	 * @param $newUser: arreglo para crear el usuario fromArray()
	 * return: TwitterUser
	 * */
	public function addUser($newUser) {
		//me fijo si el usuario ya existe
		$existent = TwitterUserQuery::create()->findOneByIdStr($newUser['IdStr']);
		
		if(!is_object($existent)){
			$user = new TwitterUser();
			$user->fromArray($newUser);
			$user->save();
			return $user;
		}
		return $existent;
	}

}