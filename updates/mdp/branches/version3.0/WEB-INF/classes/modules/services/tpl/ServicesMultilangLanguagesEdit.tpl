<h2>##multilang,1,Multi-idioma##</h2>
|-if $action eq 'edit'-|
<h1>##multilang,11,Editar Idioma##</h1>
<p>##multilang,12,A continuación se muestra el formulario de edición de idioma. Modifique los datos y haga click en "Aceptar" para guardar los cambios.##
|-else-|
<h1>##multilang,13,Crear Idioma##</h1>
<p>##multilang,14,A continuación se muestra el formulario de creación de idioma. Ingrese los datos y haga click en "Aceptar" para crear el idioma.##
|-/if-|
<div id="div_language">
	|-if $message eq "error"-|
	<div class='failureMessage'>##multilang,15,Ha ocurrido un error al intentar guardar el idioma##</div>
	|-/if-|
  <form name="form_edit_language" id="form_edit_language" action="Main.php" method="post">
    <fieldset title="##multilang,18,Formulario de edición de datos de idioma##">
    <legend>|-if $action eq 'edit'-|##multilang,16,Editar idioma##|-else-|##multilang,17,Crear idioma##|-/if-|</legend>
    <p>##multilang,19,Ingrese los datos del idioma##</p>
    <p>
      <label for="name">##multilang,8,Nombre##</label>
      <input type="text" id="name" name="name" value="|-if $action eq 'edit'-||-$language->getname()-||-/if-|" title="##multilang,8,Nombre##" maxlength="50" />
		</p>
    <p>
      <label for="code">##multilang,9,Código##</label>
      <input type="text" id="code" name="code" value="|-if $action eq 'edit'-||-$language->getcode()-||-/if-|" title="##multilang,9,Código##" maxlength="10" />
    </p>
    <p>
      <label for="locale">Locale</label>
      <input type="text" id="locale" name="locale" value="|-if $action eq 'edit'-||-$language->getLocale()-||-/if-|" title="Locale" maxlength="20" />
    </p>
    <p> |-if $action eq 'edit'-|
      <input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$language->getid()-||-/if-|" />
      |-/if-|
      <input type="hidden" name="action" id="action" value="|-$action-|" />
      <input type="hidden" name="do" id="do" value="servicesMultilangLanguagesDoEdit" />
      <input type="submit" id="button_edit_language" name="button_edit_language" title="##common,3,Aceptar##" value="##common,3,Aceptar##" class="button" />
    </p>
    </fieldset>
  </form>
</div>
