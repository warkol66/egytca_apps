<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_tweet' table.
 *
 * Tweet
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterTweet extends BaseTwitterTweet{
	
	/*Posibles estados del tweet*/
	const PARSED = 1;
	const ACCEPTED = 2;
	const DISCARDED = 3;
	/*Posibles valoraciones del tweet*/
	const POSITIVE = 1;
	const NEUTRAL = 2;
	const NEGATIVE = 3;
	/*Posibles relevancias del tweet*/
	const RELEVANT = 1;
	const NEUTRALLY_RELEVANT = 2;
	const IRRELEVANT = 3;
	/*Posibles tipos del tweet*/
	const ORIGINAL = 1;
	const RETWEET = 2;
	const REPLY = 3;
	
	// Palabras y signos de puntuacion a evitar al hacer el analisis de tweets
	public static function getPunctuation(){
		return array("?","!",",",";",".","\$","%","(",")","-", "'s","'",'"',":",";","&","|","“","”");
	}
	
	public static function getStopWords(){
		return array("a", "nos", "tmb", "cual", "otra", "les", "asi", "así", "abre", "e", "jaja", "jajaja", "después", "le", "unas", "unos", "tras", "sobre", "arriba", "across", "luego", "despues", "nuevo", "contra", "todos", "casi", "solo", "junto", "ya", "tambien","aunque","siempre","soy", "son", "ser", "somos", "seremos","seriamos","serian","entre", "cantidad", "y", "cualquiera","cualquier", "lugar", "alrededor", "como",  "en", "atras","convertir", "porque","convertirse","convierten", "convirtiendo", "fue", "antes", "detras", "siendo", "debajo", "aparte", "allá","alla", "cuenta","cuentas","cuentan", "ambos", "fondo","pero", "por", "llamar","llaman","llamemos","llamen", "puede","puden","podemos", "podria","puede","podrias", "podría", "no", "si", "co", "con", "llorar", "de", "describir","describen","describimos", "detalle", "hacer", "hecho","hacen","hacemos","hicimos", "bajo", "debe", "deben", "debemos", "deberia", "deberian","deberiamos", "durante", "cada", "ocho", "ninguno", "lado", "vacio", "suficiente", "etc", "incluso", "incluyen", "incluido", "incluidos", "nunca", "excepto","exceptuando","salvo","sacando", "poco", "pocos", "poca", "pocas", "quince", "llenar","llenan","llenamos", "encontrar", "encuentran", "encontramos", "encontraran", "primero", "primera","primeros","primeras", "cinco", "anterior", "anteriores", "anteriormente", "cuarenta", "encontrado", "cuatro", "desde", "hasta", "frente", "lleno", "llena", "llenan", "llenaron", "llenaran", "tuvo", "tiene", "tener", "tienen", "tuviera", "tuviese", "tuvieran", "tuviesen", "dar", "dieran", "diesen", "ir", "yendo", "van", "ha", "has", "han", "habian", "habia", "hubiera", "hubieran", "hubiese", "hubiesen", "habido", "hemos", "el", "entonces", "ella", "aca", "aqui", "ellas", "misma", "mismas", "mismos", "mismo", "ellos", "cien", "cientos", "mil", "miles", "ie", "ej", "en", "inc", "hecho", "interes", "intereses", "es", "su", "sus", "suyo", "suyos", "mantener", "mantienen", "mantenemos", "ultimo", "ultima", "ultimos", "ultimas", "menor", "mayor", "menos", "mas", "ltd", "varios", "varias", "quizas", "tal", "vez", "me", "mientras", "podria", "pudiera", "pudiese", "puede", "pueden", "pudo", "mi", "mio", "incluso", "mayoria", "minoria", "mayormente", "mover", "mueve", "mueven", "movemos", "mucho", "mi", "nombre", "llamado", "llamada", "llamadas", "llamados", "ni", "siguiente", "nueve", "tarde", "tarden", "tardamos", "tardaron", "tardaran","tardasen", "nada", "ahora", "off", "casi", "un", "una", "uno", "o", "u", "otro", "otros", "forma", "nuestro", "nuestros", "nuestra", "nuestras", "fuera", "tiene", "parte", "per", "por", "favor", "poner", "pone", "re", "mismo", "ver", "parece", "parecia", "pareciera", "pareciese", "serio", "monton", "muestra", "sincero", "seis", "sesenta", "algun", "algunos", "alguna", "algunas", "alguien", "algo", "veces", "aun", "todavia", "sistema", "tomar", "diez", "que", "ese", "este", "estos", "ellos", "esos", "esas", "estas", "ahi", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "gordos", "gordo", "flaco", "tercero", "flacos", "those", "though", "tres", "traves", "throughout", "thru", "thus", "juntas", "juntos", "incluso", "top", "hacia", "towards", "doce", "veinte", "dos", "un", "under", "until", "up", "upon", "nosotras", "muy", "via", "era", "eran", "bien", "eran", "what", "whatever", "cuando", "whence", "los", "vuelve", "dra", "día", "te", "q", "sea", "sean", "cuales", "tanto", "al", "quien", "quienes", "completo", "del", "la", "las", "va", "lo", "entre", "sin", "debe", "aun", "tu", "tus", "tuyo", "tuyos", "q'", "the","O","sos", "", " ", "ayuda" ,"u", "dice","mejor","ah","check","venir","doing","quiero","querer","necesitar","gente","c/","persona","dia","yendo","pienso","pensamos","fin","semana","did","ive","got","2","1","6","3","4","5","6","7","8","9","0","tiempo","nuevo","noche","se","correcto","sabemos","verdad","lejos","cerca","rt", ">", "<", "=", "grande", "good", "gusta", "amo","i","im","i'm", "hoy", "justo", ">", "http", "//t.co", "t.co", "com");
	}
	
	public static function getStatuses(){
		$statuses[TwitterTweet::PARSED] = 'Parseado';
		$statuses[TwitterTweet::ACCEPTED] = 'Aceptado';
		$statuses[TwitterTweet::DISCARDED] = 'No Aceptado';
		return $statuses;
	}
	
	public static function getValues(){
		$values[TwitterTweet::POSITIVE] = 'Positivo';
		$values[TwitterTweet::NEUTRAL] = 'Neutro';
		$values[TwitterTweet::NEGATIVE] = 'Negativo';
		return $values;
	}
	
	public static function getRelevances(){
		$relevances[TwitterTweet::RELEVANT] = 'Relevante';
		$relevances[TwitterTweet::NEUTRALLY_RELEVANT] = 'Medianamente relevante';
		$relevances[TwitterTweet::IRRELEVANT] = 'Irrelevante';
		return $relevances;
	}
	
	public function createFromApiTweet($apiTweet, $campaignId, $embed) {
		// fecha de creacion en timezone del sistema
		//$createdAt = Common::getDatetimeOnGMT(gmdate('Y-m-d H:i:s',strtotime($apiTweet->created_at)));
		
		//armo los arreglos para crear tweet y usuario
		$tweet = array(
			'Createdat' => $apiTweet->created_at,
			'Tweetid' => $apiTweet->id,
			'Tweetidstr' => $apiTweet->id_str,
			'Campaignid' => $campaignId,
			'Text' => $apiTweet->text,
			'Truncated' => $apiTweet->truncated,
			'Retweeted' => $apiTweet->retweeted,
			'Inreplytostatusid' => $apiTweet->in_reply_to_status_id,
			'Inreplytostatusidstr' => $apiTweet->in_reply_to_status_id_str,
			'Inreplytouserid' => $apiTweet->in_reply_to_user_id,
			'Inreplytouseridstr' => $apiTweet->in_reply_to_user_id_str,
			'Inreplytoscreenname' => $apiTweet->in_reply_to_screen_name,
	//		'Geo' => $apiTweet->geo,
	//		'Coordinates' => $apiTweet->coordinates,
	//		'Contributors' => $apiTweet->contributors,
			'Place' => $apiTweet->place,
			'Retweetcount' => $apiTweet->retweet_count,
			'Favoritecount' => $apiTweet->favorite_count,
			'Lang' => $apiTweet->lang,
			'Embed' => $embed
		);
		
		$user = array(
			'Twitteruserid' => $apiTweet->user->id,
			'Twitteruseridstr' => $apiTweet->user->id_str,
			'Name' => $apiTweet->user->name,
			'Screenname' => $apiTweet->user->screen_name,
			'Location' => $apiTweet->user->location,
			'Description' => $apiTweet->user->description,
			'Url' => $apiTweet->user->url,
			'Isprotected' => $apiTweet->user->protected,
			'Followers' => $apiTweet->user->followers_count,
			'Friends' => $apiTweet->user->friends_count,
			'Statuses' => $apiTweet->user->statuses_count
		);
		
		return TwitterTweet::addTweet($tweet, $user);
	}
	
	/* Si el tweet que intentamos crear existe devuelve el existente
	 * Si no crea uno nuevo y lo devuelve
	 * 
	 * @param $newTweet: arreglo para crear el tweet fromArray()
	 * return: TwitterTweet
	 * */
	public static function addTweet($newTweet, $newUser) {
		
		$tweet = new TwitterTweet();
		$tweet->fromArray($newTweet);
		$tweet->buildInternalId();
		
		//me fijo si el tweet ya existe para esta campaña
		if(TwitterTweetQuery::create()->filterByInternalid($tweet->getInternalId())->count() == 0){
			
			$user = TwitterUser::addUser($newUser);
			$tweet->setInternaltwitteruserid($user->getId());
			$tweet->save();
			
			return $tweet;
		}else{
			return TwitterTweetQuery::create()->findOneByInternalid($tweet->getInternalId());
		}
	}
	
	/**
	* Genero el internalId antes de guardar el registro
	* usando el campaignId, texto y string id
	* 
	*/
	public function buildInternalId() {
		
		$this->setInternalid(md5($this->getCampaignid() . $this->getText() . $this->getTweetIdStr()));
		
	}
	
	/* Cambia el status del tweet a ACCEPTED
	 * 
	 * return void
	 * */
	public function accept(){
		$this->setStatus(TwitterTweet::ACCEPTED);
		$this->save();
	}
	
	/* Cambia el status del tweet a DISCARDED
	 * 
	 * return void
	 * */
	public function discard(){
		$this->setStatus(TwitterTweet::DISCARDED);
		$this->save();
	}
	
	
	/* Modifica un campo de varios tweets a new value
	 * 
	 * @param $field: campo a modificar
	 * @param $newValue: valor para setearle al campo
	 * @param $tweets: array[int] ids de los tweets a modificar
	 * return bool
	 * */
	public static function editMultiple($field,$newValue,$tweets){
		TwitterTweetQuery::create()->filterById($tweets, Criteria::IN)->update(array($field => $newValue));
	}
	
}
