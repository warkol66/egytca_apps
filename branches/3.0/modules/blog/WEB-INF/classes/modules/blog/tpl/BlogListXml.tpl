<xls>
	<headers>
		<header>Infocívica</header>
		<header>Noticias</header>
	</headers>
	<tableHeaders>
		<header>ID</header>
		<header>Title</header>
		<header>Creation Date</header>
		<header>Archive Date</header>
		<header>Region</header>
		<header>Category</header>
		<header>Status</header>
	</tableHeaders>
	<tableValues>		
	|-foreach from=$blogEntries item=blogEntry name=for_blogEntries-|
		<row>
			<id>|-$blogEntry->getId()-|</id>
			<title>|-$blogEntry->gettitle()-|</title>
			<creationDate>|-$blogEntry->getcreationDate()|date_format:"%d-%m-%Y"-|</creationDate>
			<archiveDate>|-assign var=archiveDate value=$blogEntry->getarchiveDate()-||-if empty($archiveDate)-|No archivada|-else-||-$archiveDate|date_format:"%d-%m-%Y"-||-/if-|</archiveDate>
			<region>|-assign var=region value=$blogEntry->getRegion()-||-if empty($region)-|N/A|-else-||-$region->getName()-||-/if-|</region>
			<category>|-assign var=category value=$blogEntry->getCategory()-||-if empty($category)-|N/A|-else-||-$category->getName()-||-/if-|</category>
			<status>|-assign var=articleStatus value=$blogEntry->getStatus()-||-$blogEntryStatus[$articleStatus]-|</status>								
		</row>
	|-/foreach-|
	</tableValues>
</xls>
