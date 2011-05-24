<h2>##multilang,1,Multi-idioma##</h2>
<h1>##multilang,2,Administrar Idiomas##</h1>
<div id="div_languages">
|-if $message eq "ok"-|
	<div class='successMessage'>##multilang,4,Idioma guardado correctamente##</div>
|-elseif $message eq "deleted_ok"-|
	<div class='successMessage'>##multilang,5,Idioma eliminado correctamente##</div>
|-/if-|
<p>##multilang,3,Esta sección le permitirá administrar los idiomas disponibles en el sistema. Puede agregar un nuevo idioma, editar uno existente o eliminar un idioma determinado.##</p>
  <table border="0" cellpadding="5" cellspacing="0" id="tabla-languages" class="tableTdBorders">
    <thead>
			<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=multilangLanguagesEdit" class="addLink">##multilang,6,Agregar Idioma##</a></div></th>
			</tr>
      <tr class="thFillTitle">
        <th>##multilang,7,Id##</th>
        <th>##multilang,8,Nombre##</th>
        <th>##multilang,9,Código##</th>
        <th>Locale</th>
        <th width="5%">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    |-foreach from=$languages item=language name=for_languages-|
    <tr>
      <td>|-$language->getid()-|</td>
      <td>|-$language->getname()-|</td>
      <td>|-$language->getcode()-|</td>
      <td>|-$language->getLocale()-|</td>
      <td nowrap="nowrap"><form action="Main.php" method="get">
          <input type="hidden" name="do" value="multilangLanguagesEdit" />
          <input type="hidden" name="id" value="|-$language->getid()-|" />
          <input type="submit" name="submit_go_edit_language" value="##common,1,Editar##" title="##common,1,Editar##" class="icon iconEdit" />
        </form>
        <form action="Main.php" method="post">
          <input type="hidden" name="do" value="multilangLanguagesDoDelete" />
          <input type="hidden" name="id" value="|-$language->getid()-|" />
          <input type="submit" name="submit_go_delete_language" value="##common,2,Eliminar##" title="##common,2,Eliminar##" onclick="return confirm('##multilang,10,¿Está seguro que desea eliminar el idioma?##')" class="icon iconDelete" />
      </form></td>
    </tr>
    |-/foreach-|
    </tbody>
			<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=multilangLanguagesEdit" class="addLink">##multilang,6,Agregar Idioma##</a></div></th>
			</tr>
  </table>
</div>
