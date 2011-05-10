							<li id="currentWorkforceListItem|-$workforce->getId()-|">|-$workforce->getName()-|
							  <form  method="post"> 
								<input type="hidden" name="do" id="do" value="lausiCircuitsDoDeleteWorkforceX" /> 
								<input type="hidden" name="circuitId"  value="|-$circuitId-|" /> 
								<input type="hidden" name="workforceId"  value="|-$workforce->getId()-|" /> 
								<input type="button" value="Eliminar" onClick="javascript:lausiDeleteWorkforceFromCircuit(this.form)" class="iconDelete" /> 
							  </form> 
							</li> 

<script type="text/javascript" language="javascript" charset="utf-8">
		
		elements = $('workforceAdder').getElementsByTagName('select');
		options = elements[0].getElementsByTagName('option');
		var i = 0;
		while (i < options.length) {
			if (options[i].value == |-$workforce->getId()-|) {
				options[i].remove();
				break;
			}
			i++;
		}

</script>
