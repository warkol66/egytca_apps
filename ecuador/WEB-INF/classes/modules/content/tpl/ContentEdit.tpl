

<h2>Módulo de Contenido</h2>
<h1>Administrar Contenido</h1>

|-if !isset($notValidId) or  $notValidId neq 1-|

<script type="text/javascript">
|-include file='ContentJs.tpl'-|
</script>

|-include file='ContentNavigationChainInclude.tpl' navigationChain=$navigationChain-|

<p>Ingrese la información solicitada y haga click en "Guardar"</p>

<fieldset>
	<legend>|-if $action=="create"-|Agregar |-else-|Editar|-/if-||-if $type eq 'content'-|
		Contenido|-/if-||-if $type eq 'section'-|Sección|-/if-||-if $type eq 'link'-|Link|-/if-|</legend>
	<form id="editors_here" action="Main.php?do=contentDoEdit" method="post">
	|-if $content->isNew()-|
		<p>
			<label for="params[type]">Tipo de Contenido</label>
			<select class="type" name="params[type]" id="params[type]">
				<option value="0">Contenido</option>
				<option value="1">Sección</option>
				<option value="2">Link</option>
			</select>
		</p>
	|-/if-|
	|-if not $content->isNew()-|
		<input name="id" type="hidden" id="id" value="|-$content->getId()-|"/>
		|-if $action=="edit" && $content->getType()!=1-|
			<p>
				<label for="parentId">Dentro de Sección</label>
				<select name="parentId" id="parentId">
					|-foreach from=$root->getBranch($iteratorCriteria) item=section-|
						<option value="|-$section->getId()-|"
								|-if $section->isAncestorOf($content)-|selected="selected"|-/if-|>
							|-section name=space loop=$section->getLevel()-|&nbsp;&nbsp;&nbsp; |-/section-||-$section->getNameForSelect()-|
						</option>
					|-/foreach-|
				</select>
			</p>
		|-/if-|
	|-else-|
		<input name="parentId" type="hidden" value="|-$parentId-|"/>
	|-/if-|

		<p class="link" |-if $content->getType()!=2 -|style="display:none"|-/if-|>
			<label for="params[link]">Dirección URL</label>
			<input id="params[link]" name="params[link]" type="text" size="55" maxlength="255"
				   value="|-$content->getLink()-|"/>
		</p>

		<p class="link" |-if $content->getType()!=2-|style="display:none"|-/if-|>
			<label for="params[target]">Abrir en</label>
			<select name="params[target]" id="params[target]">
				<option value="">Seleccione donde abrirá el link</option>
				<option value="0"|-if $content->getTarget() eq 0-| selected="selected"|-/if-|>Misma ventana
				</option>
				<option value="1"|-if $content->getTarget() eq 1-| selected="selected"|-/if-|>Ventana nueva
				</option>
			</select>
		</p>

	|-foreach from=$languages item=langItem-||-if $languages|@count gt 1-|
		<h3>|-$langItem->getName()|multilang_get_translation:"multilang"-|</h3>|-/if-|
		|-assign var=languageCode value=$langItem->getLanguagecode()-|
		|-$temp=$content->setLocale($languageCode)-|


		<div id='edit_content_|-$languageCode-|'>
			<p>
				<label for="locale[|-$languageCode-|][title]">Título</label>
				<input class="emptyValidation" name="locale[|-$languageCode-|][title]" type="text" id="locale[|-$languageCode-|][title]"
					   size="55" maxlength="255" value="|-$content->getTitle()|escape-|"/>
			</p>

			<p>
				<label for="locale[|-$languageCode-|][titleInMenu]">Título en el menú</label>
				<input name="locale[|-$languageCode-|][titleInMenu]" type="text"
					   id="locale[|-$languageCode-|][titleInMenu]" size="55" maxlength="120"
					   value="|-$content->getTitleinmenu()|escape-|"/>
			</p>

			<div id="pContent|-$languageCode-|" class="not_link" |-if $content->getType()==2-|style="display:none"|-/if-|>
				<p><label for="locale[|-$languageCode-|][body]">Texto</label>
					<textarea id="locale[|-$languageCode-|][body]" name="locale[|-$languageCode-|][body]" rows="10"
							  cols="80">|-$content->getBody()|htmlentities-|</textarea>
				</p>
			</div>
		</div>
	|-/foreach-|
		<p>
            |-javascript_form_validation_button value=Guardar-|
			<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar"
				   value="Regresar" onClick="location.href='Main.php?do=contentList&sectionId=|-$parentId-|'"/>
		</p>
	</form>
</fieldset>
|-if $loadAreaedit neq 1-|
|-include file='ContentEditTinyMceInclude.tpl' element=content languages=$languages plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
|-/if-|

|-else-|
<div class="errorMessage">El identificador de contenido ingresado no es válido. Seleccione un contenido de la lista  haciendo <a href="Main.php?do=contentList">click aquí</a>.</div>
|-/if-|