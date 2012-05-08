<script type="text/javascript" language="javascript">
	positionDataType = document.getElementById('positionData[type]');
	positionDataType.value = |-$type-|;
</script>
<p>
  <label for="positionData[parentId]">Dentro de</label>
  <select id="positionData[parentId]" name="positionData[parentId]" title="parentId"> 
	|-if $type eq constant("TableroPositionPeer::LOWEST_TYPE") or empty($positions)-|
    <option value="0" selected="selected">Ninguna</option> 
	|-/if-|
	|-foreach from=$positions item=parent name=for_parent-|
    |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|">|-section name=space loop=$level-|&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>
