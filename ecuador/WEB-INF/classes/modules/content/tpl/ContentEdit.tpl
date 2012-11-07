|-if $loadAreaedit neq 1-|
	|-include file='ContentEditTinyMceInclude.tpl' element=content languages=$languages plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
|-/if-|
	<h2>Módulo de Contenido</h2>
	<h1>Administrar Contenido</h1>

|-include file='ContentNavigationChainInclude.tpl' navigationChain=$navigationChain-|

<p>Ingrese la información solicitada y haga click en "Guardar"</p>
<fieldset>
	<legend>|-if $action=="create"-|Agregar |-else-|Editar|-/if-||-if $type eq 'content'-|Contenido|-/if-||-if $type eq 'section'-|Sección|-/if-||-if $type eq 'link'-|Link|-/if-|</legend>
|-if $type eq "content" or $type eq "link"-|
	<form id="editors_here" action="Main.php?do=contentDoEdit" method="post">
		|-if $action=="create"-|
			<p>
				<label for="params[type]">Tipo de Contenido</label>
				<select name="params[type]" onchange="javascript:contentShowContentFields(this.value)">
					<option value="0">Contenido</option>
					<option value="2">Link</option>
				</select>
			</p>
		|-/if-|
		|-if $action=="edit"-|
			<input name="id" type="hidden" id="id" value="|-$content->getId()-|" />
			<p>
				<label for="title">Dentro de Sección</label>
				<select name="parentId">
					|-foreach from=$root->getBranch($iteratorCriteria) item=section-|
						<option value="|-$section->getId()-|" |-if $section->isAncestorOf($content)-|selected="selected"|-/if-|>
							|-$section->getNameForSelect()-|
						</option>
					|-/foreach-|
				</select>
			</p>
			|-else-|
			<input name="parentId" type="hidden" id="parentId" value="|-$parentId-|" />
		|-/if-|
		<!--<input name="params[typeX]" type="hidden" id="params[typeX]" value="content" />-->
		|-foreach from=$languages item=langItem-||-if $languages|@count gt 1-|
			<h3>|-$langItem->getName()|multilang_get_translation:"multilang"-|</h3>|-/if-|
			|-assign var=languageCode value=$langItem->getLanguagecode()-|
			|-$temp=$content->setLocale($languageCode)-|


			<div id='edit_content_|-$languageCode-|'>
				<p>
					<label for="title">Título</label>
					<input name="locale[|-$languageCode-|][title]" type="text" id="locale[|-$languageCode-|][title]" size="55" maxlength="255" value="|-$content->getTitle()|escape-|" />
				</p>
				<p>
					<label for="titleInMenu">Título en el menú</label>
					<input name="locale[|-$languageCode-|][titleInMenu]" type="text" id="locale[|-$languageCode-|][titleInMenu]" size="55" maxlength="120" value="|-$content->getTitleinmenu()|escape-|" />
				</p>

				<div id="pContent|-$languageCode-|"|-if $type eq "link"-| style="display:none;"|-/if-|>
					<p><label for="content">Texto</label>
						<textarea id="params[|-$languageCode-|][content_value]" name="params[|-$languageCode-|][content_value]" rows="10" cols="80" >|-$content->getContentValue()|htmlentities-|</textarea>
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
		|-if $action=="edit"-|
			<input name="id" type="hidden" id="id" value="|-$content->getId()-|" />
			|-else-|
			<input name="parentId" type="hidden" id="parentId" value="|-$parentId-|" />
		|-/if-|
		<input name="params[type]" type="hidden" id="params[type]" value="1" />
		|-foreach from=$languages item=langItem-|
			|-if $languages|@count gt 1-|
			<h3>|-$langItem->getName()|multilang_get_translation:"multilang"-|</h3>
			|-/if-|

			|-assign var=languageCode value=$langItem->getLanguagecode()-|
			|-$temp=$content->setLocale($languageCode)-|
			<div id="edit_section_|-$langItem->getLanguagecode()-|">
				<p>
					<label for="title">Título</label>
					<input name="locale[|-$languageCode-|][title]" type="text" id="locale[|-$languageCode-|][title]" size="55" maxlength="255" value="|-$content->getTitle()|escape-|" />
				</p>
				<p>
					<label for="titleInMenu">Título en menú</label>
					<input name="locale[|-$languageCode-|][titleInMenu]" type="text" id="locale[|-$languageCode-|][titleInMenu]" size="55" maxlength="255" value="|-$content->getTitleinmenu()|escape-|" />
				</p>
				<p>
					<label for="content">Texto</label>
					<textarea name="locale[|-$languageCode-|][content_value]" cols="70" rows="14" wrap="virtual" id="locale[|-$languageCode-|][content_value]" >|-$content->getContentValue()|htmlentities-|</textarea>
				</p>
			</div>
		|-/foreach-|
		<p>
			<input type="submit" value="Guardar" class="button" />
			<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=contentList&sectionId=|-$parentId-|'" />
		</p>
	</form>
|-/if-|
</fieldset>
