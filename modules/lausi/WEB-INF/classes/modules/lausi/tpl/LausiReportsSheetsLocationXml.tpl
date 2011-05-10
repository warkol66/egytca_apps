<xls>
	<headers>
		<header>Reportes</header>
		<header>Disposición de Afiches</header>
	</headers>
|-foreach from=$results item=item-||-assign var=currentCircuit value=$item.circuit-|
	<tableHeaders>
			<header>Dirección</header>
		|-foreach from=$themes item=theme-|<header>|-$theme->getShortName()-|</header>|-/foreach-|
	</tableHeaders>
	<tableValues>|-math equation="x+1" x=$themes|@count assign=themesCount-|
		<row>
			<circuit>Circuito |-$currentCircuit->getName()-|</circuit>
		</row>
				|-foreach from=$item.addresses item=addressHolder name=for_advertisements-|
					<row>|-assign var=address value=$addressHolder.address -||-assign var=adverts value=$addressHolder.adverts-|
						<name>|-$address->getName()-|</name>
					|-foreach from=$themes item=theme name=forEachThemes-||-assign var=themeId value=$theme->getId()-|
						<cell|-$smarty.foreach.forEachThemes.iteration-|>|-if isset($adverts.$themeId)-||-$adverts.$themeId-||-else-||-/if-|</cell|-$smarty.foreach.forEachThemes.iteration-|>
					|-/foreach-|
					</row>
				|-/foreach-|					
					<row>
						<totals>Totales</totals>|-assign var=generalTotal value=0-||-assign var=counter value=0-|
					|-foreach from=$themes item=theme name=forEachThemes-||-assign var=themeId value=$theme->getId()-|
						<cell|-$smarty.foreach.forEachThemes.iteration-|>|-if isset($item.totals.$themeId)-||-$item.totals.$themeId-||-else-|---|-/if-|</cell|-$smarty.foreach.forEachThemes.iteration-|>			
					|-/foreach-|
					</row>
					<row>
						<circuitTotal>Total del circuito: |-$item.total-|</circuitTotal>
					</row>
				</tableValues>
|-/foreach-|
<xls>