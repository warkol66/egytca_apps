<h2>Titulares</h2>
<h1>Procesar manualmente feed de noticias</h1>
<p>A continuación puede subir un feed o reprocesar alguno existente en el servidor.</p>
<div id="resultDiv"></div>
<ul id="list" class="iconList">
</ul>
<fieldset>
<div>
	<p><form method="post" enctype="multipart/form-data" action="Main.php?do=headlinesXMLDoParseX">
		<p>Subir archivo de noticias, indicar el tipo</p>
			<p><input type="radio" name="type" value="web" /> web
			&nbsp;
			<input type="radio" name="type" value="press" /> prensa
			&nbsp;
			<input type="radio" name="type" value="multimedia" /> multimedia
		</p>
		<input name="file" id="file" size="27" type="file" />
		&nbsp;
		<input type="submit" name="action" value="Upload" />
	</form></p>
</div>
<p>---------------------------------------------</p>
<div><p>Feeds de noticias disponibles en el servidor</p>
|-foreach $logEntries as $entry-|
	<p>
		|-$entry->getCreatedAt()|dateTime_format-| Tipo: |-$entry->getHeadlineType()-| - status: |-$entry->getStatus()-| |-if $entry->getStatus() eq "success"-|Resultado: [ Parseados: |-$entry->getparsedCount()-| | Creados: |-$entry->getcreatedCount()-| | Existentes: |-$entry->getexistentCount()-| | Inválidos: |-$entry->getinvalidCount()-| ]
		&nbsp;
		<input type="button" value="Reprocesar" onclick="parseFeed(|-$entry->getId()-|)"/>|-/if-|
	</p>
|-/foreach-|
</div>
<p>---------------------------------------------</p>
<div>
	<div id="resultDiv"></div>
	<ul id="list" class="iconList">
		|-include
			file="HeadlinesParsedListInclude.tpl"
			included=true
			headlinesParsed=$headlineParsedColl
		-|
	</ul>
</div>
</fieldset>

<script>
	parseFeed = function(id) {
		
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando titulares...</span>";
		if (document.getElementById("noHeadlines"))
			$("noHeadlines").innerHTML = "";
		new Ajax.Updater(
			'list',
			'Main.php?do=headlinesXMLDoParseX',
			{
				method: 'post'
				, parameters: { logentryid: id }
				, evalScripts: true
			}
		);
	}
</script>