|-if $issue ne ''-|
<ul id="categoryList" class="iconOptionsList">
  |-foreach from=$issue->getIssueCategorys() item=category-|
	<li id="categoryListItem|-$category->getId()-|">
        <form action="Main.php" method="post" style="display:inline;"> 
          <input type="hidden" name="do" value="issuesDoRemoveCategoryX" /> 
          <input type="hidden" name="issueId" value="|-$issue->getid()-|" /> 
          <input type="hidden" name="categoryId" value="|-$category->getid()-|" /> 
          <input type="button" name="submit_go_remove_category" value="Borrar" onclick="if (confirm('Seguro que desea quitar la categoria?')) issuesDoRemoveCategories(this.form);" class="icon iconDelete" /> 
        </form> |-$category->getName()-|
      </li>
  |-/foreach-|
</ul>
|-/if-|
