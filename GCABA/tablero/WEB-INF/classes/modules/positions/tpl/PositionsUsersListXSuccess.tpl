<ul>
	|-foreach from=$users item=user-|
		<li id="|-$user->getId()-|">|-if ($user->getName() ne '') or ($user->getSurname() ne '')-||-$user->getSurname()-|, |-$user->getName()-| - |-/if-|(|-$user->getUserName()-|)</li>
	|-/foreach-|
</ul>