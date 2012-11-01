<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>|-$parameters.siteName-| - Blog</title>
		<link>|-$systemUrl-|</link>
		<description>|-$parameters.siteShortName|capitalize-|</description>
		<pubDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</pubDate>
		<lastBuildDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</lastBuildDate>
		<image>
			<url>|-$systemUrl|substr:0:-8-|logo_cippec.png</url>
			<title>NEXOS - Entradas al blog</title>
			<link>|-$systemUrl-|</link>
		</image>
		<generator>|-$systemUrl-|</generator>
		<language>es</language>
		<atom:link href="|-$systemUrl-|?do=|-$smarty.request.do-|&amp;rss=1|-if $categorySelected ne ''-|&amp;category=|-$categorySelected->getId()-||-/if-|" rel="self" type="application/rss+xml" />
		|-foreach from=$blogEntries item=blogEntry name=for_blogEntries-|
		<item>
			<title>|-$blogEntry->gettitle()-|</title>
			<author>|-$parameters.webmasterMail-| (Cippec)</author>
			<pubDate>|-$blogEntry->getcreationDate()|rssDate-|</pubDate>
			<guid>|-$systemUrl-|?do=blogView&amp;id=|-$blogEntry->getId()-|</guid>
			<description>
				 |-if $blogEntry->getBody()|mb_count_characters:true:true > $moduleConfig.charsInList-|
				|-assign var=id value=$blogEntry->getId()-|
				|-assign var=url value="Main.php?do=blogView&id=$id"-|
				|-assign var=readMore value="<p class='readMore'><a href='$url'> ... seguir leyendo</a></p>"-|
				|-$blogEntry->getBody()|mb_truncate_strip_tags:$moduleConfig.charsInList:"...":$readMore|escape:'htmlall'-|
				|-else-||-$blogEntry->getBody()|escape:'htmlall'-|
				|-/if-|
			</description>
		</item>
		|-/foreach-|
	</channel>
</rss>
