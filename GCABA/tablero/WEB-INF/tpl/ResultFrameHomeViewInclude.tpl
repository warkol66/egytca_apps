<h1>Marco de Resultados</h1>
<form action="Main.php" method="get" style="display:inline;">
|-*Opciones para llamado por Include*-|
|-if $result.policyGuidelines-||-assign var=policyGuidelines value=$result.policyGuidelines-||-/if-|
|-if $result.resultFrameIndicators-||-assign var=resultFrameIndicators value=$result.resultFrameIndicators-||-/if-|
|-if $result.selectedPolicyGuideline-||-assign var=selectedPolicyGuideline value=$result.selectedPolicyGuideline-||-/if-|
|-*/Opciones para llamado por Include*-|
<p>Seleccione Préstamo&nbsp;
	<select id="policyGuidelineId" name="policyGuidelineId" title="Préstamo"  onchange="this.form.submit();">
		<option value="0">Seleccione</option>
	|-foreach from=$policyGuidelines item=policyGuideline name=for_policyGuidelines-|
		<option value="|-$policyGuideline->getId()-|">|-$policyGuideline->getName()-|</option>
	|-/foreach-|
	</select></p>
	<input type="hidden" name="do" value="panelResultFramesView" />
</form>

