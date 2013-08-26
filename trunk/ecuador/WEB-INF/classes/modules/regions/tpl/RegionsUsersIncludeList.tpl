|-foreach from=$result item=region-|
	|-assign var=users value=$region->getUsersCount()-|
	|-if $users gt 0-|
	<li>|-$region->getName()-|</li>
	|-/if-|
|-/foreach-|
