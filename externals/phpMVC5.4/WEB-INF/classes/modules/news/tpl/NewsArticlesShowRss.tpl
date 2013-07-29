<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>|-$parameters.siteName-| - Noticias|-if $categorySelected ne ''-| de "|-$categorySelected->getName()-|"|-/if-|</title>
		<link>|-$systemUrl-|</link>
		<description>|-$parameters.siteShortName|capitalize-|</description>
		<pubDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</pubDate>
		<lastBuildDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</lastBuildDate>
		<image>
			<url>|-$systemUrl|substr:0:-8-|logo_cippec.png</url>
			<title>CIPPEC - Noticias|-if $categorySelected ne ''-| de "|-$categorySelected->getName()-|"|-/if-|</title>
			<link>|-$systemUrl-|</link>
		</image>
		<generator>|-$systemUrl-|</generator>
		<language>es</language>
		<atom:link href="|-$systemUrl-|?do=|-$smarty.request.do-|&amp;rss=1|-if $categorySelected ne ''-|&amp;category=|-$categorySelected->getId()-||-/if-|" rel="self" type="application/rss+xml" />
		|-foreach from=$newsArticleColl item=newsarticle name=for_newsarticles-|
		<item>
			<title>|-$newsarticle->gettitle()-|</title>
			<author>|-$parameters.webmasterMail-| (Cippec)</author>
			<pubDate>|-$newsarticle->getcreationDate()|rssDate-|</pubDate>
			<guid>|-$systemUrl-|?do=newsArticlesView&amp;id=|-$newsarticle->getId()-|</guid>		
			|-if $categorySelected eq ''-||-assign var=category value=$newsarticle->getCategory()-||-if not empty($category)-|<category>|-$category->getName()-|</category>|-/if-||-/if-|
			<description>
				 |-$newsarticle->getSummary()|escape-|
				 &lt;br /&gt;
				 |-if $newsarticle->getSourceContact() neq ''-||-$calendarEvent->getSourceContact()-||-/if-|
					&lt;br /&gt;&lt;br /&gt;
					&lt;strong&gt;|-assign var=region value=$newsarticle->getRegion()-|
					|-if not empty($region)-||-$region->getName()-| &gt;|-/if-|
					|-if not empty($category)-||-$category->getName()-| &gt;|-/if-|
				|-$newsarticle->gettoptitle()-|&lt;/strong&gt;					
			</description>
		</item>
		|-/foreach-|
	</channel>
</rss>
