|-foreach from=$bonds key=key item=bond-|
     |-$bond-|(|-count(array_keys($usersBonds, $key))-|)&nbsp;
|-/foreach-|

