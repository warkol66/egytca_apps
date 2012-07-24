<p>
  <label for="fieldParams[foreignKeyRemote]">foreignKeyRemote</label>
  <select id="fieldParams[foreignKeyRemote]" name="fieldParams[foreignKeyRemote]" title="foreignKeyRemote"> 
    <option value="0" selected="selected">Seleccione Campo</option> 
	  |-foreach from=$fields item=field name=for_fields-|
      <option value="|-$field->getId()-|">|-$field->getName()-|</option> 
	  |-/foreach-|
  </select>
</p>
<p> 
  <label for="fieldParams[onDelete]">onDelete</label> 
  <select name="fieldParams[onDelete]" title="defaultValue">
    <option value="none">none</option>
    <option value="cascade">cascade</option>
    <option value="setnull">setnull</option>
    <option value="restrict">restrict</option>
  </select>
</p>