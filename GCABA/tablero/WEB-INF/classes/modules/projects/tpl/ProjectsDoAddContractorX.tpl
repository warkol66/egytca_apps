<script type="text/javascript" language="javascript" charset="utf-8">
	var contractorsList;
	|-if $type eq '1'-|
		contractorsList = $('large_contractors_list');
	|-else-|
		contractorsList = $('small_contractors_list');
	|-/if-|
	var option;
	
	|-foreach from=$contractors item=contractor-|
		option = new Element('option', {value: '|-$contractor->getId()-|'}).update('|-$contractor->getName()-|');
		try {
	    	contractorsList.add(option, null); // standards compliant; doesn't work in IE
	  	}
	  	catch(ex) {
	    	contractorsList.add(option); // IE only
	  	}
	|-/foreach-|
</script>

|-if $message eq 'success'-|
	|-if count($contractors) > 0 -|
		<span class="resultSuccess">Contratista agregado.</span>
	|-else-|
		<span class="resultFailure">No habían contratistas que agregar.</span>
	|-/if-|
|-else-|
	<span class="resultFailure">Error al agregar contratista.</span>
|-/if-|