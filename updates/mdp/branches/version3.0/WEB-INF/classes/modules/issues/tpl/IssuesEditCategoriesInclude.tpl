<script language="JavaScript" type="text/javascript">
function issuesAddCategory(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">agregando ##issues,2,Asunto## a la categoría...</span>';
	return true;
}

function issuesRemoveCategory(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('categoryMsgField').innerHTML = '<span class="inProgress">eliminando ##issues,2,Asunto## de la categoría...</span>';
	return true;
}
</script>
<script type="text/javascript" language="JavaScript" >
  function issuesDoAddCategories(form) {
    var fields = form.serialize();
    var myAjax = new Ajax.Updater(
      {success: 'categoryList'},
      'Main.php?do=issuesDoAddCategoryX',
      {
				method: 'post',
				postBody: fields,
				evalScripts: true,
				insertion: Insertion.Bottom
      }
    );
    $('categoryMsgField').innerHTML = "<span class='inProgress'>Agregando a la categoría ...</span>";
  }

  function issuesDoRemoveCategory(form) {
    var fields = form.serialize();
    var myAjax = new Ajax.Updater(
      {success: 'categoryMsgField'},
      'Main.php?do=issuesDoRemoveCategoryX',
      {
        method: 'post',
        postBody: fields,
        evalScripts: true
      }
    );
    $('categoryMsgField').innerHTML = '<span class="inProgress">Eliminando de la categoría ...</span>';
  }
</script>
<div id="div_issueCategories"> 
  <fieldset title="Agregar ##issues,2,Asunto## a categorías de ##issues,2,Asunto##">
	<legend>Categorías</legend>
    <form name="form_edit_issue_categories" id="form_edit_issue_categories" action="Main.php" method="post">
      <p> 
        <label for="categoryId">Categoría</label> 
        <select name="categoryId" id="categoryId"> 
          <option value="">Seleccione Categoría</option> 
    	|-foreach from=$categoryCandidates item=category name=for_categories-|
        <option id="categoryOption|-$category->getId()-|" value="|-$category->getId()-|">|-section name=space loop=$category->getLevel()-| &nbsp; &nbsp;|-/section-||-$category->getName()-|</option> 
    	|-/foreach-|
        </select>
        <input type="button" id="button_edit_issue_add_category" name="button_edit_issue_add_category" title="Agregar" value="Agregar" onClick="javascript: issuesDoAddCategories(this.form)" /> 
        <span id="categoryMsgField"></span>
      </p>
      <p>
        <input type="hidden" id="issueId" name="issueId" value="|-$issue->getId()-|" />
        <input type="hidden" id="do" name="do" value="issuesDoAddCategoryX" />
      </p>
    </form>
    <div id="issuesCategoriesList">
		<ul id="categoryList" class="iconOptionsList">
			|-foreach from=$issue->getIssueCategorys() item=category-|
			<li id="categoryListItem|-$category->getId()-|">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="issuesDoRemoveCategoryX" /> 
							<input type="hidden" name="issueId" value="|-$issue->getid()-|" /> 
							<input type="hidden" name="categoryId" value="|-$category->getid()-|" /> 
							<input type="button" name="submit_go_remove_category" value="Borrar" onclick="if (confirm('Seguro que desea quitar la categoria?')) issuesRemoveCategory(this.form);" class="icon iconDelete" /> 
						</form> |-$category->getName()-|
					</li>
			|-/foreach-|
			</ul>    
		</div> 
  </fieldset> 
</div>
