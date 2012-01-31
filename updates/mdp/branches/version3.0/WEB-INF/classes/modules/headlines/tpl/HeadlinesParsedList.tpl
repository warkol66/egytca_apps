|-include file="HeadlinesParsedListInclude.tpl" -|

<div>
    <form id="form" action="Main.php?do=headlinesDoParseX" method="POST">
        <input name="campaignId" value="|-$campaignId-|" type="hidden" />
        <input name="q" value="" />
        <a id="search_button" href="#" onclick="return false;">Buscar</a>
    </form>
</div>
<script type="text/javascript">
$("search_button").observe('click', function(event) {
    new Ajax.Updater('list', "Main.php?do=headlinesDoParseX", {
        parameters: $('form').serialize(),
        insertion: 'top'
    });
});
</script>
