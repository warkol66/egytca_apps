|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|

estos numeros en cambio son la cantidad de entidades asociadas de cada tipo<br />
tengo que revisar como filtrar los MANY_TO_MANY asique por ahora no los incluyo<br/>
|-foreach from=$relatedEntities key=relatedEntityType item=relatedEntity-|
	|-$relatedEntityType-|: |-$relatedEntity->count()-|<br />
|-/foreach-|

|-/if-|