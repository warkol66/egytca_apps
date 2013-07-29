|-if $type eq 'json'-|
    {
        |-foreach $actions as $action-|
            "|-json_encode($action->getAction())-|": |-json_encode($action->getAction())-|
            |-if !$action@last-|,|-/if-|
        |-/foreach-|
    }
|-else-|
<ul>
    |-if count($actions) == 0-|
        <b>No hay resultados que coincidan</b>
    |-else-|
        |-foreach from=$actions item=action-|
            <li id="|-$action->getAction()-|">|-$action->getAction()-|</li>
        |-/foreach-|
        |-if count($actions) == $limit-|
            <b>Está viendo los primeros |-$limit-| resultados</b>
        |-/if-|
    |-/if-|
</ul>
|-/if-|
