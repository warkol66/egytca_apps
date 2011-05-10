|-if $loadAreaedit neq 1-|
	|-include file='ContentEditTinyMceInclude.tpl' element=content languages=$languages plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
|-/if-|
	<h2>Módulo de Contenido</h2>
	<h1>Administrar Contenido</h1>

|-include file='ContentNavigationChainInclude.tpl' navigationChain=$navigationChain-|

	<p>Ingrese la información solicitada y haga click en "Guardar"</p>
<fieldset>
<legend>|-if isset($create)-|Agregar |-/if-||-if $type eq 'content'-|Contenido|-/if-||-if $type eq 'section'-|Sección|-/if-||-if $type eq 'link'-|Link|-/if-|</legend>
|-if $type eq "content" or $type eq "link"-|
<form id="editors_here" action="Main.php?do=contentDoEdit" method="post">
	|-if isset($create)-|
	<p>
	<label for="content[type]">Tipo de Contenido</label>
	<select name="content[type]" onchange="javascript:contentShowContentFields(this.value)">
		<option value="content">Contenido</option>
		<option value="link">Link</option>
	</select>
	</p>
	|-else-|
			<input type="hidden" name="content[type]" value="|-$type-|" />
	|-/if-|
 	|-if isset($content)-|
	<input name="content[id]" type="hidden" id="id" value="|-$content.id-|" />
	<p>
	<label for="title">Dentro de Sección</label>
	<select name="content[parent]">
		<option value="0">Base</option>
		|-foreach from=$sections item=section-|
		<option value="|-$section.id-|" |-if $section.id eq $content.parent-|selected="selected"|-/if-|>|-$section.title-|</option>
		|-/foreach-|
	</select>
	</p>
	|-else-|
	<input name="content[parent]" type="hidden" id="content[parent]" value="|-$parentId-|" /> 
	|-/if-|
	<input name="content[typeX]" type="hidden" id="content[typeX]" value="content" /> 
	|-foreach from=$languages item=langItem-||-if $languages|@count gt 1-|
	<h3>|-$langItem.name|multilang_get_translation:"multilang"-|</h3>|-/if-|
		|-assign var=languageCode value=$langItem.code-|
	<div id='edit_content_|-$languageCode-|'>
		<p>  
		<label for="title">Título</label>
		<input name="content[|-$languageCode-|][title]" type="text" id="content[|-$languageCode-|][title]" size="55" maxlength="255" value="|-$content.$languageCode.title|escape-|" /> 
		</p> 
		<p>  
		<label for="titleInMenu">Título en el menú</label>
		<input name="content[|-$languageCode-|][titleInMenu]" type="text" id="content[|-$languageCode-|][titleInMenu]" size="55" maxlength="120" value="|-$content.$languageCode.titleInMenu|escape-|" />
		</p>
		<div id="pLink|-$languageCode-|"|-if $type eq "content"-| style="display:none;"|-/if-|>
			<p><label for="link">Dirección URL</label>
				<input name="content[|-$languageCode-|][link]" type="text" id="content[|-$languageCode-|][link]" size="60" maxlength="120" value="|-$content.$languageCode.link-|" />
			</p>
			<p><label for="target">Abrir en</label>
			<select name="content[|-$languageCode-|][target]">
				<option value="">Seleccione donde abrirá el link</option>
				<option value="0"|-if $content.$languageCode.target eq 0-| selected="selected"|-/if-|>Misma ventana</option>
				<option value="1"|-if $content.$languageCode.target eq 1-| selected="selected"|-/if-|>Ventana nueva</option>
			</select>
			</p>
		</div>
		<div id="pContent|-$languageCode-|"|-if $type eq "link"-| style="display:none;"|-/if-|>
			<p><label for="content">Texto</label>
				<textarea id="content[|-$languageCode-|][content]" name="content[|-$languageCode-|][content]" rows="10" cols="80" >|-$content.$languageCode.content|htmlentities-|</textarea>
			</p>
		</div>
	</div>
	|-/foreach-|
	<p> 
		<input type="submit" value="Guardar" class="button" /> 
	</p> 
</form>
|-/if-|

 |-if $type eq "section"-|
<form id="editors_here" action="Main.php?do=contentDoEdit" method="post">
 	|-if isset($section)-|
	<input name="content[id]" type="hidden" id="content[id]" value="|-$section.id-|" /> 
	<input name="content[parent]" type="hidden" id="content[parent]" value="|-$section.parent-|" /> 
	|-else-|
	<input name="content[parent]" type="hidden" id="content[parent]" value="|-$parentId-|" /> 
	|-/if-|
	<input name="content[type]" type="hidden" id="content[type]" value="section" /> 
	|-foreach from=$languages item=langItem-|
	<h3>|-$langItem.name|multilang_get_translation:"multilang"-|</h3>
	 	|-assign var=languageCode value=$langItem.code-|
	<div id="edit_section_|-$langItem.languageCode-|">
		<p>  
		<label for="title">Título</label>
		<input name="content[|-$languageCode-|][title]" type="text" id="content[|-$languageCode-|][title]" size="55" maxlength="255" value="|-$section.$languageCode.title|escape-|" />
		</p>
		<p>
		<label for="titleInMenu">Título en menú</label>
		<input name="content[|-$languageCode-|][titleInMenu]" type="text" id="content[|-$languageCode-|][titleInMenu]" size="55" maxlength="255" value="|-$section.$languageCode.titleInMenu|escape-|" />
		</p>
		<p>
		<label for="content">Texto</label>
		<textarea name="content[|-$languageCode-|][content]" cols="70" rows="14" wrap="virtual" id="content[|-$languageCode-|][content]" >|-$section.$languageCode.content|htmlentities-|</textarea> 
		</p>
	</div>
	|-/foreach-| 
	<p> 
		<input type="submit" value="Guardar" class="button" /> 
	</p> 
</form>
|-/if-|
</fieldset>
