<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>

|-foreach from=$measureUnitColl item=measureUnit name=for_measureUnits-|
	|-include file="CommonMeasureUnitsListRowInclude.tpl"-|
|-/foreach-|
|-if "commonMeasureUnitsDoEditX"|security_has_access-|

<style>
	.inplaceEditSize20 {
		color: 'red';
	}
</style>

<script type="text/javascript">
function updateCode(id, value) {
	$('#span_code_'+id).load(
		'Main.php?do=commonDoEditFieldX',
		{
			id: id,
			paramName: 'code',
			paramValue: value
		}
	);
}
function updateName(id, value) {
	$('#span_name_'+id).load(
		'Main.php?do=commonDoEditFieldX',
		{
			id: id,
			paramName: 'name',
			paramValue: value
		}
	);
}

function attachNameInPlaceEditors() {
|-foreach from=$measureUnitColl item=measureUnit name=for_measureUnits_ajax-|
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
|-/foreach-|
}

function attachCodeInPlaceEditors() {
	|-foreach from=$measureUnitColl item=measureUnit-|
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
	|-/foreach-|
}

$(document).ready(function() {
	attachCodeInPlaceEditors();
	attachNameInPlaceEditors();
});
</script>
|-/if-|