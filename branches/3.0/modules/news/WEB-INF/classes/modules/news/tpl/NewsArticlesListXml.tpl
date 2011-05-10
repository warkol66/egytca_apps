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
	|-foreach from=$newsarticles item=newsarticle name=for_newsarticles-|
		<row>
			<id>|-$newsarticle->getId()-|</id>
			<title>|-$newsarticle->gettitle()-|</title>
			<creationDate>|-$newsarticle->getcreationDate()|date_format:"%d-%m-%Y"-|</creationDate>
			<archiveDate>|-assign var=archiveDate value=$newsarticle->getarchiveDate()-||-if empty($archiveDate)-|No archivada|-else-||-$archiveDate|date_format:"%d-%m-%Y"-||-/if-|</archiveDate>
			<region>|-assign var=region value=$newsarticle->getRegion()-||-if empty($region)-|N/A|-else-||-$region->getName()-||-/if-|</region>
			<category>|-assign var=category value=$newsarticle->getCategory()-||-if empty($category)-|N/A|-else-||-$category->getName()-||-/if-|</category>
			<status>|-assign var=articleStatus value=$newsarticle->getStatus()-||-$newsArticleStatus[$articleStatus]-|</status>								
		</row>
	|-/foreach-|
	</tableValues>
</xls>
