|-include file="CommonMeasureUnitsListRowInclude.tpl"-|
<script type="text/javascript">

function attachNameInPlaceEditors|-$measureUnit->getId()-|() {
	$('#name_|-$measureUnit->getId()-|').egytca('inplaceEdit', 'Main.php?do=commonDoEditFieldX', {
		cssclass: 'inplaceEditSize20',
		submitdata: {
			objectType: 'measureUnit',
			objectId: '|-$measureUnit->getId()-|',
			paramName: 'name'
		},
		callback: function(value, settings) {
			return chomp(value);
		}
	});
}

function attachCodeInPlaceEditors|-$measureUnit->getId()-|() {
	$('#code_|-$measureUnit->getId()-|').egytca('inplaceEdit', 'Main.php?do=commonDoEditFieldX', {
		submitdata: {
			objectType: 'measureUnit',
			objectId: '|-$measureUnit->getId()-|',
			paramName: 'code'
		},
		callback: function(value, settings) {
			return chomp(value);
		}
	});
}

attachCodeInPlaceEditors|-$measureUnit->getId()-|();
attachNameInPlaceEditors|-$measureUnit->getId()-|();

</script>
