<script type="text/javascript" language="javascript" charset="utf-8">
function getSelection|-$id-|Id(text, li) {
    $('#|-$id-|_selected_id').val($(li).attr('id'));
    if (!($(li).hasClass('informative_only'))) {
        $('#|-$disableSubmit-|').attr('disabled',false);
}
</script>
<!--
|-assign var=onChange value="var submit = $('"|cat:$disableSubmit|cat:"'); if (Object.isElement(submit)) submit.disable();"-| -->
|-assign var=onChange value="var submit = $('#"|cat:$disableSubmit|cat:"'); submit.attr('disable', true);"-|
|-include file="CommonAutocompleterInstanceInclude.tpl" afterUpdateElement="getSelection"|cat:$id|cat:"Id" onComplete=$onChange-|
|-if $hiddenName ne '' -|
	<input type="hidden" id="|-$id-|_selected_id" name="|-$hiddenName-|" value="|-$defaultHiddenValue-|"/>
|-/if-|
