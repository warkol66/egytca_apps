<xls>
	<headers>
		<header>LAUSI - Vía Pública</header>
		<header>Reporte por Motivos al |-$smarty.now|date_format:"%d-%m-%Y"-|</header>
		<header></header>
	</headers>
	<tableValues>
		<row>
			<tipo>Dobles</tipo>
		</row>
		<row>
			<motivo>Motivo</motivo>
			<total>Cantidad</total>
			<vencimiento>Vencimiento</vencimiento>
		</row>
	|-foreach from=$resultsDouble item=item name=for_themes-|
		<row>
			<motivo>|-$item.name-|</motivo>
			<total>|-$item.total-|</total>
			<vencimiento>|-if $item.expired-|VENCIDO (|-$item.endDate|date_format:"%d-%m-%Y"-|)|-else-||-$item.endDate|date_format:"%d-%m-%Y"-||-/if-|</vencimiento>
		</row>|-/foreach-|
		<row>
			<separador></separador>
		</row>
		<row>
			<tipo>Séxtuples</tipo>
		</row>
		<row>
			<motivo>Motivo</motivo>
			<total>Cantidad</total>
			<vencimiento>Vencimiento</vencimiento>
		</row>
	|-foreach from=$resultsSix item=item name=for_themes-|
		<row>
			<motivo>|-$item.name-|</motivo>
			<total>|-$item.total-|</total>
			<vencimiento>|-if $item.expired-|VENCIDO (|-$item.endDate|date_format:"%d-%m-%Y"-|)|-else-||-$item.endDate|date_format:"%d-%m-%Y"-||-/if-|</vencimiento>
		</row>|-/foreach-|						
	</tableValues>
</xls>
