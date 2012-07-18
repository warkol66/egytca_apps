     |-if $planningConstruction->isNew()-|
     <table class="tableTdBorders" id="activitiesTable">
      <thead> 
         <tr> 
          <th>Nombre</th> 
          <th>Fecha</th> 
          <th>Cumplida</th> 
        </tr> 
       </thead>
      <tbody id="activitiesTbody"> 
        <tr>
            <th colspan="4">Elaboración del proyecto</th>
        </tr>       
        <tr>
            <th colspan="4">Por Concurso</th>
        </tr>       
            <tr id="activityId_1"> 
                <td><input type="hidden" name="activity[][id]" value="1"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Llamado a Concurso" size="60" title="Actividad" ></td> 
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
            </tr> 

            <tr id="activityId_2"> 
                <td><input type="hidden" name="activity[][id]" value="2"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Cierre de Concurso" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
            </tr> 

            <tr id="activityId_3"> 
                <td><input type="hidden" name="activity[][id]" value="3"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Fallo Jurado" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
            </tr>       
            <tr>
                <th colspan="4">Diseño Propio</th>
            </tr> 

            <tr id="activityId_4"> 
                <td><input type="hidden" name="activity[][id]" value="4"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Diseño del Proyecto" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
            </tr>       
            <tr style="display:none;">
                <th colspan="4">Evaluación del impacto Ambiental</th>
            </tr> 

            <tr id="activityId_5" style="display:none;">
                <td><input type="hidden" name="activity[][id]" value="5"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Presentación EIA en APRA" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_6">
                <td><input type="hidden" name="activity[][id]" value="6"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Audiencia Pública" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_7"> 
                <td><input type="hidden" name="activity[][id]" value="7"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Emisión de Certificado" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr>       
            <tr>
                <th colspan="4">Licitación</th>
            </tr> 

            <tr id="activityId_8">
                <td><input type="hidden" name="activity[][id]" value="8"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Aprobación de Pliegos" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_9">
                <td><input type="hidden" name="activity[][id]" value="9"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Llamado" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_10">
                <td><input type="hidden" name="activity[][id]" value="10"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Apertura de Sobres" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_11">
                <td><input type="hidden" name="activity[][id]" value="11"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Pre-Adjudicación" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
          </tr> 

            <tr id="activityId_12">
                <td><input type="hidden" name="activity[][id]" value="12"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Adjudicación" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_13">
                <td><input type="hidden" name="activity[][id]" value="13"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Firma Contrata" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 
      </tbody> 

     </table>

     <table class="tableTdBorders" id="activitiesTable">
      <thead>
         <tr> 
          <th>Nombre</th> 
          <th>Fecha</th> 
          <th>Cumplida</th> 
        </tr> 
       </thead>
      <tbody id="activitiesTbody"> 
            <tr>
                <th colspan="4">Diseño del Proyecto</th>
            </tr>     

            <tr id="activityId_4"> 
                <td><input type="hidden" name="activity[][id]" value="4"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Diseño del Proyecto" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr>  
            <tr>
                <th colspan="4">Licitación</th>
            </tr> 

            <tr id="activityId_8">
                <td><input type="hidden" name="activity[][id]" value="8"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Aprobación de Pliegos" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_9">
                <td><input type="hidden" name="activity[][id]" value="9"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Llamado" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
          </tr> 

            <tr id="activityId_10">
                <td><input type="hidden" name="activity[][id]" value="10"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Apertura de Sobres" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
          </tr> 

            <tr id="activityId_11">
                <td><input type="hidden" name="activity[][id]" value="11"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Pre-Adjudicación" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
          </tr> 

            <tr id="activityId_12">
                <td><input type="hidden" name="activity[][id]" value="12"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Adjudicación" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 

            <tr id="activityId_13">
                <td><input type="hidden" name="activity[][id]" value="13"/>
                <input name="activity[][name]" id="params_name[]" type="text" value="Firma Contrata" size="60" title="Actividad" ></td>
                <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización (dd-mm-yyyy)" ></td>
                <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1"  title="Indique si se completó la actividad" ></td>
           </tr> 
      </tbody> 
     </table> 
