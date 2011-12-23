<form action="Main.php" method="post" id="form_section_|-$section->getId()-|" style="display:none;">
	<input type="hidden" name="do" value="|-$do-|" />
	<input type="hidden" name="form" value="|-$form->getId()-|" />
	<input type="hidden" name="edit_section" value="1" />
	<input type="hidden" name="sectionId" value="|-$section->getId()-|" />
	<input type="text" name="newTitle" value="|-$section->getTitle()-|" />
	<input type="button" value="##500,Cancelar##" onclick="this.parentNode.style.display = 'none'" class="icon iconCancel" />
	<input type="submit" value="##97,Guardar##" class="icon iconActivate" />
</form>
