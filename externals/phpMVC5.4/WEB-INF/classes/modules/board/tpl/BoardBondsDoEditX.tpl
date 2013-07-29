|-include file="BoardBondsListRowInclude.tpl" -|
<script type="text/javascript">

function attachNameInPlaceEditors|-$boardBond->getId()-|() {
	$('#name_|-$boardBond->getId()-|').egytca('inplaceEdit', 'Main.php?do=boardBondsDoEditX', {
		cssclass: 'inplaceEditSize20',
		submitdata: {
			objectType: 'boardBond',
			objectId: '|-$boardBond->getId()-|',
			paramName: 'name'
		},
		callback: function(value, settings) {
			return chomp(value);
		}
	});
}

attachNameInPlaceEditors|-$boardBond->getId()-|();

</script>
