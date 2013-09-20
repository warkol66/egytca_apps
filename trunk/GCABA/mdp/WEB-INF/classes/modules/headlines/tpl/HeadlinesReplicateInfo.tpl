|-if $invalidId-|
	<p style="color:red">el headline solicitado no existe. seleccione uno de la lista?</p>
|-/if-|
<form method="GET" action="Main.php">
	autocomplete aca
	<input type="submit">
</form>
|-if $headlineFrom-|
	<hr>
	<fieldset>
		<p>filtros</p>
		<form onsubmit="return false;">
			<p>
				<label>Título</label>
				<input type="text" onkeyup="filterHeadlines('Name', this.value)">
			</p>
		</form>
	</fieldset>
	<fieldset>
		<form method="POST" action="Main.php" onsubmit="return false;">
			<input type="hidden" name="idFrom" value="|-$headlineFrom->getId()-|">
			<table>
				<tr><td><input type="checkbox" onchange="replicateIntoAll(this);"></td></tr>
				|-foreach $headlinesTo as $headlineTo-|
					<tr id="headlineTo-|-$headlineTo->getId()-|">
						<td>
							<input class="copyCheckbox" type="checkbox" name="idTo[]"
								   value="|-$headlineTo->getId()-|" onchange="replicateInto(this)">
						</td>
						<td>|-$headlineTo->getName()-|</td>
					</tr>
				|-/foreach-|
			</table>
		</form>
	</fieldset>

	<script>
		
		function replicateIntoAll(checkbox) {
			if (confirm('seguro?')) {
				setAllCheckboxes(checkbox.checked);
				new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
					method: 'POST',
					parameters: Form.serialize(checkbox.form)
				});
			}
			else {
				checkbox.checked = !checkbox.checked; // revierto el cambio de estado
			}
		}
		
		function replicateInto(checkbox) {
			new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
				method: 'POST',
				parameters: {
					'idFrom': |-$headlineFrom->getId()-|,
					'idTo[]': checkbox.value 
				}
			});
		}
		
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
			headlines = |-$headlinesTo->toJSON()-|;
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
