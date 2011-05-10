|-if $url-|<div id="caseView"><h3>|-$studycase->getTitle()-|</h3>
<h2>|-$studycase->getReference()-|</h2> 
|-$studycase->getDescription()-|
<div id="commandLine"><a href="Main.php?do=|-$url-|" class="white_arrowBack" title="Regresar al listado de experiencias"></a></div></div>
|-else-|
<h3>|-$studycase->getTitle()-|<br />|-$studycase->getReference()-|</h3> 
|-$studycase->getDescription()-|
|-/if-|
