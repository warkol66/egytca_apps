|-if $invalidId-|
	<p style="color:red">el headline solicitado no existe. seleccione uno de la lista?</p>
|-/if-|
<p>ponemos acá algún método para elegir el headline a copiar?</p>
<p>mientras, para desarrollar pongo un select</p>
<form method="GET" action="Main.php">
	<input type="hidden" name="do" value="headlinesRenameMe">
	<select name="id">
		|-foreach $allHeadlines as $headline-|
			<option value="|-$headline->getId()-|" |-if $headlineFrom-||-$headline->getId()|selected:$headlineFrom->getId()-||-/if-|>
				|-$headline->getName()-|
			</option>
		|-/foreach-|
	</select>
	<input type="submit">
</form>
|-if $headlineFrom-|
	<hr>
	<fieldset>
		<p>filtros</p>
		<form onsubmit="return false;">
			<p>
				<label>Título</label>
				<input type="text" onchange="filterHeadlines('Name', this.value)">
			</p>
		</form>
	</fieldset>
	<fieldset>
		<form method="POST" action="Main.php" onsubmit="console.log('submit', Form.serialize(this)); return false;">
			<input type="hidden" name="do" value="headlinesNeedANameWithDo">
			|-capture "copyHeadlinesButton"-|
				<input type="submit" value="copiar">
			|-/capture-|
			|-$smarty.capture.copyHeadlinesButton-|
			<table>
				<tr><td><input type="checkbox" onchange="setAllCheckboxes(this.checked);"></td></tr>
				|-foreach $allHeadlines as $headlineTo-|
					<tr id="headlineTo-|-$headlineTo->getId()-|">
						<td><input class="copyCheckbox" type="checkbox" name="id[]" value="|-$headlineTo->getId()-|"></td>
						<td>|-$headlineTo->getName()-|</td>
					</tr>
				|-/foreach-|
			</table>
			|-$smarty.capture.copyHeadlinesButton-|
		</form>
	</fieldset>

	<script>
		
		var headlines;
		var filters = {
			Name: {
				value: '',
				filterOut: function(headline) {
					return !headline.Name.match(this.value, 'i');
				}
			}
		};
		
		Event.observe(window, 'load', function() {
			headlines = |-$allHeadlines->toJSON()-|;
		});
		
		function filterHeadlines(filterName, filterValue) {
			filters[filterName].value = filterValue;
			applyHeadlinesFilters();
		}
		
		function applyHeadlinesFilters() {
			
			for (var key in headlines) {
				var headline = headlines[key];
				if (mustFilterHeadlineOut(headline))
					filterHeadlineOut(headline);
				else
					filterHeadlineIn(headline);
			}
		}
		
		function mustFilterHeadlineOut(headline) {
			for (var name in filters) {
				if (filters[name].filterOut(headline))
					return true;
			}
			return false;
		}
		
		function filterHeadlineOut(headline) {
			$('headlineTo-'+headline.Id).hide()
				.select('.copyCheckbox').first()
				.disable();
		}
		
		function filterHeadlineIn(headline) {
			$('headlineTo-'+headline.Id).show()
				.select('.copyCheckbox').first()
				.enable();
		}
		
		function setAllCheckboxes(value) {
			$$('.copyCheckbox:enabled').each(function(e, i) {
				e.checked = value;
			});
		}
		
	</script>
|-/if-|
