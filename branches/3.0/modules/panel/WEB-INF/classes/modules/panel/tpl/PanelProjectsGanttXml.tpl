<chart
	dateFormat='dd/mm/yyyy' 
	outputDateFormat='dd-mm-yyyy' 
	forceGanttWidthPercent="1" 
	ganttWidthPercent='10-90' 
	canvasBorderColor='999999' 
	canvasBorderThickness='0' 
	gridBorderColor='4567aa' 
	gridBorderAlpha='20' 
	ganttPaneDuration='3' 
	ganttPaneDurationUnit='y' >
	
<categories bgColor='009999'> 
	<category start='31/08/2010' end='01/01/2012' label='Nuevo Gráfico' fontColor='ffffff' fontSize='12' /> 
</categories> 

<categories bgColor='ffffff' fontColor='1288dd' fontSize='10' isBold='1' align='center'> 
	<category start='01/08/2010' end='31/08/2010' label='Ago' /> 
	<category start='01/10/2010' end='30/10/2010' label='Sep' /> 
	<category start='01/10/2010' end='31/10/2010' label='Oct' /> 
	<category start='01/11/2010' end='30/11/2010' label='Nov' /> 
	<category start='01/12/2010' end='31/12/2010' label='Dic' />
</categories> 

<processes 
	headerText='Actividades'
	fontColor='000000'
	fontSize='9'
	isAnimated='1'
	bgColor='4567aa'
	headerVAlign='bottom'
	headerAlign='left'
	headerbgColor='4567aa'
	headerFontColor='ffffff'
	headerFontSize='11'
	align='left'
	isBold='0'
	bgAlpha='25'> 
		
		<process label='No objecion a la Addenda 7 ' id='11'  /> 
		<process label='Publicacion portal y apertura de ofertas ' id='12'  /> 
		<process label='Evaluacion, tecnica,financiera y juridica ' id='13'  /> 
		<process label='Aprobacion de informes de evaluacion (El Informe Tecnico,en el ViceM, para envio al Comité) ' id='14'  /> 

</processes> 
<dataTable
	showProcessName='1'
	nameAlign='left'
	fontColor='000000'
	fontSize='10'
	vAlign='right'
	align='center'
	headerVAlign='bottom'
	headerAlign='left'
	headerbgColor='4567aa'
	headerFontColor='ffffff'
	headerFontSize='11' > 

		<dataColumn
			bgColor='eeeeee'
			headerText='Inicio'
			width='60' > 
			<text label='31/08/10' /> 
			<text label='05/10/10' /> 
			<text label='12/10/10' /> 
			<text label='30/11/10' /> 
			<text label='07/12/10' /> 
			<text label='07/12/10' /> 
	
		</dataColumn> 
		<dataColumn
			bgColor='eeeeee'
			headerText='Fin'
			width='60'> 
			<text label='02/10/10' /> 
			<text label='09/10/10' /> 
			<text label='27/11/10' /> 
			<text label='04/12/10' /> 
			<text label='11/12/10' /> 
			<text label='11/12/10' /> 
			<text label='18/12/10' /> 
			<text label='25/12/10' /> 
			<text label='25/12/10' /> 
		</datacolumn>				
		<dataColumn align='right' width="80" bgColor='4567aa' bgAlpha='25' headerText='Monto en millones'> 
			<text label='1,00' /> 
			<text label='0,20' /> 
			<text label='3,40' /> 
			<text label='5,00' /> 
			<text label='1,00' /> 
			<text label='3,00' /> 
			<text label='1,00' /> 
			<text label='0,30' /> 
			<text label='5,00' /> 
		</datacolumn>
	</dataTable> 
	<tasks>
		<task
			label='Planificada - No objecion a la Addenda 7 '
			processId='11'
			start='31/08/2010'
			end='02/10/2010'
			id='11-1' color='EEEEEE' height='10' topPadding='12%' /> 
		<task
			label='Real - No objecion a la Addenda 7 '
			processId='11'
			start='31/08/2010'
			end='02/10/2010'
			id='11' color='008000' alpha='100'  topPadding='56%' height='10' percentComplete='100' /> 
		<text
			label='0' /> 
		<task
			label='Planificada - Publicacion portal y apertura de ofertas '
			processId='12'
			start='05/10/2010'
			end='09/10/2010'
			id='12-1' color='EEEEEE' height='10' topPadding='12%' /> 
		<task
			label='Real - Publicacion portal y apertura de ofertas '
			processId='12'
			start='05/10/2010'
			end='09/10/2010'
			id='12' color='008000' alpha='100'  topPadding='56%' height='10' percentComplete='100' /> 
		<text
			label='0' /> 
		<task
			label='Planificada - Evaluacion, tecnica,financiera y juridica '
			processId='13'
			start='12/10/2010'
			end='27/11/2010'
			id='13-1' color='EEEEEE' height='10' topPadding='12%' /> 
		<task
			label='Real - Evaluacion, tecnica,financiera y juridica '
			processId='13'
			start='19/10/2010'
			end='27/11/2010'
			id='13' color='008000' alpha='100'  topPadding='56%' height='10' percentComplete='100' /> 
		<text
			label='0' /> 
		<task
			label='Planificada - Aprobacion de informes de evaluacion (El Informe Tecnico,en el ViceM, para envio al Comité) '
			processId='14'
			start='30/11/2010'
			end='04/12/2010'
			id='14-1' color='EEEEEE' height='10' topPadding='12%' /> 
		<task
			label='Real - Aprobacion de informes de evaluacion (El Informe Tecnico,en el ViceM, para envio al Comité) '
			processId='14'
			start='30/11/2010'
			end='04/12/2010'
			id='14' color='008000' alpha='100'  topPadding='56%' height='10' percentComplete='100' /> 
		<text
			label='0' /> 
		<task
			label='Planificada - Solicitud de dictamen a DAJ '
			processId='15'
			start='07/12/2010'
			end='11/12/2010'
			id='15-1' color='EEEEEE' height='10' topPadding='12%' /> 
		<task
			label='Real - Solicitud de dictamen a DAJ '
			processId='15'
			start='07/12/2010'
			end='11/12/2010'
			id='15' color='008000' alpha='100'  topPadding='56%' height='10' percentComplete='100' /> 
		<text
			label='0' /> 
	</tasks>
  <connectors>
    <connector fromTaskId='11' toTaskId='12' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='12' toTaskId='13' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='13' toTaskId='14' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='14' toTaskId='15' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='15' toTaskId='16' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='16' toTaskId='17' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='17' toTaskId='18' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='18' toTaskId='19' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
    <connector fromTaskId='19' toTaskId='20' color='4567aa' thickness='2' fromTaskConnectStart='1'/>
  </connectors>

	<milestones>
		<milestone date='15/02/2014' taskId='198-1' color='2E4472' shape='star' toolText='Fecha final planificada' />
		<milestone date='' taskId='198' color='999999' shape='star' toolText='Fecha final Real' />
	</milestones>
	
	<legend>
	  <item label='Cumplido' color='008000' />
	  <item label='En alerta' color='ffff00' />
	  <item label='Planificada' color='EEEEEE' />
	  <item label='Faltante' color='FF5E5E' />
	</legend>
	<styles>
	  <definition>
	    <style type='Font' name='legendFont' size='12' />
	  </definition>
	  <application>
	    <apply toObject='LEGEND' styles='legendFont' />
	  </application>
	</styles>
</chart>