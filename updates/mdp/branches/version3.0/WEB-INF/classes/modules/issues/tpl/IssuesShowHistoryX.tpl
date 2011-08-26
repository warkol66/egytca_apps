<script type='text/javascript'>
    $('status_info').hide();
</script>
<div id='div_issue'>
    <ul>
        <li>Name: |-$issue->getName()-|</li>
        <li>Description: |-$issue->getDescription()-|</li>
        <li>Updated at: |-$issue->getUpdatedAt()-|</li>
        <li>Impacto: |-$issue->getImpact()-|</li>
        <li>Valoración: |-$issue->getValoration()-|</li>
        <li>Evolución: |-$issue->getEvolution()-|</li>
        <li>Categorías:
            <ul>
            |-foreach from=$issue->getIssueCategorys() item=category-|
                <li>|-$category->getName()-|</li>
            |-/foreach-|
            </ul></li>
        <li>Actores:
            <ul>
            |-foreach from=$issue->getIssueActors() item=issueActor-|
                |-assign var=actor value=$issueActor->getActor()-|
                <li>|-$actor->getName()-|</li>
            |-/foreach-|
            </ul></li>
    </ul>
</div>