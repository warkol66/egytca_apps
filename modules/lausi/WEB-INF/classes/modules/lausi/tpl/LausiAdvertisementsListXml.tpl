<xls>
	<headers>
		|- if $clientReport neq 1-|
		<header>Distribución de Motivos</header>
		<header>Disposición de Avisos</header>
		|-else-|
		<header>Reportes</header>
		<header>De Avisos para Clientes</header>
		|-/if-|
	</headers>
	|-if $noGroupByAddressAndTheme neq '1'-|
	<tableHeaders>
		<header>Dirección</header>
		<header>Motivo</header>
		|-if $onlyAddresses eq ''-|
		<header>Avisos</header>
		|-/if-|
	</tableHeaders>
	<tableValues>		
			|-foreach from=$advertisements item=advertisement name=for_advertisements-|
				<row>
					<address>|-assign var=billboard value=$advertisement->getBillboard()-||-if $billboard-||-assign var=address value=$billboard->getAddress()-||-/if-||-if $address-||-$address->getName()-||-/if-|</address>
					<theme>|-assign var=theme value=$advertisement->getTheme()-||-if $theme-||-$theme->getShortName()-||-/if-|</theme>
					|-if $onlyAddresses eq ''-|<themes>|-$advertisement->themes-|</themes>|-/if-|
				</row>
			|-/foreach-|						
	</tableValues>
	|-else-|
	<tableHeaders>
			<header>Circuito</header>
			<header>Dirección</header>
			<header>Motivo</header>
			|-if $onlyAddresses eq ''-|<header>Tipo</header>
			<header>Cartelera</header>
			<header>Desde</header>
			<header>Hasta</header>|-/if-|
	</tableHeaders>
	<tableValues>
			|-foreach from=$advertisements item=advertisement name=for_advertisements-|
			<row>|-assign var=theme value=$advertisement->getTheme()-||-assign var=billboard value=$advertisement->getBillboard()-||-if $billboard-||-assign var=address value=$billboard->getAddress()-||-/if-||-if $address-||-assign var=circuit value=$address->getCircuit()-||-/if-|
				<circuit>|-if $circuit ne ''-||-$circuit->getName()-||-/if-|</circuit>
				<address>|-if $address ne ''-||-$address->getName()-||-/if-|</address>
				<theme>|-if $theme ne ''-||-$theme->getShortName()-||-/if-|</theme>
				|-if $onlyAddresses eq ''-|<type>|-if $theme ne ''-||-$theme->getTypeName()-||-/if-|</type>
				<billboard>|-$billboard->getNumber()-|</billboard>
				<publishDate>|-$advertisement->getPublishDate()|date_format:"%d-%m-%Y"-|</publishDate>
				<endDate>|-$advertisement->getEndDate()|date_format:"%d-%m-%Y"-|</endDate>|-/if-|
			</row>
			|-/foreach-|
	</tableValues>
	|-/if-|
</xls>
