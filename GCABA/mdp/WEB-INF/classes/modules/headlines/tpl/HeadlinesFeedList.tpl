<fieldset>
|-foreach $logEntries as $entry-|
	<p>
		|-$entry->getCreatedAt()-| - status: |-$entry->getStatus()-|
		&nbsp;
		<input type="button" value="parse" onclick="parseFeed(|-$entry->getId()-|)"/>
	</p>
|-/foreach-|
</fieldset>
<script>
	parseFeed = function(id) {
		alert('implementar!');
//		new Ajax.Request(
//			'Main.php?do=xxxx',
//			{
//				method: 'post'
//				, parameters: { id: id }
//			}
//		);
	}
</script>