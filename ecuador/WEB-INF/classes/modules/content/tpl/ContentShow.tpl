<div id="contentBody">
|-if !isset($notValidId) or  $notValidId neq 1-|

<div id="titleContent">|-$content->getTitle()-|</div>
|-$content->getBody()-|

 |-else-|
    <div class="errorMessage">El identificador de contenido ingresado no es válido. </div>
|-/if-|
</div>