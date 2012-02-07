 <h2>Caracterización de Actores</h2>
<h1>Edición de Perfiles</h1>
<p>Ingrese la información de caracterización del Actor <strong>&quot;|-$actor->getName()-|&quot;</strong>.</p>
|-if $smarty.request.status eq 'ok'-|
<div class="successMessage">Cambios guardados</div>
|-/if-|
<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%"> 
  <tr> 
    <th colspan="2">Caracterización de |-$actor-| - |-$form-|</th> 
  </tr> 
  <tr> 
    <td width="10%" nowrap>Formulario:</td>
    <td>|-assign var=formId value=$form->getId()-|
      <div style="display: inline;">|-$form-|</div> 
      |-if $forms|@count gt 1-|
      <div id='formselect' class='noPrint' style="display: inline;">&nbsp;&nbsp;|-include file="ProfilesFormSelectInclude.tpl"-|</div> 
      |-/if-| </td> 
  </tr> 
</table>
<form method="POST"	name="formQuestions" action="Main.php?do=profilesDoEdit"> 
  <input type="hidden" name="actor" value="|-$actor->getId()-|" /> 
  <input type="hidden" name="form" value="|-$form->getId()-|" /> 
  |-if $smarty.request.showAll-|
  <input type="hidden" name="showAll" value="1" /> 
  |-/if-|
  <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
    <tr> 
      <td> |-if $form->getRootSection()-| |-include file="ProfilesEditSectionInclude.tpl" section=$form->getRootSection()-| |-/if-| </td> 
    </tr> 
  </table> 
  <table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
     |-if $smarty.request.showAll-|
    <tr> 
      <td class="celldato">&nbsp;</td> 
    </tr> 
    <tr> 
      <td class="celldato"> 
        <label for="selectAll">Seleccionar todas las preguntas</label> 
        <input type="checkbox" name="selectAll" onclick="javascript:selectAllQuestions(this.checked)" /> 
      </td> 
    </tr> 
    <tr> 
      <td class="celldato">&nbsp;</td> 
    </tr> 
    |-/if-|
    <tr> 
      <td class="cellboton"> 
        <input name="guardar" value="##203,Guardar datos de la sección##" type="submit"> 
      </td> 
    </tr> 
    <tr> 
      <td class="tablebottom"><img src="images/clear.gif" height="1" width="1"></td> 
    </tr> 
  </table> 
</form>
|-if not $smarty.request.showAll-| <a href="|-$smarty.server.REQUEST_URI-|&showAll=1">##213,Ver todas las preguntas##</a> |-/if-| 