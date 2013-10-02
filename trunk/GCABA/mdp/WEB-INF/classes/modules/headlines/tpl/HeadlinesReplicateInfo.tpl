|-if $invalidId-|
	<div class="resultFailure">El titular solicitado no existe. Seleccione uno del campo</div>
|-elseif $notProcessed-|
	<div class="resultFailure">El titular solicitado no está procesado. Seleccione uno del campo</div>
|-/if-|
|-include file="CommonAutocompleterInclude.tpl"-|
	<fieldset>
		<Legend>Copiar información de titular</legend>
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
	|-if $headlineFrom-|
	|-assign var=issues value=$headlineFrom->getIssues()-|
	|-assign var=actors value=$headlineFrom->getActors()-|
	|-assign var=headlineTags value=$headlineFrom->getHeadlineTags()-|
	<p>
		<label>Valoración:</label> |-$headlineValues[$headlineFrom->getValue()]-|&nbsp; &nbsp;
		<strong>Relevancia:</strong> |-$headlineRelevances[$headlineFrom->getRelevance()]-|&nbsp; &nbsp;
		<strong>Ámbito:</strong> |-$headlineScopes[$headlineFrom->getHeadlinescope()]-|&nbsp; &nbsp;
		<strong>Agenda:</strong> |-$headlineAgendas[$headlineFrom->getAgenda()]-|
	</p>
	<p>
		<label>Temas:</label> |-foreach $issues as $issue-||-if !$issue@first-|, |-/if-||-$issue-||-/foreach-|.&nbsp; &nbsp;
		<strong>Actores:</strong> |-foreach $actors as $actor-||-if !$actor@first-|, |-/if-||-$actor-||-/foreach-|.
	</p>
	<p>
		<label>Etiquetas:</label> |-foreach $headlineTags as $headlineTag-||-if !$headlineTag@first-|, |-/if-||-$headlineTag-||-/foreach-|.
	</p>
	|-/if-|
	<p>
		<label>Buscar titulares a copiar</label>
	</p>
	<p>
		<label>Buscar por texto</label>
		<input name="text" type="text" size="60" value="|-$text-|"> &nbsp; <label for="processed" class="inlineLabel">Incluir procesados</label>
					<input id="processed" name="processed" type="checkbox" value="1" |-$processed|checked_bool-| title="Incluir resultados con cualquier procesamiento" />
	</p>
	<p>
		<label>&nbsp;</label><input type="submit" value="Obtener titulares a copiar">
		<input type='button' id='button_return' value='Regresar al titular' onClick='location.href="Main.php?do=headlinesEdit&id=|-$id-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && $page gt 0-|&page=|-$page-||-/if-|"' />
				|-include file="HiddenInputsInclude.tpl" filters="$filters" page="$page"-|
	</p>
</form>
|-if $headlineFrom-|
	|-capture "statusIcons"-|
		<img class="resultStatus yes" style="display: none;" src="images/icon_yes.png">
		<img class="resultStatus no" style="display: none;" src="images/icon_no.png">
		<img class="resultStatus waiting" style="display: none;" src="images/icon_spinner.gif">
	|-/capture-|
	<fieldset>
		<Legend>Filtros</legend>
		<form onsubmit="return false;">
			<p>
				<label>Texto</label>
				<input type="text" onkeyup="filterHeadlines('Text', this.value)" size="60">
			</p>
		</form>
	</fieldset>
	</fieldset>
	<fieldset>
		<form method="POST" action="Main.php" onsubmit="return false;">
			<input type="hidden" name="idFrom" value="|-$headlineFrom->getId()-|">
			<table border="0" cellpadding="0" cellspacing="8">
				<tr id="headlineTo-all">
					<td width="20">|-$smarty.capture.statusIcons-|</td>
					<td><input type="button" class="replicateButton icon iconCopy" onclick="replicateIntoAll(this.form);" title="Copiar datos a todos los titulares visibles" /></td>
					<td valign="bottom"><strong>Copiar a todos los titulares visibles </strong></td>
				</tr>
				<tr>
					<td height="1"></td>
					<td height="1" colspan="2" bgcolor="#333333"></td>
				</tr>
				|-foreach $headlinesTo as $headlineTo-|
					<tr id="headlineTo-|-$headlineTo->getId()-|">
						<td valign="top">|-$smarty.capture.statusIcons-|</td>
						<td valign="top">
							<input type="hidden" name="idTo[]" value="|-$headlineTo->getId()-|">
							<input type="button" class="replicateButton icon iconCopy" onclick="replicateInto(|-$headlineTo->getId()-|);" title="Copiar datos a este titular" />
						</td>
						<td valign="top"><strong>|-$headlineTo->getName()-| || |-if $headlineTo->getMediaId() eq 0-||-$headlineTo->getMediaName()-||-else-||-$headlineTo->getMedia()-||-/if-| || |-$headlineTo->getdatePublished()|change_timezone|date_format-|</strong><br>
						|-if $headlineTo->getContent()|mb_count_characters gt 300-|
			|-$headlineTo->getContent()|mb_truncate:295:" ... ":'UTF-8':true|highlight:$tags:highlight-|
				<img id="imgMore|-$headlineTo->getId()-|" src="images/clear.png" onClick="$('more|-$headlineTo->getId()-|').toggle();$('imgMore|-$headlineTo->getId()-|').toggleClassName('inlineLink readLess')" class="inlineLink readMore" title="Ver/Ocultar texto" /><span id="more|-$headlineTo->getId()-|" style="display: none ">|-$headlineTo->getContent()|mb_substr:290:5000:'UTF-8'|highlight:$tags:highlight-|</span>
			|-else-|
				|-$headlineTo->getContent()|highlight:$tags:highlight-|
			|-/if-|</td>
					</tr>
				|-/foreach-|
				|-if $headlinesTo->count() eq 50-|
				<tr>
					<th colspan="3">Se muestran los primeros 50 resultados, si la repercusión que busca no se muestra, debe refinar la búsqueda.</th>
				</tr>
				|-/if-|
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
			
			if (confirm('¿Está seguro que quiere replicar la información en todos los headlines listados?')) {
				
				showWaitingStatus('headlineTo-all')
			
				new Ajax.Request('Main.php?do=headlinesDoReplicateInfoX', {
					method: 'POST',
					parameters: Form.serialize(form),
					onSuccess: function(data) {
						updateResultStatus('headlineTo-all', hasErrors(data));
						if (!hasErrors(data))
							$('headlineTo-all').select('.replicateButton').first().disable();
					}
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
				onSuccess: function(data) {
					updateResultStatus('headlineTo-'+id, hasErrors(data));
					if (!hasErrors(data))
						$('headlineTo-'+id).select('.replicateButton').first().disable();
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
