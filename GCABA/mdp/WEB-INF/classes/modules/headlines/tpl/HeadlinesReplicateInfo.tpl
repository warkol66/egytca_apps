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
	<input type="submit" value="Ir">
</form>
|-if $headlineFrom-|
	|-capture "statusIcons"-|
		<img class="resultStatus yes" style="display: none;" src="images/icon_yes.png">
		<img class="resultStatus no" style="display: none;" src="images/icon_no.png">
		<img class="resultStatus waiting" style="display: none;" src="images/icon_spinner.gif">
	|-/capture-|
	<fieldset>
		<p>filtros</p>
		<form onsubmit="return false;">
			<p>
				<label>Texto</label>
				<input type="text" onkeyup="filterHeadlines('Text', this.value)">
			</p>
		</form>
	</fieldset>
	<fieldset>
		<form method="POST" action="Main.php" onsubmit="return false;">
			<input type="hidden" name="idFrom" value="|-$headlineFrom->getId()-|">
			<table>
				<tr id="headlineTo-all">
					<td>|-$smarty.capture.statusIcons-|</td>
					<td><input type="button" class="icon iconAdd" onclick="replicateIntoAll(this.form);"></td>
					<td><b>Todos</b></td>
				</tr>
				|-foreach $headlinesTo as $headlineTo-|
					<tr id="headlineTo-|-$headlineTo->getId()-|">
						<td>|-$smarty.capture.statusIcons-|</td>
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
		
		function hasErrors(data) {
			try {
				var jsonData = JSON.parse(data.responseText);
				return jsonData.errors !== null;
			} catch(e) {
				return true;
			}
		}
		
		function updateResultStatus(elemId, error) {
			
			var selector = error ? '.resultStatus.no' : '.resultStatus.yes';
			$(elemId).select('.resultStatus').each(function(e, i) { e.hide(); });
			$(elemId).select(selector).first().show();
		}
		
		function showWaitingStatus(elemId) {
			$(elemId).select('.resultStatus').each(function(e, i) { e.hide(); });
			$(elemId).select('.resultStatus.waiting').first().show();
		}
		
		function replicateIntoAll(form) {
			
			if (confirm('seguro que quiere replicar la información en todos los headlines listados?')) {
				
				showWaitingStatus('headlineTo-all')
			
				new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
					method: 'POST',
					parameters: Form.serialize(form),
					onSuccess: function(data) { updateResultStatus('headlineTo-all', hasErrors(data)); }
				});
			}
		}
		
		function replicateInto(id) {
		
			showWaitingStatus('headlineTo-'+id);
			
			new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
				method: 'POST',
				parameters: {
					idFrom: |-$headlineFrom->getId()-|,
					idTo: id
				},
				onSuccess: function(data) { updateResultStatus('headlineTo-'+id, hasErrors(data)); }
			});
		}
		
		var headlines;
		var filters = {
			Name: {
				value: '',
				filterOut: function(headline) {
					return !headline.Name.match(this.value, 'i');
				}
			},
			Text: {
				value: '',
				filterOut: function(headline) {
			
					var value = this.value;
					var filterOut = true;
					
					['Name', 'Content', 'Author'].each(function(e, i){
						if (headline[e].match(value, 'i'))
							filterOut = false;
					});
					
					return filterOut;
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
