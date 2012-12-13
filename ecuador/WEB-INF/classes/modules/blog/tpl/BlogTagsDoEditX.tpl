|-include file="BlogTagsListRowInclude.tpl"-|
<script type="text/javascript">

function attachNameInPlaceEditors|-$blogTag->getId()-|() {
	$('#name_|-$blogTag->getId()-|').egytca('inplaceEdit', 'Main.php?do=blogTagsDoEditX', {
		cssclass: 'inplaceEditSize20',
		submitdata: {
			objectType: 'blogTag',
			objectId: '|-$blogTag->getId()-|',
			paramName: 'name'
		},
		callback: function(value, settings) {
			return chomp(value);
		}
	});
}

attachNameInPlaceEditors|-$measureUnit->getId()-|();

</script>
