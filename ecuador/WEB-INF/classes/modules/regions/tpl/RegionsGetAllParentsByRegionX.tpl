<script type="text/javascript" language="javascript">
	regionDataType = document.getElementById('regionData[type]');
	regionDataType.value = |-$type-|;
</script>
<p>
  <label for="regionData[parentId]">Dentro de</label>
  <select id="regionData[parentId]" name="regionData[parentId]" title="parentId"> 
	|-if $type eq constant("RegionPeer::COUNTRY") or empty($regions)-|
    <option value="1" selected="selected">Ninguna</option> 
	|-/if-|
	|-foreach from=$regions item=parent name=for_parent-|
    |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|">|-section name=space loop=$level-|&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>
