|-include file="CommonAutocompleterInclude.tpl"-|
|-if $invalidId-|
	<p style="color:red">el headline solicitado no existe. seleccione uno del campo</p>
|-/if-|
<form method="GET" action="Main.php">
	<input type="hidden" name="do" value="headlinesReplicateInfo">
	|-if $headlineFrom-|
		|-$defaultValue=$headlineFrom->getName()-|
		|-$defaultHiddenValue=$headlineFrom->getId()-|
	|-/if-|
	|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" hiddenName="id"
		id="autocomplete_headlineFromId" label="Titular"
		url="Main.php?do=headlinesAutocompleteListX&processed=1"
		defaultValue=$defaultValue defaultHiddenValue=$defaultHiddenValue
	-|
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
				<tr>
					<td><input type="button" class="icon iconAdd" onclick="replicateIntoAll(this.form);"></td>
					<td><b>Todos</b></td>
				</tr>
				|-foreach $headlinesTo as $headlineTo-|
					<tr id="headlineTo-|-$headlineTo->getId()-|">
						<td>
							<input class="data" type="hidden" name="idTo[]" value="|-$headlineTo->getId()-|">
							<input type="button" class="icon iconAdd"
								onclick="replicateInto(this.parentNode.select('.data').first().value);">
						</td>
						<td>|-$headlineTo->getName()-|</td>
					</tr>
				|-/foreach-|
			</table>
		</form>
	</fieldset>

	<script>
		
		function replicateIntoAll(form) {
			if (confirm('seguro que quiere replicar la información en todos los headlines listados?')) {
				new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
					method: 'POST',
					parameters: Form.serialize(form)
				});
			}
		}
		
		function replicateInto(id) {
			new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
				method: 'POST',
				parameters: {
					idFrom: |-$headlineFrom->getId()-|,
					idTo: id 
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
				.select('input').each(function(e, i){
					e.disable();
				});
		}
		
		function filterHeadlineIn(headline) {
			$('headlineTo-'+headline.Id).show()
				.select('input').each(function(e, i){
					e.enable();
				});
		}
		
	</script>
|-/if-|
