|-if $type eq 'json'-|
    {
        |-foreach $regions as $region-|
            "|-json_encode($region->getId())-|": |-json_encode($region->getName())-|
            |-if !$region@last-|,|-/if-|
        |-/foreach-|
    }
|-else-|
<ul>
    |-if count($regions) == 0-|
        <b>No hay resultados que coincidan</b>
    |-else-|
        |-foreach from=$regions item=region-|
            <li id="|-$region->getId()-|">|-$region-|</li>
        |-/foreach-|
        |-if count($region) == $limit-|
            <b>Está viendo los primeros |-$limit-| resultados</b>
        |-/if-|
    |-/if-|
</ul>
|-/if-|
