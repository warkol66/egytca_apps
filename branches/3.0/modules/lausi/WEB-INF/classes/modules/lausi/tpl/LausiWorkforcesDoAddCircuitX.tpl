							<li id="currentCircuitListItem|-$circuit->getId()-|">|-$circuit->getName()-|
							  <form  method="post"> 
								<input type="hidden" name="do" id="do" value="lausiWorkforcesDoDeleteCircuitX" /> 
								<input type="hidden" name="workforceId"  value="|-$workforceId-|" /> 
								<input type="hidden" name="circuitId"  value="|-$circuit->getId()-|" /> 
								<input type="button" value="Eliminar" onClick="javascript:lausiDeleteWorkforceFromCircuit(this.form)" class="iconDelete" /> 
							  </form> 
							</li> 

<script type="text/javascript" language="javascript" >
		
		elements = $('circuitAdder').getElementsByTagName('select');
		options = elements[0].getElementsByTagName('option');
		var i = 0;
		while (i < options.length) {
			if (options[i].value == |-$circuit->getId()-|) {
				options[i].remove();
				break;
			}
			i++;
		}

</script>
