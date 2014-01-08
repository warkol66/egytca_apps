<script>
	$('#messageMod').html("");
	|-if !empty($errors)-|
	$('#messageResult').html("<span class='resultFailure'>Ocurrieron errores al: <ul>|-foreach from=$errors item=error name=foreachError-|<li>|-$error-|</li>|-/foreach-|</ul></span>");
	|-else-|
	$('#messageResult').html('<span class="resultSuccess">Todos los módulos fueron verificados</span>');
	|-/if-|
	//$('#|-$verifiedModule-|_hash').html('<span style="color: #0099CC;">|-$directoryHash-|</span>');
	
	var verified = |-$verifModules-|;
	
	// recorro cada modulo
	$.each(verified, function(i, module) {
		// creo una lista para el modulo
		var list = $('<ul class="verifyNested">');
		
		// recorro cada tipo de archivo (newFiles y changedFiles)
		$.each(module, function(fileType, files) {
			
			if(fileType == 'newFiles'){
				// creo el item 'archivos nuevos'
				var newFiles = "<li>Archivos nuevos: <ul>";
				
				// recorro los archivos nuevos para agregarlos a la lista
				$.each(files, function(file, hash) {
					
					son="<li>"+file+"</li>";
					newFiles+=son;
				});
				
				newFiles+="</ul></li>";
				list.append(newFiles);
					
			}else if(fileType == 'changedFiles'){
				// creo el item 'archivos modificados'
				var modFiles = "<li>Archivos modificados: <ul>";
				
				// recorro los archivos modificados para agregarlos a la lista
				$.each(files, function(file, hash) {
					son="<li>"+file+"</li>";
					modFiles+=son;
				});
				
				modFiles+="</ul></li>";
				list.append(modFiles);
			}else{
				if(files)
					$('#' + i + '_hash').html('<span style="color: #0099CC;">'+files+'</span>');
			}
			$('#directories_' + i).append(list);
			$('#directories_' + i).show();
			
		});
	});
	
	
</script>


