<script type="text/javascript" language="javascript">
// <![CDATA[
	function showBackupLoader() {
		$('backupLoader').show();
	}
	
	function hideBackupLoader() {
		$('backupLoader').hide();
		$('backupLoaderForm').reset();
	}
// ]]>
</script>

<h2>Respaldos del Sistema</h2>
<h1>Administración de Respaldos</h1>
<div id="div_addresses">
	|-if $message eq "created"-|
		<div class="successMessage">Backup creado correctamente.</div>
	|-elseif $message eq "create_error"-|
		<div class="errorMessage">Se ha producido un error al crear el backup.</div>
	|-elseif $message eq "restored"-|
		<div class="successMessage">Se ha restaurado el backup seleccionado.</div>
	|-elseif $message eq "restore_error"-|
		<div class="errorMessage">Se ha producido un error al restaurar el backup.</div>
	|-elseif $message eq "deleted"-|
		<div class="successMessage">Se ha eliminado el backup seleccionado.</div>
	|-elseif $message eq "delete_error"-|
		<div class="errorMessage">Se ha producido un error al eliminar el backup.</div>
	|-elseif $message eq "not_exists"-|
		<div class="errorMessage">El archivo de backup pedido no existe.</div>
	|-elseif $message eq "email_sent"-|
		<div class="successMessage">El backup fue enviado.</div>
	|-elseif $message eq "email_error"-|
		<div class="errorMessage">Se ha producido un error al enviar el backup.</div>
	|-/if-|
	<p>Esta herramienta le permite generar y restaurar respaldos de la información contenida en el sistema. Puede guardar los respaldos en el servidor o en su equipo.</p>
	<p>Recuerde que al resutaurar un respaldo toda la información existente se reemplazará por la información que está en el respaldo</p>
	<fieldset class="nestedFieldset" title="Administrador de Respaldos">
	<legend>Administrar Respaldos</legend>
	<p>Generar respaldo almacenado en el servidor &nbsp;&nbsp;
	 <a href="Main.php?do=backupCreate" title="Generar respaldo de datos en servidor" class="textLinkButton">Sólo datos&nbsp;&nbsp;&nbsp;<img src="images/clear.png" class="icon iconStoreInServer" /></a>	
		&nbsp;&nbsp;
		<a href="Main.php?do=backupCreate&amp;options[complete]=1" title="Generar respaldo completo en servidor, incluyendo datos y archivos del sistema." class="textLinkButton">Completo&nbsp;&nbsp;&nbsp;<img src="images/clear.png" class="icon iconStoreInServer" /></a>
	</p>
	<p>Generar respaldo para descargar &nbsp;&nbsp;
<a href="Main.php?do=backupCreate&amp;options[toFile]=1" title="Generar respaldo de datos para descargar" class="textLinkButton">Sólo datos&nbsp;&nbsp;&nbsp;<img src="images/clear.png" class="icon iconStoreLocal" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="Main.php?do=backupCreate&amp;options[toFile]=1&amp;options[complete]=1" title="Generar respaldo completo en servidor, incluye datos y archivos del sistema." class="textLinkButton">Completo&nbsp;&nbsp;&nbsp;<img src="images/clear.png"  class="icon iconStoreLocal" /></a>	  
		</p>
	<p>Restaurar respaldo desde una copia local <a href='javascript:switch_vis("backupLoader")' title="Seleccionar archivo local para restaurar" class="textLinkButton">Seleccionar archivo&nbsp;&nbsp;&nbsp;<img src="images/clear.png" class="icon iconRestore" /></a></p>
		<div id="backupLoader" style="display: none;">
			<fieldset title="Formulario de carga de archivo de respaldo local">
			<legend>Restaurar respaldo desde copia local</legend>
			<form id="backupLoaderForm" action="Main.php" method="post" enctype="multipart/form-data">
				<p>A continuacion indique el archivo local a restaurar en el sistema:</p>
				<p><label>Archivo: </label>
					<input type="file" name="backup" value="" size="40" /></p>		
				<input type="hidden" name="do" value="backupRestore" />
				<p>
					<input type="submit" value="Restaurar respaldo local" accept="txt/sql" onclick="return confirm('Esta opción reemplazará la información en el sistema por la información en este respaldo. ¿Está seguro que desea continuar?');"/>
					<input type="button" value="Cancelar" onClick="hideBackupLoader()"/>
				</p>
			</form>
			</fieldset>
		</div>
	<table id="tabla-backups" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
		<thead>
			<tr class="tableTdHeader">
				<th width="1%">&nbsp;</th>
				<th width="60%">Nombre de Archivo <a href="Main.php?do=backupList|-if $order neq 'desc'-|&order=desc|-/if-|" title="Cambiar el orden"><img src="images/icon_sort.png"/></a></th>
				<th width="20%">Fecha y hora</th>
				<th width="15%">Tamaño</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if empty($filenames)-|
			<tr>
				<th colspan="5" class="thFillTitle">No hay respaldos disponibles</th>
			</tr>
		|-/if-|
		|-foreach from=$filenames item=filename key=counter name=for_filenames-|
			<tr>
				<td><a href="Main.php?do=backupDownload&filename=|-$filename.name-|" title="Descargar este respaldo"><img src="images/clear.png" class="icon iconDownload" /></a></td>
				<td>|-$filename.name-|</td>
				<td align="right" nowrap="nowrap">|-$filename.time|date_format:"%Y-%m-%d %H:%M:%S"|change_timezone|date_format:"%d-%m-%Y %H:%M:%S"-|</td>
				<td align="right">|-$filename.size|number_format:3:",":"."-| kb</td>
				<td nowrap="nowrap">
					<input type="button" value="Enviar por mail" title="Enviar por mail" class="icon iconEmail" onClick='$("emailSend|-$counter-|").show(); $("backupAdmin|-$counter-|").hide(); $("backupDelete|-$counter-|").hide(); $("mail|-$counter-|").hide();' id="mail|-$counter-|" />
					<form action="Main.php" style="display: none;" method="post" id="emailSend|-$counter-|">
						<input type="hidden" name="filename" value="|-$filename.name-|"  />
						<input type="hidden" name="do" value="backupSendByEmail" />
						<strong>Dirección:</strong> <input type="text" name="email" value="" title="Ingrese la dirección del destinatario" />
						<input type="submit" value="Enviar" title="Enviar" />
						<input type="button" value="Cancelar" onclick='$("emailSend|-$counter-|").hide(); $("backupAdmin|-$counter-|").show(); $("backupDelete|-$counter-|").show();$("mail|-$counter-|").show();' />						
					</form>
					<form action="Main.php" method="post" id="backupAdmin|-$counter-|">
						<input type="hidden" name="filename" value="|-$filename.name-|"  />
						<input type="hidden" name="do" value="backupRestore" />
						<input type="submit" value="Restaurar Backup" class="icon iconRestoreFromServer" title="Restaurar este respaldo" onclick="return confirm('Esta opción reemplazará la información en el sistema por la información en este respaldo. ¿Está seguro que desea continuar?');" />
					</form>
					<form action="Main.php" method="post" id="backupDelete|-$counter-|">
						<input type="hidden" name="filename" value="|-$filename.name-|"  />
						<input type="hidden" name="do" value="backupDoDelete" />
						<input type="submit" value="Eliminar Backup" class="icon iconDelete" title="Eliminar este respaldo" onclick="return confirm('Esta opción elimina permanentemente este respaldo. ¿Está seguro que desea eliminarlo?');" />
					</form>				
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
	</fieldset>
</div>
