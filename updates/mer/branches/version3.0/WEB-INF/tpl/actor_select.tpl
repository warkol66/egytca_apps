 <h2>Caracterización de Actores</h2>
<h1>Edición de Perfiles</h1>
<p>En este módulo podrá definir el perfil de los Actores Clave completando un cuestionario de caracterización para cada uno. Seleccione una categoría y se msotrarán los actores correspondientes a la misma, luego seleccione un actor para realizar la caracterización del mismo.</p>
<table class="tableTdBorders" border="0" cellpadding="3" cellspacing="1" width="100%"> 
  <tbody> 
    <tr> 
      <th colspan="2">Actores Principales de "|-$category->getName()-|"</th> 
    </tr> 
   |-foreach from=$category->getActors() item=actor-|
  <tr> 
    <td> 
      <div class="titulo2"> <a href="Main.php?do=|-$smarty.get.successAction-|&actor=|-$actor->getId()-|">|-$actor->getName()-|</a></div> 
    </td> 
  </tr> 
  |-/foreach-|
  <tr> 
    <td class="cellboton" colspan="2"> 
      <input onclick="history.go(-1)" value="Regresar" type="button"> 
    </td> 
  </tr> 
  </tbody> 
</table>
