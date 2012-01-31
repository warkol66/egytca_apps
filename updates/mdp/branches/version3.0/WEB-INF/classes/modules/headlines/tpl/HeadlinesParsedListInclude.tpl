<ul id="list">
    |-foreach from=$headlinesParsed item=headline name=for_headlines-|
    <li>|-$headline->getName()-|</li>
    |-/foreach-|
</ul>
