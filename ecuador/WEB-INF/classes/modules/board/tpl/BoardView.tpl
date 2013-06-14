<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
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
<div class="tags">
	<p>Resultados: |-foreach from=$usersBonds item=bond-|
		<a href="#" onClick="javascript:getUsers(|-$bond->getType()-|);">|-$bond->getName()-|</a>
	|-/foreach-|</p>Haga click en los resultados para ver quiénes los seleccionaron
</div><br />
<div id="users"></div>
|-foreach from=$bonds key=key item=bond-|
	<input type="button" name="|-$bond-|" value="|-$bond-|" id="bond_|-$key-|" onClick="javascript:addBond(|-$key-|);" class="bondButton|-if $bond|count_characters gt 25-|Wide|-/if-|" |-if in_array($key,$loggedBonds)-|disabled="disabled"|-/if-|>
|-/foreach-|
		<p><br />
<input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"></p>
</div>
	|-include file='BoardCommentsInclude.tpl' challenge=$boardChallenge comments=$comments bonds=$bonds-|
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
			url: 'Main.php?do=boardBondsGetUsersX',
			data: {id: id},
			type: 'post',
			success: function(data){
				$('#users').html(data);
			}
		});
		$('#users').html('<span class="inProgress">Buscando usuarios...</span>');
	}
</script>
