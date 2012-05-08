<script type="text/javascript" src="scripts/lightbox.js"></script>
<script type="text/javascript" language="javascript">
	indicatorDataType = document.getElementById('indicatorData[type]');
	indicatorDataType.value = '|-$type-|';
	$('resultFrameIndicatorsMsgField').innerHTML  = '';
</script>
<p>
  <label for="indicatorData[parentId]">Dentro de</label>
  <select id="indicatorData[parentId]" name="indicatorData[parentId]" title="parentId" onChange="indicatorsGetPosibleObjectsByIndicatorX(this.form); indicatorsGetValuesX(this.form);"> 
	|-if empty($indicators)-|
    <option value="0" selected="selected">Ninguna</option> 
	|-/if-|
	|-foreach from=$indicators item=parent name=for_parent-|
	    |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|">|-section name=space loop=$level-|&nbsp; |-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>
  <input type="hidden" name="indicatorData[objectType]" value="|-$objectType-|" />
  <div id="object_id_selector"></div>