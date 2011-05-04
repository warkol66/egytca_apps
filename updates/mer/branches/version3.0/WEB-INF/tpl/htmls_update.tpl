			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="585" align="left" valign="top">
            <!-- Llamado sin parametros -->
            |-if $SUBIDO ne 1-| 
            <form method="post" enctype="multipart/form-data" action="Main.php?do=htmlsDoUpdate">
              <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr> 
                  <th colspan="2" class="thresultado"><span class="style3">Mantenimiento de HTML</span></th>
                </tr>
                <tr>
                	<td>Nombre del HTML (utilice un nombre corto y descriptivo)</td>
                	<td>
                		<input type="text" name="name" maxlength="30" />
                	</td>
                </tr>
                <tr>
                	<td>Es external? <input type="checkbox" name="external" value="1" /></td>
                	<td>Recuerde que el external y el template de contenido deben tener el mismo nombre.</td>
                </tr>
                <tr>
                	<td>Es privado? <input type="checkbox" name="private" value="1" /></td>
                	<td>Solo los usuarios que hayan iniciado sesion podran acceder.</td>
                </tr>
                <tr>
                  <td colspan="2" class="size2">A continuaci&oacute;n, ingrese
                    su archivo.</td>
                </tr>
                <tr>
                  <td width="25" nowrap class="style6">Archivo:&nbsp;</td>
                  <td class="size4"><input name="document" type="file" size="45"  class="TXTnormal"></td>
                </tr>
                <tr>
                  <td colspan=2 class="size4"><div class="resultado">NOTA:<br>
                      1-Recuerde que lo mejor es utilizar DreamWeaver para generar el HTML. <br>
                      <a href="mailto:WEBMASTER@CARROFERTA.COM"><br>
                      ¿Problemas?</a></div></td>
                </tr>
                <tr align="center">
                  <td colspan=2> <input name=subir type=submit class="boton" value="Subir">
                  </td>
                </tr>
              </table>
            </form>
            |-else-|
              <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <th class="thresultado"><span class="style3">Fin de Procesamiento</span></th>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td class="size4"><div class="resultado">|-if $ERROR eq 0-| EL archivo ingresado
                    por UD. ha sido procesado con exito. El link para acceder al HTML subido es <a href="|-$link-|">|-$link-|</a> |-else-| Ha ocurrido
                    un error proecesando el arhivo. |-/if-|</div></td>
                </tr>
              </table>
            |-/if-|
					</td>
        </tr>
      </table>
