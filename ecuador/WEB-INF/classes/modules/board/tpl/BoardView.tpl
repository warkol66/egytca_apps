<h2>Desafíos</h2>
<p>Esta sección permitirá el diálogo e intercambio de ideas alrededor de temas de interés entre los líderes parroquiales.</p>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
|-if isset($finished)-|
	<div id="div_boardChallenges">Para ver el desafío vigente haga click <a href="Main.php?do=boardView">aquí</a></div>
|-else-|
	<div id="div_boardChallenges">Para ver los desafíos anteriores haga click <a href="Main.php?do=boardShow&finished=true&view=true">aquí</a></div>
|-/if-|
|-if $message eq "captcha"-|
<div id="errorMessage">Captcha incorrecto, intente nuevamente</div>
|-/if-|
|-if !is_object($boardChallenge) or isset($boardDeleted)-|
		<div>Entrada no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
 Puede regresar a la página principal del board haciendo click <a href="Main.php?do=boardShow">aquí</a></div>
|-elseif $message eq "noChallengeIdRequested"-|
		<div>No se ingresó inguna entrada, debe identificar una entrada para visualizarla. <br />
Puede regresar a la página principal del board haciendo click <a href="Main.php?do=boardShow">aquí</a></div>
|-elseif isset($current) and $current eq 'false'-|
		<div>No hay desafío actualmente <br />
Puede regresar a la página principal del board haciendo click <a href="Main.php?do=boardShow">aquí</a></div>
|-else-|
<!-- begin board01 -->
<div class="article">
|-*<h5>|-$boardChallenge->getCreationDate()|date_format:"%A %e de %B de %Y"-|</h5>*-|
<h2>|-$boardChallenge->getTitle()-|</h2>
<div id="completeText">
|-$boardChallenge->getBody()-|
</div>
<p>&nbsp;</p>
<div id="msgBond"></div>
<div class="boardResults">
	<h4>Haga click en los resultados para ver quiénes los seleccionaron</h4>
		|-foreach from=$bonds key=key item=bond-|
		<a href="javascript:void(null);" onClick="javascript:getUsers(|-$key-|);">|-$bond-|</a>&nbsp; 
	|-/foreach-|
</div>
<div id="users"></div>
|-if !isset($finished)-|<div class="buttonsVotation">
|-foreach from=$bonds key=key item=bond-|
	<input type="button" name="|-$bond-|" value="|-$bond-|" id="bond_|-$key-|" onClick="javascript:addBond(|-$key-|);" class="bondButton|-if $bond|count_characters gt 25-|Wide|-/if-|" |-if in_array($key,$loggedBonds)-|disabled="disabled"|-/if-|>
|-/foreach-|</div>
|-/if-|
		<p><br />

|-if !isset($show)-|
<input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"><input name="goToFinished" type="button" onClick="location.href='Main.php?do=boardShow&finished=true&view=true'" value="Ver los desafíos anteriores" >
		</p>
|-/if-|
</div>
	|-include file='BoardCommentsInclude.tpl' challenge=$boardChallenge comments=$comments bonds=$bonds finished=$finished-|
	|-if $moduleConfig.comments.useComments.value eq "YES"-|
	|-/if-|

|-/if-|
<script type="text/javascript">
	function addBond(id){
		$.ajax({
			url: 'Main.php?do=boardDoAddBondToChallengeX',
			data: {bondId: id, challengeId: |-$boardChallenge->getId()-|},
			type: 'post',
			success: function(data){
				$('.tags').html(data);
			}
		});
		$('.tags').html('<span class="inProgress">Actualizando...</span>');
		$('#bond_' + id).attr("disabled", "disabled");
	}
	
	function getUsers(id){
		$.ajax({
			url: 'Main.php?do=boardBondsGetUsersX&chalengeId=|-$boardChallenge->getId()-|&type='+id,
			data: {id: id},
			type: 'post',
			success: function(data){
				$('#users').html(data);
			}
		});
		$('#users').html('<span class="inProgress">Buscando usuarios...</span>');
	}
</script>
