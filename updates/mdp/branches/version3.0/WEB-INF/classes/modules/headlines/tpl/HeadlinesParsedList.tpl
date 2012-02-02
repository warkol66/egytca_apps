<h2>Titulares</h2>
<h1>Importar Titulares - |-$campaign-|</h1>
<div id="lightbox1" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a></p> 
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv"></div>
</div></div> 
<fieldset>
<legend>Obtener Titulares</legend>
    <form id="form" action="Main.php?do=headlinesDoParseX" method="POST">
        <input name="campaignId" value="|-$campaignId-|" type="hidden" />
 <p><label for="q">Palabras clave</label>
 <input name="q" value="" size="60" />
 <input type="button" id="search_button" onclick="return false;" value="Buscar" />
 <input type="button" id="return_button" onclick="location.href='Main.php?do=headlinesList'" value="Regresar al listado" />
 </p> 
    </form>
</fieldset>
<div id="resultDiv"></div>
<fieldset>
<legend>Titulares</legend>
<ul id="list" class="iconOptionsList">
|-include file="HeadlinesParsedListInclude.tpl" included=true-|
</ul>
</fieldset>
<script type="text/javascript">
$("search_button").observe('click', function(event) {
    new Ajax.Updater('list', "Main.php?do=headlinesDoParseX", {
        parameters: $('form').serialize(),
        insertion: 'top',
				evalScripts: true
    });
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando titulares...</span>";
		if (document.getElementById("noHeadlines"))
			$("noHeadlines").innerHTML = "";
});
</script>
