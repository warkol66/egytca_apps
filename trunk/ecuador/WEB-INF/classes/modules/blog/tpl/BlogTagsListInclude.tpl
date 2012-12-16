	<tr> 
		<td>
			|-if "blogTagsDoEditX"|security_has_access-|
			<span id="name_|-$blogTag->getId()-|" name="params[name]" class="in_place_editable">|-$blogTag->getName()-|</span>
			|-else-|
			|-$blogTag->getName()-|
			|-/if-|
		</td>
		<td>|-$blogTag->countBlogEntrys()-| (|-$blogTag->getPublishedEntries()-|)</td>
		<td nowrap>
			|-if "blogTagsDoEditX"|security_has_access-|
				<input type="hidden" name="do" value="blogTagsDoEditX" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() gt 1)-|
				<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
				|-/if-|
				<input type="hidden" name="id" value="|-$blogTag->getid()-|" />
			|-/if-|
			|-if "blogTagsDoDeleteX"|security_has_access-|
			<form action="Main.php" method="post" style="display:inline;">
				<input type="hidden" name="do" value="blogTagsDoDelete" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() gt 1)-|
				<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
				|-/if-|
				<input type="hidden" name="id" value="|-$blogTag->getid()-|" />
				<input type="submit" name="submit_go_delete_blogTag" value="Borrar" title="Eliminar" onclick="return confirm('¿Seguro que desea eliminar la etiqueta?')" class="icon iconDelete" />
			</form>
			|-/if-|
		</td>
	</tr>
