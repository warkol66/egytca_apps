<fieldset>
<div>
	<p><form method="post" enctype="multipart/form-data" action="Main.php?do=headlinesXMLDoParseX">
		<p>
			<input type="radio" name="type" value="web" /> web
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
<div>
|-foreach $logEntries as $entry-|
	<p>
		|-$entry->getCreatedAt()-| - status: |-$entry->getStatus()-|
		&nbsp;
		<input type="button" value="parse" onclick="parseFeed(|-$entry->getId()-|)"/>
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