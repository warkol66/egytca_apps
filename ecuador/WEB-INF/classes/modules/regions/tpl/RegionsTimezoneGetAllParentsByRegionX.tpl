<script type="text/javascript" language="javascript">
	$('#regionData[type]').val(|-$type-|);
</script>
<p>
  <label for="regionData[parentId]">Dentro de</label>
  <select id="regionData[parentId]" name="regionData[parentId]" title="parentId"> 
	|-foreach from=$regionstimezone item=parent name=for_parent-|
    <option value="|-$parent-|">|-$parent-|</option> 
	|-/foreach-|
  </select>
</p>
