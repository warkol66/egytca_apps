<div id="div_issue">
	|-if $action neq 'showLog'-|<p>Ingrese los datos del ##issues,2,Asunto##</p>|-/if-|
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el ##issues,4,asunto##</span>|-/if-|
	<form name="form_edit_issue" id="form_edit_issue" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un issue">
			<legend>Formulario de Administración de ##issues,1,Asuntos##</legend>
			<p>
				<label for="params[name]">##issues,2,Asunto##</label>
				<input type="text" id="params[name]" name="params[name]" size="70" value="|-$issue->getName()|escape-|" title="##issues,2,Asunto##" |-$action|disabled-| |-if $action neq "showLog"-||-js_char_counter assign="js_counter" object=$issue columnName="name" fieldName="params[name]" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" countetTitle="Cantidad de caracteres restantes" showHide=1 useSpan=0-||-/if-||-$Counter.pre-| /> |-$Counter.pos-| 
			</p>
			<div id="issueParent" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_parentId" label="Sub asunto de" url="Main.php?do=issuesAutocompleteListX" hiddenName="params[parentId]" defaultHiddenValue=$issue->getParentId() disableSubmit="button_edit_sub_issue" defaultValue=$issue->getParentIssue()-|
			</div>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="65" rows="6" wrap="VIRTUAL" id="params[description]" title="Descripción" |-$action|disabled-|>|-$issue->getDescription()|escape-|</textarea>
			</p>
			<p>
				<label for="params[impact]">Impacto</label>
				<select id="params[impact]" name="params[impact]" |-$action|disabled-| >
				|-foreach from=$issueImpactTypes key=impactKey item=impact name=for_impact-|
        		<option value="|-$impactKey-|" |-$issue->getImpact()|selected:$impactKey-|>|-$impact-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[valoration]">Valoración</label>
				<select id="params[valoration]" name="params[valoration]" |-$action|disabled-| >
				|-foreach from=$issueValorationTypes key=valorationKey item=valoration name=for_valoration-|
        		<option value="|-$valorationKey-|" |-$issue->getValoration()|selected:$valorationKey-|>|-$valoration-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[evolution]">Evolución</label>
				<select id="params[evolution]" name="params[evolution]" |-$action|disabled-| >
				|-foreach from=$issueEvolutionStages key=stageKey item=stage name=for_stage-|
        		<option value="|-$stageKey-|" |-$issue->getEvolution()|selected:$stageKey-|>|-$stage-|</option>
				|-/foreach-|
				</select>
			</p>
			|-if isset($loginUser) && $loginUser->isSupervisor() && $action neq 'create'-|
				<p><label for="changedBy">|-if $issue->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label> |-$issue->changedBy()-| - |-$issue->getUpdatedAt()|change_timezone|dateTime_format-| </p>
			|-/if-|
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$issue->getid()-|" />
				|-/if-|
        |-if $action neq 'showLog'-|
				|-include file="HiddenInputsInclude.tpl" action="$action" filters="$filters" page="$page"-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="issuesDoEdit" />
				<input type="submit" id="button_edit_issue" name="button_edit_issue" title="Guardar cambios" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=issuesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
        |-/if-|
			</p>
		</fieldset>
	</form>
</div>
