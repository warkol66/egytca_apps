<script src="Main.php?do=js&name=js&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="twitterUserLightbox" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="twitterDivShowWorking"></div>
	<div class="innerLighbox">
		<div id="twitterShowDiv"></div>
	</div>
</div>
<div id="twitterUsersFilters"><a name="twitterUsersList"></a>
<form action="Main.php" method="get">
	<fieldset title="Formulario de Opciones de búsqueda de usuarios">
		<legend>Opciones de Búsqueda</legend>
		<p><label for="filters[searchString]">Texto a buscar</label>
		<input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="50" />
		</p>
		<p>
			<label for="filters[influence]">Nivel de influencia</label>
			&nbsp; Todos <input name="filters[influence]" type="radio" value="" |-$filters.influence|checked:0-| />
			&nbsp; Mediano  <input name="filters[influence]" type="radio" value="2" |-$filters.influence|checked:2-| />
			&nbsp; Alto <input name="filters[influence]" type="radio" value="3" |-$filters.influence|checked:3-| />
		</p>
		<p>
			<input type="hidden" name="do" value="twitterUsersList" />
			<input type="submit" value="Filtrar">
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=twitterUsersList'"/>|-/if-|
		</p>
	</fieldset>
</form>
</div>
<div id="resultDiv"></div>
<div id="twitterUsersList">
	<table id="tabla-twitterUsers" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
			<tr class="thFillTitle"> 
					<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" /></th>
					<th width="20%">Nombre</th> 
					<th width="15%">Nombre de usuario</th> 
					<th width="20%">Descripción</th> 
					<th width="10%">Actor</th> 
					<th width="10%">URL</th>
					<th width="5%">Seguidores</th> 
					<th width="5%">Amigos</th> 
					<th width="3%">Influencia</th>
					<th nowrap width="2%">&nbsp;</th> 
				</tr> 
		</thead>
		<tbody>|-if $twitterUserColl|@count eq 0-|
			<tr>
				 <td colspan="10">Aún no hay usuarios</td>
			</tr>
		|-else-|
			|-foreach from=$twitterUserColl item=twitterUser name=for_twitterUser-|
			|-assign var=userUrl value=$twitterUser->getUrl()-|
			|-assign var=actor value=$twitterUser->getActor()-|
			<tr id="tr_|-$twitterUser->getId()-|">
				<td align="center"><input type="checkbox" name="selected[]" value="|-$twitterUser->getId()-|"></td>
				<td id="name_|-$twitterUser->getId()-|" valign="top">|-$twitterUser->getName()-|</td>
				<td id="screenName_|-$twitterUser->getId()-|" valign="top"><a href="https://twitter.com/|-$twitterUser->getScreenname()-|" class="twitterUrl " target="_blank">@|-$twitterUser->getScreenname()-|</a></td>
				<td id="description_|-$twitterUser->getId()-|" valign="top">|-$twitterUser->getDescription()-|</td>
				<td id="actor_|-$twitterUser->getId()-|" valign="top">|-if is_object($actor)-||-$actor-||-else-||-/if-|</td>
				<td id="url_|-$twitterUser->getId()-|" valign="top">|-if !empty($userUrl)-|<a href="|-$userUrl-|" class="twitterUrl " target="_blank">|-$userUrl-|</a>|-/if-|</td>
				<td id="followers_|-$twitterUser->getId()-|" valign="top" align="center">|-$twitterUser->getFollowers()-|</td>
				<td id="friends_|-$twitterUser->getId()-|" valign="top" align="center">>|-$twitterUser->getFriends()-|</td>
				<td valign="top" nowrap="nowrap">
					<form action="Main.php" method="post" id="formLevels|-$twitterUser->getId()-|">
							|-foreach from=$levels key=key item=name-|
								|-if $name@first-|<span class="radioLabelIcon">+</span>|-/if-|<input name="params[influence]" type="radio" value="|-$key-|"  title="|-$name-|" |-$twitterUser->getInfluence()|checked:$key-| onChange="javascript:twitterDoEditValue(this.form);"/>|-if $name@last-|<span class="radioLabelIcon">-</span>|-/if-|
							|-/foreach-|
						<input type="hidden" name="id" id="id" value="|-$twitterUser->getid()-|" />
						<input type="hidden" name="do" value="twitterUsersDoEditX" id="do">
					</form>
				</td>
				<td valign="top">
					<img src="images/clear.png" class="icon iconRestore" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterUsersUpdateX", { method: "post", parameters: { id: "|-$twitterUser->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">actualizando usuario...</span>";' value="Actualizar usuario" />
				</td>
			</tr>
			|-/foreach-|
			</tbody> 
			<tfoot>
			|-if $twitterUserColl|@count neq 0-|
				<tr>
					<td colspan="10">
						<form action="Main.php" method="post" id='multipleUsersChangeInfluenceForm'>
							<p>Cambiar el nivel de influencia de los usuarios seleccionados a
								<select name="newInfluence" id="selectUserInfluence">
								|-foreach from=$levels key=key item=name-|
									<option value="|-$key-|">|-$name-|</option>
								|-/foreach-|
								</select>
								|-if isset($pager)-|
									<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
								|-/if-|
								<input type="hidden" name="do" value="twitterUsersDoEditMultipleX" id="do">
								<input type="hidden" name="field" value="Relevance" id="field">
								<input type="button" onClick="javascript:twitterUsersDoEditMultiple(this.form,'resultDiv'); return false;" value="Cambiar Influencia" title="Cambiar Influencia" class="button">
							</p>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
						</form>
					</td>
				</tr>
			|-/if-|
			|-if isset($pager) && ($pager->getLastPage() gt 1)-|
			<tr> 
				<td colspan="10">|-include file="ModelPagerInclude.tpl"-|</td> 
			</tr>
			|-/if-|
		|-/if-|
	</table>
</div>
