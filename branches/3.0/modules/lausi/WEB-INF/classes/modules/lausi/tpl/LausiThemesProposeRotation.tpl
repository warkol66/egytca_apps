<script type="text/javascript" language="javascript">
// <![CDATA[
	$('msgbox' + '|-$advertId-|').innerHTML = '<span class="resultSuccess">Generación de Propuesta Exitosa</span>';
// ]]>
</script>
|-if empty($result)-|
	<p>No hay ubicaciones disponibles para la rotación.</p>
|-else-|
<div id="rotationOptions|-$advertId-|">
<ul>
		|-foreach from=$result item=holder-|
		
			|-foreach from=$holder.elements item=billboard name=for_billboard-|
				|-assign var=address value=$billboard->getAddress()-|
			<li>Dirección: |-$address->getName()-| - Número de Cartelera: |-$billboard->getNumber()-|
				<form action="Main.php" method="post">
					<input type="hidden" name="advertId" value="|-$advertId-|" />
					<input type="hidden" name="billboardId" value="|-$billboard->getId()-|" />
					<input type="hidden" name="do" value="lausiThemesRotateX" />
					<input type="button" id='proposeButton|-$advertId-|'value="Rotar Motivo a esta opción" onClick="javascript:lausiRotateTheme(this.form,'|-$advertId-|')"/>
				</form>		
			</li>
			|-/foreach-|
		|-/foreach-|
</ul>
</div>
|-/if-|
