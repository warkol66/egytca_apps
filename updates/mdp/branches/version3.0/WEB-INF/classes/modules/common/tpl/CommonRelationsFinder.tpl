|-assign var=totalCount value=0-|
|-foreach from=$relatedEntities key=relatedEntitiesType item=relatedEntitiesSubgroup-|
	|-assign var=totalCount value=$totalCount+$relatedEntitiesSubgroup->count()-|
	|-if $relatedEntitiesSubgroup->count() gt 0-|
		<div>Hay |-$relatedEntitiesSubgroup->count()-| |-$relatedEntitiesType-| asociados.</div>
		<p><a href=# id="show_|-$relatedEntitiesType-|" onclick="loadRelatedEntitiesContent('|-$relatedEntitiesType-|'); this.hide(); $('|-$relatedEntitiesType-|_content').show(); return false;">Ver</a></p>
		<div id="|-$relatedEntitiesType-|_content" style="display:none">
			<p><a href=# id="hide_|-$relatedEntitiesType-|_1" onclick="$('|-$relatedEntitiesType-|_content').hide(); $('show_|-$relatedEntitiesType-|').show(); return false;">Ocultar</a></p>
			<div id="|-$relatedEntitiesType-|_content_include"></div>
			<p><a href=# id="hide_|-$relatedEntitiesType-|_2" onclick="$('|-$relatedEntitiesType-|_content').hide(); $('show_|-$relatedEntitiesType-|').show(); return false;">Ocultar</a></p>
		</div>
	|-/if-|
	|-if $totalCount eq 0-|
		<div>No hay entidades asociadas.</div>
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
					entity: relatedEntitiesType,
					relatedEntity: '|-$entityType-|',
					relatedId: '|-$entityId-|'
				}
			}
		);
	}
</script>