<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>CIPPEC - Ultimas Publicaciones|-if $categorySelected ne ''-| de "|-$categorySelected->getName()-|"|-/if-|</title>
		<link>|-$systemUrl-|</link>
		<description>CIPPEC</description>
		<pubDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</pubDate>
		<lastBuildDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</lastBuildDate>
		<image>
			<url>|-$systemUrl|substr:0:-8-|logo_cippec.png</url>
			<title>CIPPEC - Publicaciones|-if $categorySelected ne ''-| de "|-$categorySelected->getName()-|"|-/if-|</title>
			<link>|-$systemUrl-|</link>
		</image>
		<generator>|-$systemUrl-|</generator>
		<language>es</language>
		<atom:link href="|-$systemUrl-|?do=|-$smarty.request.do-|&amp;rss=1|-if $categorySelected ne ''-|&amp;category=|-$categorySelected->getId()-||-/if-|" rel="self" type="application/rss+xml" />
		|-foreach from=$newest item=document name=document-|
		<item>
			<title>|-$document->getTitle()-|</title>
			<author>|-if $document->getAuthor() neq ''-||-$document->getAuthor()-||-else-|(Cippec)|-/if-|</author>
			<pubDate>|-$document->getDocumentdate()|rssDate-|</pubDate>
			<guid>|-$systemUrl-|?do=|-if $document->isPasswordProtected()-|documentsShow|-else-|documentsDoDownload&amp;id=|-$document->getId()-||-/if-|</guid>
			<description>|-$document->getDescription()|escape-|
			|-if $document->getAuthor() neq ''-|&lt;br /&gt;&lt;strong&gt;Autor:&lt;/strong&gt; |-$document->getAuthor()-||-/if-|
			|-if $document->getType() neq ''-|&lt;br /&gt;&lt;strong&gt;Tipo:&lt;/strong&gt; |-$document->getType()-||-/if-|
			|-if $document->getProgram() neq ''-|&lt;br /&gt;&lt;strong&gt;Programa:&lt;/strong&gt; |-$document->getProgram()-||-/if-|
			|-if $document->getKeywords() neq ''-|&lt;br /&gt;&lt;strong&gt;Palabras clave:&lt;/strong&gt; |-$document->getKeywords()-||-/if-|
			|-if $document->getNumber() neq ''-|&lt;br /&gt;&lt;strong&gt;Número y año:&lt;/strong&gt; |-$document->getNumber()-| - |-$document->getDocumentdate()|date_format:"%Y"-|
			|-else-|&lt;br /&gt;&lt;strong&gt;Año:&lt;/strong&gt; |-$document->getDocumentdate()|date_format:"%Y"-||-/if-|
			</description>
		</item>
		|-/foreach-|
	</channel>
</rss>