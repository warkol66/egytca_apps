  <p><label for="indicatorData[objectId]">Acerca de</label>
  <select id="indicatorData[objectId]" name="indicatorData[objectId]" title="objectId" onChange="indicatorsGetObjectInfoX(this.form);"> 
	|-if empty($objects)-|
    <option value="0" selected="selected">Ninguno</option> 
	|-/if-|
		<option value="0">Ninguna</option>
	|-foreach from=$objects item=object name=for_object-|
    	<option value="|-$object->getId()-|">|-$object->getName()|truncate:70-|</option> 
	|-/foreach-|
  </select><a id="lbOn" href="#lightbox1" rel="lightbox1" class="lbOn linkView" style="display: none;">Ver Detalle</a></p>

<script type="text/javascript" language="javascript">
	$('resultFrameIndicatorsMsgField').innerHTML  = '';
	new lightbox($('lbOn'));
</script>

