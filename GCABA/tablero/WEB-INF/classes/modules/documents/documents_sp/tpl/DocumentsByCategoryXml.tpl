<informacion>
<estados>|-foreach from=$partialCategories item=category name=for_categories-||-assign var=XMLname value=$category->getName()|lower|replace:' ':''-|
|-if $XMLname eq "buenosaires"-||-assign var=XMLname value="bsas"-|
|-elseif $XMLname eq "ciudadautónomadebuenosaires"-||-assign var=XMLname value="ciudadaut"-|
|-elseif $XMLname eq "córdoba"-||-assign var=XMLname value="cordoba"-|
|-elseif $XMLname eq "buenosaires"-||-assign var=XMLname value="bsas"-|
|-elseif $XMLname eq "ríonegro"-||-assign var=XMLname value="rionegro"-|
|-elseif $XMLname eq "sanjuán"-||-assign var=XMLname value="sanjuan"-|
|-elseif $XMLname eq "sanluís"-||-assign var=XMLname value="sanluis"-|
|-elseif $XMLname eq "santiagodelestero"-||-assign var=XMLname value="santiago"-|
|-elseif $XMLname eq "santafé"-||-assign var=XMLname value="stafe"-|
|-elseif $XMLname eq "neuquén"-||-assign var=XMLname value="neuquen"-|
|-elseif $XMLname eq "tierradelfuego"-||-assign var=XMLname value="fuego"-|
|-elseif $XMLname eq "tucumán"-||-assign var=XMLname value="tucuman"-|
|-/if-|	
	<estado label="|-$XMLname-|" estado="|-if $category->getDocumentsCount() eq 0-|1|-else-|2|-/if-|"></estado>|-/foreach-|
</estados>
</informacion>

