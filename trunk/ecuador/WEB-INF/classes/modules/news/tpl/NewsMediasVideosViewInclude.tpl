|-assign var=video value=$newsarticle->getVideos()-|
|-assign var=videoId value=$video[0]-|
|-*$videoId->getId()*-|
		<!-- player is initially loaded with splash screen and play button -->
	<a id="player">
		<img src="img/bk.png" />
		<div class="play"></div>
	</a>

	<!-- this is our playlist -->
	<div id="playlist">

		|-foreach from=$newsarticle->getVideos() item=video name=videos-|
		<a href="/video/|-$video->getId()-|.flv">
			<span class="playItem">|-if $video->getTitle() ne ''-|<strong>|-$video->getTitle()-|: </strong>|-/if-||-$video->getDescription()-| (video)</span>		
			<span class="time"></span>
		</a>		
		|-/foreach-|
		|-foreach from=$newsarticle->getSounds() item=sound name=sound-|
		<a href="/audio/|-$sound->getId()-|.mp3">
			<div class="playItem">|-if $sound->getTitle() ne ''-|<strong>|-$sound->getTitle()-|: </strong>|-/if-||-$sound->getDescription()-| (audio)</div>		
			<div class="time"></div>
		</a>		
		|-/foreach-|		

	</div>

	<!-- clear floatings -->
	<br clear="all" />
	
	<script type="text/javascript"> 

	// Flowplayer configuration (less buttons and wicked background color) 
var playerConfig = { 
   initialScale:'scale', 
   showMenu:false, 
   showVolumeSlider:true, 
   showMuteVolumeButton:true, 
   showFullScreenButton:true, 
   controlBarGloss:'high'
} 


function initVideoPlayer() { 

   // variable that holds the player API. it is initially null 
   var flowplayer = null;  

   /************* THE PLAYLIST ***************/ 

   // loop all links within DIV#playlist and customize their onClick event  
   var links = document.getElementById("playlist").getElementsByTagName("a");  

   for (var i = 0; i < links.length; i++) { 

	  links[i].onclick = function() {  

		 /* 
		  * set links href attribute as the videoFile property in our  
		  * configuration. of cource you can modify other properties as well 
		  */ 
		 playerConfig.videoFile = this.getAttribute("href"); 
		 
		 //if (this.getAttribute("class") == "sound")
			 //playerConfig.type = 'mp3'; 

		 // if flowplayer is not loaded. load it now. 
		 if (flowplayer == null) { 

			// create Flowplayer instance into DIV element whose id="player" 
			// Flash API is automatically returned (flashembed.js ver. 0.27) 
			flowplayer = flashembed("player",  
			   {src:"swf/FlowPlayerDark.swf", bgcolor:'#6F7485',loop:false},  

			   // supply our (modified) configuration to the player 
			   {config: playerConfig} 
			);  

		 // flowplayer is already loaded - now we simply call setConfig() 
		 } else {     
			flowplayer.setConfig(playerConfig);  
		 } 

		 // disable link's default behaviour 
		 return false;  
	  }      
   } 

   // when clicks on the player it triggers our first playlist entry 
   document.getElementById("player").onclick = function()  { 
	  links[0].onclick(); 
   } 

}

Behaviour.addLoadEvent(initVideoPlayer);

	</script>  