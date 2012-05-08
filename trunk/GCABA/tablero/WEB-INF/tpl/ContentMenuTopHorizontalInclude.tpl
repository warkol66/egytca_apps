<div class="menuTop">
	<ul>
	|-foreach from=$result.menuDown.menu item=item name=menu_Items-|
		<li style="|-if $smarty.foreach.menu_Items.first-|border-left:none|-elseif $smarty.foreach.menu_Items.last-|border-right:none|-/if-|" |-if $item.titleInMenu|strlen gt 35 || ( $currentLanguageCode eq 'eng' && $item.titleInMenu|strlen gt 28)-| class="large"|-else if $item.titleInMenu|strlen lt 21-| class="small"|-/if-|><a href="Main.php?do=contentShow&id=|-$item.id-|">|-if $item.titleInMenu eq "Área Institucional"-|<span class="area">Área</span><br />Institucional|-else-||-$item.titleInMenu|ireplace:'Área de ':'<span class="area">Área de</span><br />'|ireplace:'de las':'<br />de las<br />'-||-/if-|</a></li>
	|-/foreach-|
	</ul>
	<br class="clearit" />
</div>
