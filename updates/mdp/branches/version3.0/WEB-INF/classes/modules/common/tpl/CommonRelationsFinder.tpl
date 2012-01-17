<h2>Buscador</h2>
<h1>Buscador de Relaciones</h1>
|-if !$entity-|
|-include file="CommonAutocompleterInclude.tpl" -|
<p>Seleccione el tipo de entidad y busque las relaciones con otras entidades en el sistema</p>
<fieldset>
<legend>Seleccione</legend>
<form method="get">
 Actores <input name="entityType" type="radio" value="Actor" onclick="$('searchActor').show();$('searchIssue').hide();$('searchHeadline').hide(); selectForSubmit('searchActor');" />
 Asuntos <input name="entityType" type="radio" value="Issue" onclick="$('searchActor').hide();$('searchIssue').show();$('searchHeadline').hide(); selectForSubmit('searchIssue');" />
 Titulares <input name="entityType" type="radio" value="Headline" onclick="$('searchActor').hide();$('searchIssue').hide();$('searchHeadline').show(); selectForSubmit('searchHeadline');" />		 
		<div id="searchActor" style="position: relative;z-index:12000;display:none;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Nombre del actor" url="Main.php?do=actorsAutocompleteListX" hiddenName="entityId"-|
		</div>
		<div id="searchIssue" style="position: relative;z-index:11000;display:none;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" label="Nombre del asunto" url="Main.php?do=issuesAutocompleteListX" hiddenName="entityId"-|
		</div>
		<div id="searchHeadline" style="position: relative;z-index:10000;display:none;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_headlines" label="Nombre del titular" url="Main.php?do=headlinesAutocompleteListX" hiddenName="entityId"-|
		</div>
<input type="hidden" name="do" value="commonRelationsFinder" />
<p><input type="submit" value="Buscar" /></p>
</form>
</fieldset>
			
<script type="text/javascript">
	
	function selectForSubmit(containerId) {
		var elements = document.getElementsByName('entityId');
		
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].descendantOf(containerId))
				elements[i].enable();
			else
				elements[i].disable();
		}
		
	}
	
</script>
			
|-else-|
<p>Relación de entidades con: <strong>"|-$entity-|"</strong></p>
|-assign var=totalCount value=0-|
|-foreach from=$relatedEntities key=relatedEntitiesType item=relatedEntitiesSubgroup-|
	|-assign var=totalCount value=$totalCount+$relatedEntitiesSubgroup->count()-|
	|-if $relatedEntitiesSubgroup->count() gt 0-|
		<p>Hay |-$relatedEntitiesSubgroup->count()-| |-$relatedEntitiesType-| asociados. &nbsp;&nbsp; 
		<a href=# id="show_|-$relatedEntitiesType-|" onclick="loadRelatedEntitiesContent('|-$relatedEntitiesType-|'); this.hide(); $('|-$relatedEntitiesType-|_content').show(); return false;" class="icon iconView inlineTable">Ver</a></p>
		<div id="|-$relatedEntitiesType-|_content" style="display:none;">
			<p><a href=# id="hide_|-$relatedEntitiesType-|_1" onclick="$('|-$relatedEntitiesType-|_content').hide(); $('show_|-$relatedEntitiesType-|').show(); return false;">Ocultar</a></p>
			<div id="|-$relatedEntitiesType-|_content_include" style="border:1px solid black;padding:5px;"></div>
			<p><a href=# id="hide_|-$relatedEntitiesType-|_2" onclick="$('|-$relatedEntitiesType-|_content').hide(); $('show_|-$relatedEntitiesType-|').show(); return false;">Ocultar</a></p>
		</div>
	|-/if-|
	|-if $totalCount eq 0-|
		<p>No hay entidades asociadas.</p>
	|-/if-|
|-/foreach-|

<script type="text/javascript">
	function loadRelatedEntitiesContent(relatedEntitiesType) {
		new Ajax.Updater(
			relatedEntitiesType+'_content_include',
			'Main.php?do=commonSearch'+relatedEntitiesType+'ListX',
			{
				method: 'get',
				parameters: {
					relatedEntity: '|-$entityType-|',
					relatedId: '|-$entityId-|'
				}
			}
		);
	}
</script>
<input type="button" onClick="location.href='Main.php?do=commonRelationsFinder'" value="Realizar otra búsqueda" />
 |-/if-|
