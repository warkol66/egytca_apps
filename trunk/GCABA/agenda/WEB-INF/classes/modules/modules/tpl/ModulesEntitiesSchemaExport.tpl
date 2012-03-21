<database defaultIdMethod="native" package="|-$moduleName-|.classes" name="application" >

|-foreach from=$entities item=entity-|
|-$entity->getTableSchema()-|
|-if $entity->getSaveLog()-|
|-$entity->getTableSchema(true)-|
|-/if-|
|-/foreach-|

</database>