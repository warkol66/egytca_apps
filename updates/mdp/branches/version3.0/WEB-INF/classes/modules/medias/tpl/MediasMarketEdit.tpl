<h2>Medios</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Mercado</h1>
<div id="div_type">
	<p>Ingrese los datos del Mercado</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el mercado</span>|-/if-|
	<form name="form_edit_type" id="form_edit_type" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un mercado">
			<legend>Formulario de Administración de Mercados</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="20" value="|-$mediaMarket->getName()|escape-|" title="Nombre" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$mediaMarket->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="mediasMarketDoEdit" />
				<input type="submit" id="button_edit_type" name="button_edit_type" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=mediasMarketList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
