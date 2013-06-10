<script type="text/javascript">
function makeUrl(url) {
    type=document.getElementById("view_by").value;
    returnUrl=url+"%26type%3D"+type;
    returnUrl+="%26id%3D"+document.getElementById("params["+type+"]").value;
    return returnUrl;
}

function showGraph() {
    dataUrl=makeUrl("Main.php%3Fdo%3DissuesViewXml");
    var chart = new FusionCharts("scripts/FusionCharts/MSLine.swf", "ChartId", "640", "420", "0", "0");
    chart.setDataURL(dataUrl);
    chart.render("chartdiv");
}
</script>

<h2>Asuntos</h2>
<h1>Ver Asuntos</h1>

<p>
<input type="button" id="issuesList" name="issuesList" title="Ir a listado de Asuntos" value="Ir a listado de Asuntos" onClick="location.href='Main.php?do=issuesList'" />
</p>

<hr /><br />

<p>
    <div id="div_view_by">
        <label for="view_by">Ver por</label>
        <select id="view_by" name="view_by" onChange="javascript:revealOptions()">
            <option value="issues">asunto</option>
            <option value="category">categoría</option>
            <option value="actor">actor</option>
        </select>
    </div>

    <div id="div_name">
        <label for="params[issues]">Asuntos</label>
        <select id="params[issues]" name="params[issues]" title="issues">
        |-foreach from=$issues item=issue-|
            <option value="|-$issue->getId()-|">|-$issue->getName()-|</option>
        |-/foreach-|
        </select>
    </div>

    <div id="div_category">
        <label for="params[category]">Categoría</label>
        <select id="params[category]" name="params[category]" title="Categoría">
        |-foreach from=$categories item=category-|
            <option value="|-$category->getId()-|">|-$category->getName()-|</option>
        |-/foreach-|
        </select>
    </div>

    <div id="div_actor">
        <label for="params[actor]">Actor</label>
        <select id="params[actor]" name="params[actor]" title="Actor">
        |-foreach from=$actors item=actor-|
            <option value="|-$actor->getId()-|">|-$actor->getSurname()-|</option>
        |-/foreach-|
        </select>
    </div>

    <div id="div_dates">
        <label for="params[date][from]">Desde</label>
        <input id="params[date][from]" name="params[date][from]" type='text' value='¿fecha minima?' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[date][from]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
        &#160;<!-- blank -->
        <label for="params[date][to]">Hasta</label>
        <input id="params[date][to]" name="params[date][to]" type='text' value='¿fecha maxima?' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[date][to]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
    </div>

</p>

<hr /><br />

<input type='button' value='graficar' onClick='showGraph()' />

<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
<div id="chartdiv" align="center"></div>
