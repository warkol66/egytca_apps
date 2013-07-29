|-if $result|@count eq 0-|No hay entradas disponibles
|-else-|
|-foreach from=$result item=archive name=for_archive-||-assign var=date value=$archive.ArchiveYear|cat:"-"|cat:$archive.ArchiveMonth|cat:"-01"-|
	<p><a href="Main.php?do=blogShow&period=|-$archive.ArchiveYear-||-$archive.ArchiveMonth-|">|-$date|date_format:"%B"-| |-$archive.ArchiveYear-| (|-$archive.nbEntries-|)</a></p>
|-/foreach-|						
|-/if-|