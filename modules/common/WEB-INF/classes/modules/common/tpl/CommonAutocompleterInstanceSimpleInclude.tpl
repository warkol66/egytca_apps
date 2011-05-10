<script type="text/javascript" language="javascript" charset="utf-8">
function getSelection|-$id-|Id(text, li) {
    $('|-$id-|_selected_id').value = li.id;
    if (!li.hasClassName('informative_only')) {
        var submit = $('|-$disableSubmit-|');
        if (Object.isElement(submit))
    		submit.enable();
	}
}
</script>

|-assign var=onChange value="var submit = $('"|cat:$disableSubmit|cat:"'); if (Object.isElement(submit)) submit.disable();"-|

|-include file="CommonAutocompleterInstanceInclude.tpl" afterUpdateElement="getSelection"|cat:$id|cat:"Id" onComplete=$onChange-|
|-if $hiddenName ne '' -|
	<input type="hidden" id="|-$id-|_selected_id" name="|-$hiddenName-|" value="|-$defaultHiddenValue-|"/>
|-/if-|
