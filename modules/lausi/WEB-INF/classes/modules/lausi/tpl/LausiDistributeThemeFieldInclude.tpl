<label>Motivo</label>
<select name="themeId" id="themeIdSelectDistribute" onChange="javascript:lausiUpdateDistributeCount();">
		<option value="">Seleccione un Motivo</option>
	|-foreach from=$themes item=theme name=for_themes-|
		<option value="|-$theme->getId()-|" |-if (isset($themeId)) and ($themeId eq $theme->getId()) -|selected="selected"|-/if-|>|-$theme->getName()-| - |-$theme->getShortName()-|</option>
	|-/foreach-|
</select>
|-include file="LausiThemeCreateButtonInclude.tpl"-| 
</p>
	|-assign var=theme value=$themes.0-|
<p>
	<label>Afiches Distribuidos</label> <span id="themeDistributedCount"></span> <span id="msgBoxDistributeCount"></span>
</p>


