<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Infocivica - Eventos|-if $categorySelected ne ''-| de "|-$categorySelected->getName()-|"|-/if-|</title>
		<link>|-$systemUrl-|</link>
		<description>Infocivica</description>
		<pubDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</pubDate>
		<lastBuildDate>|-$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"|rssDate-|</lastBuildDate>
		<image>
			<url>|-$systemUrl|substr:0:-8-|logo_infocivica.png</url>
			<title>Infocivica - Eventos|-if $categorySelected ne ''-| de "|-$categorySelected->getName()-|"|-/if-|</title>
			<link>|-$systemUrl-|</link>
		</image>
		<generator>|-$systemUrl-|</generator>
		<language>es</language>
		<atom:link href="|-$systemUrl-|?do=|-$smarty.request.do-|&amp;rss=1|-if $categorySelected ne ''-|&amp;category=|-$categorySelected->getId()-||-/if-|" rel="self" type="application/rss+xml" />
		|-foreach from=$calendarEvents item=calendarEvent name=for_calendarEvent-|
		|-assign var=startDateDay value=$calendarEvent->getStartDate()|date_format:"%d"-|
		|-assign var=startDateMonth value=$calendarEvent->getStartDate()|date_format:"%m"-|
		|-assign var=startDateYear  value=$calendarEvent->getStartDate()|date_format:"%Y"-|
		|-assign var=endDateDay value=$calendarEvent->getEndDate()|date_format:"%d"-|
		|-assign var=endDateMonth value=$calendarEvent->getEndDate()|date_format:"%m"-|
		|-assign var=endDateYear  value=$calendarEvent->getEndDate()|date_format:"%Y"-|
		|-if $calendarEvent->getEndDate() eq $calendarEvent->getStartDate()-|
			|-assign var=eventDates value=$calendarEvent->getStartDate()|date_format:"%d de %B de %Y"-|
		|-elseif $startDateYear eq $endDateYear and $startDateMonth eq $endDateMonth-|
			|-assign var=eventDates value=$calendarEvent->getStartDate()|date_format:"Desde el %d"-|
			|-assign var=eventDates2 value=$calendarEvent->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-assign var=eventDates value=$eventDates$eventDates2-|
		|-elseif $startDateYear eq $endDateYear-|
			|-assign var=eventDates value=$calendarEvent->getStartDate()|date_format:"Desde el %d de %B"-|
			|-assign var=eventDates2 value=$calendarEvent->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-assign var=eventDates value=$eventDates$eventDates2-|
		|-else-|
			|-assign var=eventDates value=$calendarEvent->getStartDate()|date_format:"Desde el %d de %B de %Y"-|
			|-assign var=eventDates2 value=$calendarEvent->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-assign var=eventDates value=$eventDates$eventDates2-|
		|-/if-|
		<item>
			<title>|-$calendarEvent->gettitle()-| [|-$eventDates-|]</title>
			<author>|-$parameters.webmasterMail-| (Infocivica)</author>
			<pubDate>|-$calendarEvent->getcreationDate()|rssDate-|</pubDate>
			<guid>|-$systemUrl-|?do=calendarEventsView&amp;id=|-$calendarEvent->getId()-|</guid>		
			|-if $categorySelected eq ''-||-assign var=category value=$calendarEvent->getCategory()-||-if not empty($category)-|<category>|-$category->getName()-|</category>|-/if-||-/if-|
			<description>
				 |-$calendarEvent->getSummary()|escape-|
				 &lt;br /&gt;
				 |-if $calendarEvent->getSourceContact() neq ''-||-$calendarEvent->getSourceContact()-||-/if-|
					&lt;br /&gt;&lt;br /&gt;
					&lt;strong&gt;|-assign var=region value=$calendarEvent->getRegion()-|
					|-if not empty($region)-||-$region->getName()-| &gt;|-/if-|
					|-assign var=category value=$calendarEvent->getCategory()-|
					|-if not empty($category)-||-$category->getName()-||-/if-|
				&lt;/strong&gt;					
			</description>
		</item>
		|-/foreach-|
	</channel>
</rss>
