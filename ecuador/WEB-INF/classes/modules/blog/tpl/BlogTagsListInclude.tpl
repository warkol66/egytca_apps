<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>

|-foreach from=$blogTagColl item=blogTag name=for_blogTag-|
	|-include file="BlogTagsListRowInclude.tpl"-|
|-/foreach-|
|-if "blogTagsDoEditX"|security_has_access-|

<style>
	.inplaceEditSize20 {
		color: 'red';
	}
</style>

<script type="text/javascript">
function updateName(id, value) {
	$('#span_name_'+id).load(
		'Main.php?do=blogTagsDoEditX',
		{
			id: id,
			paramName: 'name',
			paramValue: value
		}
	);
}

function attachNameInPlaceEditors() {
|-foreach from=$blogTagColl item=blogTag name=for_blogTags_ajax-|
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
|-/foreach-|
}

$(document).ready(function() {
	attachNameInPlaceEditors();
});
</script>
|-/if-|
