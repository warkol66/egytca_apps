<script type="text/javascript" language="JavaScript" >
  function actorsDoAddCategories(form) {
    var fields = form.serialize();
    var myAjax = new Ajax.Updater(
      {success: 'categoryList'},
      'Main.php?do=actorsDoAddCategoryToActorX',
      {
				method: 'post',
				postBody: fields,
				evalScripts: true,
				insertion: Insertion.Bottom
      }
    );
    $('categoryMsgField').innerHTML = "<span class='inProgress'>Agregando a la categoría ...</span>";
  }

  function actorsDoRemoveCategories(form) {
    var fields = form.serialize();
    var myAjax = new Ajax.Updater(
      {success: 'categoryMsgField'},
      'Main.php?do=actorsDoDeleteCategoryFromActorX',
      {
        method: 'post',
        postBody: fields,
        evalScripts: true
      }
    );
    $('categoryMsgField').innerHTML = '<span class="inProgress">Eliminando de la categoría ...</span>';
  }
</script>
<div id="div_actorCategories"> 
  <fieldset title="Agregar ##actors,2,Actor## a categorías de ##actors,2,Actor##">
    <form name="form_edit_actor_categories" id="form_edit_actor_categories" action="Main.php" method="post">
      <p> 
        <label for="categoryId">Categoría</label> 
        <select name="categoryId" id="categoryId"> 
          <option value="">Seleccione Categoría</option> 
    	|-foreach from=$categoryCandidates item=category name=for_categories-|
        <option id="categoryOption|-$category->getId()-|" value="|-$category->getId()-|">|-$category->getName()-|</option> 
    	|-/foreach-|
        </select>
        <input type="button" id="button_edit_actor_add_category" name="button_edit_actor_add_category" title="Agregar" value="Agregar" onClick="javascript: actorsDoAddCategories(this.form)" /> 
        <span id="categoryMsgField"></span>
      </p>
      <p>
        <input type="hidden" id="actorId" name="actorId" value="|-$actor->getId()-|" />
        <input type="hidden" id="do" name="do" value="actorsDoAddCategoryToActorX" />
      </p>
    </form>
    <div id="actorsCategoriesList">
      |-include file="ActorsEditCategoriesListInclude.tpl"-|
    </div> 
  </fieldset> 
</div>
