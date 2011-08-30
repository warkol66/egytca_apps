<h2>##issues,1,Asuntos##</h2>
<h1>|-if $action eq 'edit'-|Editar|-elseif $action eq 'showLog'-|Ver|-else-|Crear|-/if-| ##issues,2,Asunto##</h1>
|-include file="CommonAutocompleterInclude.tpl" -|
|-include file='IssuesForm.tpl-|
|-if $issue->getId() ne ''-|
|-include file="IssuesEditCategoriesInclude.tpl"-|

<script type="text/javascript" language="javascript" charset="utf-8">
function addActorToIssue(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'actorList'},
				'Main.php?do=issuesDoAddActorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('actorMsgField').innerHTML = '<span class="inProgress">Agregando actor al asunto...</span>';
    $('autocomplete_actors').value = '';
    $('addActorSubmit').disable();
	return true;
}

function removeActorFromIssue(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'actorMsgField'},
				'Main.php?do=issuesDoRemoveActorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('actorMsgField').innerHTML = '<span class="inProgress">Eliminando actor...</span>';
	return true;
}
</script>

<fieldset title="Formulario de actores asociados al ##issues,4,asunto##">
    <legend>Actores</legend>
    <div id="actorMsgField"></div>
    |-if $action neq 'showLog'-|
    <form method="post" style="display:inline;">
        <div id="issueActor" style="position: relative;z-index:10000;">
            |-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Agregar actor al ##issues,4,asunto##" url="Main.php?do=actorsAutocompleteListX&getCandidates=1&issueId="|cat:$issue->getId() hiddenName="actor[id]" disableSubmit="addActorSubmit"-|
	</div>
	<p>
            <input type="hidden" name="do" id="do" value="issuesDoAddActorX" />
            <input type="hidden" name="issueId" id="issueId" value="|-$issue->getId()-|" /> 
            <input type="button" id="addActorSubmit" disabled="disabled" name="addActorSubmit" value="Agregar actor al ##issues,4,asunto##" title="Agregar actos al ##issues,4,asunto##" onClick="javascript:addActorToIssue(this.form)"/>
        </p>
    </form>
    |-/if-|
    <div id="issuesActorsList">
        <ul id="actorList" class="iconOptionsList">
            |-foreach from=$issue->getActors() item=actor-|
            <li id="actorListItem|-$actor->getId()-|">
                |-if $action neq 'showLog'-|
                <form action="Main.php" method="post" style="display:inline;"> 
                    <input type="hidden" name="do" value="issuesDoRemoveActorX" /> 
                    <input type="hidden" name="issueId" value="|-$issue->getid()-|" /> 
                    <input type="hidden" name="actorId" value="|-$actor->getid()-|" /> 
                    <input type="button" name="submit_go_remove_actor" value="Borrar" onclick="if (confirm('Seguro que desea quitar el actor del asunto?')) removeActorFromIssue(this.form);" class="icon iconDelete" /> 
                </form>
                |-/if-|
                |-$actor->getName()-|
            </li>
            |-/foreach-|
        </ul>    
    </div> 
</fieldset>
<p>
    <input type="button" title="Ver Historia" value="Ver Historia" onClick="location.href='Main.php?do=issuesLogTabs&id=|-$issue->getId()-|'" />
</p>
|-/if-|

