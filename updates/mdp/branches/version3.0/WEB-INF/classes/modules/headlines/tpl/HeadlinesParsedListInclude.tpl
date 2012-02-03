<script language="JavaScript" type="text/javascript">
	$("resultDiv").innerHTML = '';
</script>
|-if $headlinesParsed|count gt 0-|
    |-foreach from=$headlinesParsed item=headline name=for_headlines-|
    <li id="li_|-$headline->getId()-|"><a href="#lightbox1" rel="lightbox1" class="lbOn">
		<img src="images/clear.png" class="icon iconView" onClick='{new Ajax.Updater("viewDiv", "Main.php?do=headlinesParsedViewX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">buscando titular...</span>";' value="Ver titular" /></a>
		<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titular...</span>";' value="Descartar titular" /></a>
		<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";' value="Guardar titular" /></a>
		|-$headline->getName()-|<ul><li><strong>|-if $headline->getMediaId() eq 0-||-$headline->getMediaName()-||-else-|
		  |-$headline->getMedia()-||-/if-| -- </strong>|-$headline->getMedia()-||-$headline->getContent()-|</li></ul></li>
    |-/foreach-|
<script language="JavaScript" type="text/javascript">
	if($('noHeadlines'))
		$('noHeadlines').innerHTML = '';
</script>
|-else-|
<li id="noHeadlines">|-if $included-|No hay Titulares por procesar|-else-|No hay más Titulares disponibles|-/if-|</li>
|-/if-|
