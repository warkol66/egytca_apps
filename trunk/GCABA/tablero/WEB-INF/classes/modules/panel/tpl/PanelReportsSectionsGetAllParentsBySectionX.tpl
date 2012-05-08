<script type="text/javascript" src="scripts/lightbox.js"></script>
<script type="text/javascript" language="javascript">
	sectionDataType = document.getElementById('sectionData[type]');
	sectionDataType.value = '|-$type-|';
	$('reportSectionsMsgField').innerHTML  = '';
	new lightbox($('lbOn'));
</script>
<p>
  <label for="sectionData[parentId]">Dentro de</label>
  <select id="sectionData[parentId]" name="sectionData[parentId]" title="parentId"> 
	|-if empty($sections)-|
    <option value="0" selected="selected">Ninguna</option> 
	|-/if-|
	|-foreach from=$sections item=parent name=for_parent-|
    |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|">|-section name=space loop=$level-|&nbsp; |-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
  </select>
</p>
  <input type="hidden" name="sectionData[objectType]" value="|-$objectType-|" />
  <p><label for="sectionData[objectId]">Acerca de</label>
  <select id="sectionData[objectId]" name="sectionData[objectId]" title="objectId" onChange="sectionsGetObjectInfoX(this.form);"> 
	|-if empty($objects)-|
    <option value="0" selected="selected">Ninguno</option> 
	|-/if-|
		<option value="0">Ninguna</option>
	|-foreach from=$objects item=object name=for_object-|
    	<option value="|-$object->getId()-|">|-$object->getName()|truncate:70-|</option> 
	|-/foreach-|
  </select><a id="lbOn" href="#lightbox1" rel="lightbox1" class="lbOn addNew" style="display: none;">Ver Detalle</a></p>
