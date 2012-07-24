<chart caption='[Nombre para el gráfico]' subcaption='' palette='1' decimals='0' showValues='0' enableSmartLabels='1' showBorder='1' formatNumberScale='0' yAxisMinValue='0' YAxisMaxValue='5' decimalSeparator='.' thousandSeparator=',' labelDisplay='Rotate' slantLabels='1'  clickURL='#'>

    <categories>
    |-foreach from=$dates item=date-|
        <category label='|-$date-|' />
    |-/foreach-|
    </categories>

|-foreach from=$graphIssues item=graphIssue-|
    <dataset seriesName='|-$graphIssue->getName()-|' showValues='0'>
    |-foreach from=$graphIssue->getValues() item=value-|
        <set value='|-$value-|' />
    |-/foreach-|
    </dataset>
|-/foreach-|

</chart>