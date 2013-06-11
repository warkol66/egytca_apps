|-if $type eq 'json'-|
    {
        |-foreach $users as $user-|
            "|-json_encode($user->getId())-|": |-json_encode($user->getName()|cat:' '|cat:$user->getSurname())-|
            |-if !$user@last-|,|-/if-|
        |-/foreach-|
    }
|-else-|
<ul>
	|-if count($users) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$users item=user-|
			<li id="|-$user->getId()-|">|-if ($user->getName() ne '') or ($user->getSurname() ne '')-||-$user->getSurname()-|, |-$user->getName()-| - |-/if-|(|-$user->getUserName()-|)</li>
		|-/foreach-|
		|-if count($users) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
|-/if-|
