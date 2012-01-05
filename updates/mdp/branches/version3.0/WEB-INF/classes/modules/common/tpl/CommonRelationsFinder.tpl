|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|

|-foreach from=$relatedEntities key=relatedEntityType item=relatedEntitys-|
	|-$relatedEntityType-|: |-$relatedEntitys->count()-|<br />
|-/foreach-|

|-/if-|