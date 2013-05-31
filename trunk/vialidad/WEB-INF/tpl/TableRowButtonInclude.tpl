|-*
  * params:
  *
  * type: [edit|delete] button type
  * action: destination action
  * id: entity ID
  * pager (optional): pager
  * deleteText (only for type=delete): confirmation text. defaults to "Seguro que desea eliminar?"
  *-|

|-if $action|security_has_access-|
	<form action="Main.php" method="get" style="display:inline;">
		<input type="hidden" name="do" value="|-$action-|" />
		<input type="hidden" name="id" value="|-$id-|" />
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		|-if isset($pager) && ($pager->getPage() gt 1)-|
			<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
		|-/if-|
		<input type="submit" name="submit_go_|-$type-|_certificate" value="|-if $type eq "edit"-|Editar|-else-|Borrar|-/if-|"
			class="|-if $type eq "edit"-|icon iconEdit|-else-|icon iconDelete|-/if-|"
			|-if $type eq "delete"-|onclick="return confirm('|-$deleteText|default:"Seguro que desea eliminar?"-|')"|-/if-|
		/>
	</form>
|-/if-|