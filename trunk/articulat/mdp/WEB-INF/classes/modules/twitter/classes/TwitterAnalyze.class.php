<?php
/**
 * @file
 * Library class for timeline analysis
 * meant to be required on analyze.php
 */

class timeline_bank {
	
	/*
	 * DATA STRUCTURE:
	 * 
	 * 		users => (
	 * 			"ThomasTommyToom"
	 * 				=> (
	 * 						"hashtags" => (
	 * 							"#bbs" => 5, 
	 * 							"#sw" => 1,
	 * 							"#HASHTAG" => NUMBER_OF_OCCURANCES_BY_USER
	 * 						)
	 * 			
	 * 						"mentions" => (
	 * 							"@jb" => 1
	 * 						)
	 * 					)
	 * 			"AreoSuch"
	 * 				=> (
	 * 						"hashtags" => (
	 * 							"#bc2" => 5
	 * 							"#sw" => 1
	 * 						)
	 * 			
	 * 						"mentions" => (
	 * 							"@jb" => 1
	 * 						)
	 * 					)
	 * 			)
	 */
	
	function __construct(){
		
		//holds daata about how many users are using a particular word
		$this->user_hashtags = array();
		$this->user_mentions = array();
		$this->user_words = array();
		$this->user_phrases = array();
		
		
		//hold data about frequency of words
		$this->discover_hashtags = array();
		$this->discover_mentions = array();
		$this->discover_words = array();
		$this->discover_phrases = array();
		
		//holds data about tweets assoicated with that word
		$this->associated_tweets = array();

		//hold data we'll need for snapshots
		/*$this->user_id = $user_id;
		$this->snapshot_id = 0;	*/
	}
	
	/*public function analyze($campaignId, $tweets)
	
	function query($query){
		$res =  mysql_query($query) or die(mysql_error());
		return $res;
	}*/
	
	
	public function insert_hashtag($userdata, $hashtag){
		
		$user = $userdata["screen_name"];
		
		//log user instance of hashtag
		if(isset($this->user_hashtags[$hashtag][$user])){
			$this->user_hashtags[$hashtag][$user]++;
		}else{
			$this->user_hashtags[$hashtag][$user] = 1;
		}
		
		//log hashtag
		if(isset($this->discover_hashtags[$hashtag])){
			$this->discover_hashtags[$hashtag]++;//increment
		}else{
			$this->discover_hashtags[$hashtag] = 1;//set to 1
		}
		
		
		//associate tweet with userdata
		$this->assocate_tweet_with_word($userdata, $hashtag);
	}
	
	public function insert_mention($userdata, $mention){
		
		$user = $userdata["screen_name"];
		
		//log user instance of mention
		if(isset($this->user_mentions[$mention][$user])){
			$this->user_mentions[$mention][$user]++;
		}else{
			$this->user_mentions[$mention][$user] = 1;
		}
		
		//log discovery
		if(isset($this->discover_mentions[$mention])){
			$this->discover_mentions[$mention]++;//increment
		}else{
			$this->discover_mentions[$mention] = 1;//set to 1
		}
		
		//associate tweet with userdata
		$this->assocate_tweet_with_word($userdata, $mention);		

	}	
	
	public function insert_word($userdata, $word){

		if(empty($word)){
			return true;
		}
	
		$user = $userdata["screen_name"];
		
		//log user instance of mention
		if(isset($this->user_words[$word][$user])){
			$this->user_words[$word][$user]++;
		}else{
			$this->user_words[$word][$user] = 1;
		}
		
				
		//log discovery
		if(isset($this->discover_words[$word])){
			$this->discover_words[$word]++;//increment
		}else{
			$this->discover_words[$word] = 1;//set to 1
		}	

		//associate tweet with userdata
		$this->assocate_tweet_with_word($userdata, $word);		
	
	}
	
	
	public function insert_phrase($userdata, $phrase){

		$user = $userdata["screen_name"];
		
		//log user instance of mention
		if(isset($this->user_phrases[$phrase][$user])){
			$this->user_phrases[$phrase][$user]++;
		}else{
			$this->user_phrases[$phrase][$user] = 1;
		}
		
		//log discovery
		if(isset($this->discover_phrases[$phrase])){
			$this->discover_phrases[$phrase]++;//increment
		}else{
			$this->discover_phrases[$phrase] = 1;//set to 1
		}	
		
		$this->assocate_tweet_with_word($userdata, $phrase);
	}
	
	
	
	public function assocate_tweet_with_word($userdata, $word){
		
		//userdata format: array("tweet_id" => $tweet_id, "screen_name" => $screen_name, "name" => $name);
		if(is_array($this->associated_tweets[$word])){
			array_push($this->associated_tweets[$word],$userdata);
		}else{
			$this->associated_tweets[$word] = array($userdata);
		}
		
	}
	
	
	public function sort_discoveries(){
		//use asort to keep key associations
		asort($this->discover_hashtags);
		asort($this->discover_mentions);
		asort($this->discover_words);
		asort($this->discover_phrases);
	}
	
	
	public function prioritize($debug, &$treeInfo){
		// info for treemap graph
		$treeInfo['name'] = 'personalTrends';
		
		$popular_hashtags = array();
		$treemap_hashtags = array('name' => 'hashtags');
		foreach($this->discover_hashtags as $hashtag => $frequency){
			
			$uniques = count($this->user_hashtags[$hashtag]);
			$total = round(sqrt($frequency) * $uniques, 6);
			
			if($total > 3){
				$popular_hashtags[$hashtag]['total'] = $total;
				$popular_hashtags[$hashtag]['users'] = $uniques;
				$popular_hashtags[$hashtag]['frequency'] = $frequency;
				
				$treemap_hashtags['children'][] = array('name' => $hashtag, 'size' =>$frequency);
			}
		}
		
		if(!empty($treemap_hashtags['children']))
			$treeInfo['children'][0] = $treemap_hashtags;

		$popular_mentions = array();
		$treemap_mentions = array('name' => 'mentions');
		foreach($this->discover_mentions as $mention => $frequency){
			$uniques = count($this->user_mentions[$mention]);
			
			$total = round(sqrt($frequency) * $uniques, 6);
			
			if($total > 3){
				$popular_mentions[$mention]['total'] = $total;
				$popular_mentions[$mention]['users'] = $uniques;
				$popular_mentions[$mention]['frequency'] = $frequency;
				
				$treemap_mentions['children'][] = array('name' => $mention, 'size' =>$frequency);
			}
		}
		
			if(!empty($treemap_mentions['children']))
		$treeInfo['children'][1] = $treemap_mentions;
		
		$popular_words = array();
		$treemap_words = array('name' => 'words');
		foreach($this->discover_words as $word => $frequency){
			$uniques = count($this->user_words[$word]);
			
			$total = round(sqrt($frequency/4) * $uniques/(1.1), 6);

			if($total > 3){
				$popular_words[$word]['total'] = $total;
				$popular_words[$word]['users'] = $uniques;
				$popular_words[$word]['frequency'] = $frequency;
				
				//$treemap_words['children'][] = array('name' => $word, 'size' =>$frequency);
			}	
		}
		
		$popular_phrases = array();
		$treemap_phrases = array('name' => 'phrases');
		foreach($this->discover_phrases as $phrase => $frequency){
			$uniques = count($this->user_phrases[$phrase]);
			
			$total = round(sqrt($frequency/4) * ((1.1)*$uniques), 6);
			
			if($total > 3){
				$popular_phrases[$phrase]['total'] = $total;
				$popular_phrases[$phrase]['users'] = $uniques;
				$popular_phrases[$phrase]['frequency'] = $frequency;
				
				$treemap_phrases['children'][] = array('name' => $phrase, 'size' =>$frequency);
			}
		}
		
		if(!empty($treemap_phrases['children']))
			$treeInfo['children'][2] = $treemap_phrases;
		
		//sort them
		asort($popular_hashtags);
		asort($popular_mentions);
		asort($popular_words);
		asort($popular_phrases);
	
		if($debug){
			echo "<pre>";
			Echo "<br /> Result <br />";
			Echo "<br /> Hashtags <br />";
			print_r($popular_hashtags);
			Echo "<br /> Mentions <br />";
			print_r($popular_mentions);
			Echo "<br /> Words <br />";
			print_r($popular_words);
			Echo "<br /> Phrases <br />";
			print_r($popular_phrases);
			echo "<pre>";
		}
		
		//limit to the most popular 3 last words to filter out noise
		$limited_single_words = array_slice($popular_words, -3,3);//limit it to the most popular 2 words
		
		//combine
		$hashtags_and_mentions = array_merge($popular_hashtags, $popular_mentions);
		$words_and_phrases = array_merge($limited_single_words, $popular_phrases);
		$result = array_merge($hashtags_and_mentions,$words_and_phrases);
		
		//sort and reverse
		asort($result);
		$result = array_reverse($result);
		
		//lets go through the top 15 occurances. If there is a phrase in these occurances, we need to remove words in that phrase from the entire result.
		$x = 0;
		foreach($result as $word => $score){
			if($x < 20){
				if(strpos($word, " ") > 0){
					$words_in_phrases = explode(" ",$word);
					
					foreach($words_in_phrases as $current_word){
						unset($result[$current_word]);
						unset($limited_single_words[$current_word]);
						//unset($treemap_words['name'][$current_word]);
						// delete from treemap array too
					}
					
					//unset($result[$words_in_phrase[0]]);
					//unset($result[$words_in_phrase[1]]);
				}
				$x++;
			}
		}
		
		foreach($limited_single_words as $key => $value){
			$treemap_words['children'][] = array('name' => $key, 'size' =>$value['frequency']);
		}
		
		if(!empty($treemap_words['children']))
			$treeInfo['children'][3] = $treemap_words;
		
		//now its 10 greatest to least
		//$shortened_result = array_slice($result, 0, 10);
	
		return $result;
		$this->result = $shortened_result;
	}//end prioritize


	public function print_shortened_result(){
		echo "<pre>";
		print_r($this->result);
		echo "<pre>";		
	}

	public function build_snapshot_and_data(){
		
		/*
		 * The implementation of the function is only an example of how to extract data of trends so that you can build html or json if need be
		 * 
		 */
		
		$this->create_snapshot();
		
		$html = "";
		
		$saved_images = array();
		
		foreach($this->result as $word => $score){
			//for each word
			
			switch($word[0]){//first character
				
				case "@"://mention
					$type = 1;
					$users = $this->user_mentions[$word];
					$freq = $this->discover_mentions[$word];
				break;
					
				case "#"://hashtag
					$type = 0;
					$users = $this->user_hashtags[$word];
					$freq = $this->discover_hashtags[$word];
				break;
					
				default://word(s)
				
					if(strpos($word, " ") > 0){
						//is phrase	
						$type = 2;
						$freq = $this->discover_phrases[$word];
						$users = $this->user_phrases[$word];
					
					}else{
						//is single word
						$type = 2;
						$freq = $this->discover_words[$word];
						$users = $this->user_words[$word];						
					}

				break;
			}
			
			$num_unique_users = count($users);

			$trend_id = $this->create_trend($type, $word, $score, $freq);
			
			$html .= "<tr class='trend trendNum_$trend_id' onClick='whosTrendingByID($trend_id);return false;'><td class='text'><span class='trend_draggable' id='$trend_id'>$word</span></td><td class='rtg'>".round($score)."</td><td class='ct'>$freq</td></tr>";
			
			$users_tweeted = array();
			foreach($users as $screen_name => $count){
				//$html .= "<tr class='data_on_trend data_trend_$trend_id'><td colspan='2' class='whos_trending'>@$screen_name</td><td>$count</td></tr>";
				array_push($users_tweeted, array("screen_name" =>$screen_name, "count" => $count));
			}
			
			
			$this->create_trending_tweets($trend_id, $this->associated_tweets[$word]);
		}//foreach trend as word and score
				
		//echo $hmtl;
		
		echo $html;
		
	}
	
	
	
	public function build_share_key(){
		$key = $this->snapshot_share_key;
		echo "<input type='hidden' name='transfering_data' id='snapshot_share_key' value='$key' />";
	}
	
	public function create_snapshot(){
		//user_id
		$user_id = $this->user_id;
		
		//create token key
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		$size = strlen( $chars );
		$key = "";
		for( $i = 0; $i < 15; $i++ ) {
			$key .= $chars[ rand( 0, $size - 1 ) ];
		}
		
		$this->query("INSERT INTO snapshots (`user_id`,`datetime`,`method`,`share_key`) VALUES ('$user_id', NOW(),'0','$key')");
		
		$this->snapshot_id = mysql_insert_id();
		$this->snapshot_share_key = $key;
		return true;
	}
	
	
	
	public function create_trend($type, $text, $score, $count){
		$snapshot_id = $this->snapshot_id;
		$this->query("INSERT INTO trends (`snapshot_id`,`score`,`count`,`text`,`type`) VALUES ('$snapshot_id','$score','$count','$text','$type')");
		return mysql_insert_id();
	}
	
	
	public function create_trending_tweets($trend_id, $data){
		
		$insert = "";
		$x = 0;
		
		if(!is_array($data)){
			echo "not an array!";
			
			$this->print_associations();
			die();
			return;
		}
		
		
		foreach($data as $tweet){
			
			if($x > 0){
				$insert .= ",";
			}
			
			$tweet_id = $tweet["tweet_id"];
			$name = str_replace("'","", $tweet["name"]);
			$s_name = $tweet["screen_name"];
			$text = mysql_real_escape_string(str_replace("'","", $tweet["tweet"]));
			$unix = $tweet["created_at"];
			$image = $tweet["image"];
			
			
			$insert .= "('$trend_id','$tweet_id','$name','$s_name','$text','$unix','$image')";
			
			$x++;
		}
		
		$this->query("INSERT DELAYED INTO trending_tweets (`trend_id`,`twitter_tweet_id`,`twitter_name`,`twitter_screen_name`,`tweet`,`tweet_datetime`,`twitter_image`) VALUES $insert");
		
	}
	
	
	
	public function print_result(){
		echo "<pre>";
		print_r($this->result);
		echo "</pre>";		
	}
	
	
	public function print_associations(){
		echo "<pre>";
		print_r($this->associated_tweets);
		echo "</pre>";
	}
	
	public function register_array_error(){
		$this->error = 1;
	}
	
}
