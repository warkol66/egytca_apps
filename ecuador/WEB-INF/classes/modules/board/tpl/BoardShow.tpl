<div id="div_boardChallenges">
		|-foreach from=$boardChallengeColl item=boardChallenge name=for_boardChallenges-|
			|-assign var=start value=$boardChallenge->getStartDate()|date_format:"%Y/%m/%d"-|
			|-assign var=end value=$boardChallenge->getEndDate()|date_format:"%Y/%m/%d"-|
			|-assign var=now value=$smarty.now|date_format:"%Y/%m/%d"-|
			|-if ($now ge $start) and ($now le $end)-|
				|-include file="BoardView.tpl" boardChallenge=$boardChallenge usersBonds=$usersBonds comments=$comments-|
				<h1>Próximos Desafíos</h1>
			|-else-|
			<!--class ex board01-->
			<div id="article|-$boardChallenge->getId()-|" class="article">
				|-assign var="eId" value=$boardChallenge->getId()-|
				<h5>|-$boardChallenge->getCreationDate()|change_timezone|date_format:"%A %e %B de %Y - %R"-|</h5>
				<h2><a href="Main.php?do=boardView&url=|-$boardChallenge->getUrl()-|">|-$boardChallenge->gettitle()-|</a></h2>
				<div id="summary">|-if $boardChallenge->getBody()|mb_count_characters:true:true > $moduleConfig.charsInList-|
				|-assign var=id value=$boardChallenge->getId()-|
				|-assign var=url value="Main.php?do=boardView&id=$id"-|
				|-assign var=readMore value="<p class='readMore'><a href='$url'> ... seguir leyendo</a></p>"-|
				|-$boardChallenge->getBody()|mb_truncate_strip_tags:$moduleConfig.charsInList:"...":$readMore-|
				|-else-||-$boardChallenge->getBody()-|
				|-/if-|
				</div>
				<div class="masInfo">
					 <a class="commentsBut" href="Main.php?do=boardView&id=|-$boardChallenge->getId()-|" title="Haga click aquí para comentar">Comentarios: |-$boardChallenge->getApprovedCommentsCount()-|</a>
				</div>
			<div class="close"></div>
			</div>
			|-/if-|
		|-/foreach-|			
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<div class="pages">|-if $smarty.get.page == ''-||-include file="BoardHomePaginateInclude.tpl"-||-else-||-include file="BoardShowPaginateInclude.tpl"-||-/if-|</div>
		|-/if-|
	</div>
	<div>
</div>
