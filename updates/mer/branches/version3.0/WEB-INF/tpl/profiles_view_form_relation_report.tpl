<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tableTdBorders'>
	<tr>
		<th colspan='3'> <form method="GET" action="Main.php" style="display:inline">
				<input type="hidden" name="do" value="profilesFormRelView" />
				<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
				##210,Relaciones entre## |-$actor1->getName()-| ##211,y## 
				|-if $actor2->getId()-|
				|-$actor2->getName()-|
				|-else-|
				<select onchange="this.form.submit()" name='actor2'>
					|-html_options options=$actors-|
				</select>
				|-/if-|
			</form></th>
	</tr>
	|-if $actor2->getId()-|
	|-foreach from=$forms item=form -|
	|-include file=profiles_view_form_relationship_section.tpl section=$form->getRootSection() -|
	|-/foreach-|
	|-/if-|
</table>
