|-if $actor ne ''-|
<ul id="categoryList" class="iconOptionsList">
  |-foreach from=$actor->getActorCategorys() item=category-|
	<li id="categoryListItem|-$category->getId()-|">
        <form action="Main.php" method="post" style="display:inline;"> 
          <input type="hidden" name="do" value="actorsDoDeleteCategoryFromActorX" /> 
          <input type="hidden" name="actorId" value="|-$actor->getid()-|" /> 
          <input type="hidden" name="categoryId" value="|-$category->getid()-|" /> 
          <input type="button" name="submit_go_remove_category" value="Borrar" onclick="if (confirm('¿Seguro que desea quitar la categoria?')) actorsDoRemoveCategories(this.form);" class="icon iconDelete" /> 
        </form> |-$category->getName()-|
      </li>
  |-/foreach-|
</ul>
|-/if-|
