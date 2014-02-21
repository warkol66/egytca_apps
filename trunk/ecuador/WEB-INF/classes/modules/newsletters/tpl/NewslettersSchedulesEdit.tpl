<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
		}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	});//fin docready
</script>
<h2>Newsletter</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Envios Programados</h1>
<div id="div_newsletterschedule">
	<p>
	A continuación puede generar un envío programado. Ingrese la información y haga click en Aceptar para guardar los cambios.
	</p>
	<form name="form_edit_newsletterschedule" id="form_edit_newsletterschedule" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el newsletter schedule</div>
		|-/if-|
		<fieldset title="Formulario de edición de datos de un newsletter schedule">
		<legend>Envío Programado</legend>
			<p>
				Ingrese los datos del envío programado.
			</p>
			<p>
				<label for="newsletterschedule_newsletterTemplateId">Plantilla</label>
				<select id="newsletterschedule_newsletterTemplateId" name="newsletterschedule[newsletterTemplateId]" title="newsletterTemplateId">
				<option value="">Seleccione una Plantilla de Newsletter</option>
					|-foreach from=$newsletterTemplateIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newsletterschedule->getnewsletterTemplateId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
					|-/foreach-|
				</select>
			</p>
				|-if $newsletterschedule->getId() eq ''-|
					|-include file="NewslettersSchedulesStatusCreateEditInclude.tpl" -|
				|-/if-|

				|-if $newsletterschedule neq '' and $newsletterschedule->isEveryDaySchedule()-|
					<p>
						<label>Tipo de Envío</label> Envío diario
						<input type="hidden" name="newsletterschedule[deliveryMode]" value="ED"/>
					</p>										
				|-/if-|
				|-if $newsletterschedule neq '' and $newsletterschedule->isOnceAWeekSchedule()-|
					<p>
						<label>Tipo de Envío</label> Envío Semanal
					</p>
					<p>
						<input type="hidden" name="newsletterschedule[deliveryMode]" value="OW"/>
						<label>Envío el Día</label>
						<select name="newsletterschedule[deliveryDay]">
							<option value="Mon" |-if $newsletterschedule->getDeliveryDay() eq "Mon"-|selected="selected"|-/if-|>Lunes</option>
							<option value="Tue" |-if $newsletterschedule->getDeliveryDay() eq "Tue"-|selected="selected"|-/if-|>Martes</option>
							<option value="Wed" |-if $newsletterschedule->getDeliveryDay() eq "Wed"-|selected="selected"|-/if-|>Miercoles</option>
							<option value="Thu" |-if $newsletterschedule->getDeliveryDay() eq "Thu"-|selected="selected"|-/if-|>Jueves</option>
							<option value="Fri" |-if $newsletterschedule->getDeliveryDay() eq "Fri"-|selected="selected"|-/if-|>Viernes</option>
							<option value="Sat" |-if $newsletterschedule->getDeliveryDay() eq "Sat"-|selected="selected"|-/if-|>Sabado</option>
							<option value="Sun" |-if $newsletterschedule->getDeliveryDay() eq "Sun"-|selected="selected"|-/if-|>Domingo</option>
						</select>
					</p>					
				|-/if-|
				|-if $newsletterschedule neq '' and $newsletterschedule->isOnceAMonthSchedule()-|
					<p>
						<label>Tipo de Envio</label> Envio Mensual
					</p>						
					<p>
						<label>Envío el día</label>
						<input type="hidden" name="newsletterschedule[deliveryMode]" value="OM"/>
						<input type="input" name="newsletterschedule[deliveryDayNumber]" value="|-$newsletterschedule->getDeliveryDayNumber()-|"/>
					</p>
				|-/if-|
				|-if $newsletterschedule neq '' and $newsletterschedule->isOnceSchedule()-|
					<p>
						<label>Tipo de Envío</label> Envío por única vez
					</p>
					<p>
						<label>Envío el día</label>
						<input type="hidden" name="newsletterschedule[deliveryMode]" value="O"/>
						<input type="input" name="newsletterschedule[deliveryDate]" class="datepicker" value="|-$newsletterschedule->getDeliveryDate()-|" />						
						<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha"></img>
					</p>
				|-/if-|
				<!--no usamos grupos solo se envia a users-->
				<!--p>
					<label for="newsletterschedule_clusterId">Grupo</label>
					<select name="newsletterschedule[clusterId]">
						<option value="0">Seleccione un Grupo</option>
					|-foreach from=$clusters item=cluster-|
						<option value="|-$cluster->getId()-|" |-if $newsletterschedule->getClusterId() eq $cluster->getId()-|selected="selected"|-/if-|>|-$cluster->getName()-|</option>
					|-/foreach-|
					</select>
				</p-->
				<p>
				<label for="newsletterschedule_active">Estado</label>
					<select id="newsletterschedule_active" name="newsletterschedule[active]">
						<option value="1" |-if isset($newsletterschedule) and $newsletterschedule->getactive() eq 1-|selected="selected"|-/if-|>Activo</option>
						<option value="0" |-if isset($newsletterschedule) and $newsletterschedule->getactive() eq 0-|selected="selected"|-/if-|>Inactivo</option>
					</select>
				</p>
				<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="newsletterschedule[id]" id="newsletterschedule_id" value="|-$newsletterschedule->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="newslettersSchedulesDoEdit" />
				<input type="submit" id="button_edit_newsletterschedule" name="button_edit_newsletterschedule" title="Aceptar" value="Aceptar"  />
				<input type="button" id="button_return_list" name="button_return_list" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=newslettersSchedulesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
			</p>
		</fieldset>
	</form>
</div>