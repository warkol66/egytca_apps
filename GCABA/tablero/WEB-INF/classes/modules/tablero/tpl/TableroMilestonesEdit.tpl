|-if isset($show)-|
<h3>
	<a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a> > 
		<form id="objectiveForm" action="Main.php" method="get"><input type="hidden" name="do" value="tableroProjectsShow" / >																
			<input type="hidden" name="objectiveId" value="|-$objective->getid()-|" />
			<a href="#" onClick="$('objectiveForm').submit()">|-$objective->getName()-|</a>
		</form> > 
	|-$project->getName()-|
 </h3>
|-/if-|
<div id="div_milestone">
	<form name="form_edit_milestone" id="form_edit_milestone" action="Main.php" method="post">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el milestone</span>|-/if-|
		<h3>|-if $action eq 'edit'-|Edit|-else-|Create|-/if-| Milestone</h3>
		<p>
		<a href="#" onClick="javascript:history.go(-1)">Volver atras</a>
		</p>												
		<p>
			Ingrese los datos del milestone.
		</p>
		<fieldset title="Formulario de edición de datos de un milestone">
			<p>
			|-if $loginUser neq "" and $loginUser->isAdmin()-|																								
			<label for="projectId">Projecto</label>
			<select id="projectId" name="projectId" title="projectId" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|>
				|-foreach from=$projectId_valores item=item_valor name=for_valores-|
				<option value="|-$item_valor->getId()-|" |-if $milestone->getprojectId() eq $item_valor->getId()-|selected="selected" |-/if-|>|-$item_valor->getName()|truncate:75:"...":false-|</option>
				|-/foreach-|
			</select>
			|-/if-|
			|-if $loginAffiliateUser neq ""-|
					<input type="hidden" name="projectId" value="|-$milestone->getprojectId()-|"/>|-assign var=project value=$milestone->getProject()-|
			|-/if-|
			</p>
			<p>
				<label for="name">name</label>
				<input type="text" id="name" name="name" value="|-if $action eq 'edit'-||-$milestone->getname()-||-/if-|" title="name" />
			</p>
			<p>
				<label for="expirationDate">expirationDate</label>
				<input type="text" id="expirationDate" name="expirationDate" value="|-if $action eq 'edit'-||-$milestone->getexpirationDate()-||-/if-|" title="expirationDate" />
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('expirationDate', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="completed">Completada</label>
			</p>
			<p>
				<label>No</label>
				<input type="radio" name="completed" value="0" |-if ($action neq 'edit')-|checked="checked"|-elseif ($milestone->getcompleted() eq 0)-|checked="checked"|-/if-|/>
			</p>
			<p>
				<label>Si</label>
				<input type="radio" name="completed" value="1" |-if $action eq 'edit' and ($milestone->getcompleted() eq 1)-|checked="checked"|-/if-|/>
			</p>
			</p>
			<p>
				<label for="notes">notes</label><br />
				<textarea name="notes" rows="8" cols="40">|-if $action eq 'edit'-||-$milestone->getnotes()-||-/if-|</textarea>
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$milestone->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="tableroMilestonesDoEdit" />
				|-if isset($show)-|								
					<input type="hidden" name="show" value="1" />
				|-/if-|								
				<input type="submit" id="button_edit_milestone" name="button_edit_milestone" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>
