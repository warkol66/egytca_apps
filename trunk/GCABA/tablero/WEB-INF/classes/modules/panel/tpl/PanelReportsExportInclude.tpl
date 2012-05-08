<h|-$section->getType()-|> |-$section->getName()-|</h|-$section->getType()-|>
|-$section->getContent()-|
|-assign var=documents value=$section->getDocuments()-|
|-if count(documents) > 0-|
<ul>
|-foreach from=$documents item=document-|
	<li>|-$document->getRealFileName()-|</li>
|-/foreach-|
</ul>
|-/if-|

|-assign var=sections value=$section->getChildren()-|
|-foreach from=$sections item=section-|
	|-include file="PanelReportsExportInclude.tpl" section=$section-|
|-/foreach-|