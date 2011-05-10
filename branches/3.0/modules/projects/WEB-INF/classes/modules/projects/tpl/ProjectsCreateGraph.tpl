<h2>Gráfico de Desembolsos</h2>
<h1>|-$project->getName()-|</h1>
<p>El gráfico de desembolso no está disponible aún, no se ha creado.</p>
<p>Para crear la matriz de datos que generará el gráfico, por favor introduzca las fechas de inicio y finalización.</p>

<form action="Main.php" method="post" style="display:inline;">
<fieldset title="Datos de inicio y finalización del proyecto">
<legend>Rango de fechas de desembolsos</legend>
	<p>
		<label>Fecha de Inicio</label></p>
		<p>
		<label>Año</label> <input name="startDate[year]" type="text" title="Año de inicio (4 dígitos)" size="6" maxlength="4"/> 
		<strong>Mes</strong>
		<select name="startDate[month]" title="Mes de inicio">
			<option value="">Seleccione el mes</option>
			<option value="1">Enero</option>
			<option value="2">Febrero</option>
			<option value="3">Marzo</option>
			<option value="4">Abril</option>
			<option value="5">Mayo</option>
			<option value="6">Junio</option>
			<option value="7">Julio</option>
			<option value="8">Agosto</option>
			<option value="9">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>
	</p>
	<p>
		<label>Fecha de finalización</label></p>
		<p>
		<label>Año</label> <input name="endDate[year]" type="text" title="Año de finalización (4 dígitos)" size="6" maxlength="4" /> 
		<strong>Mes</strong>
		<select name="endDate[month]" title="Mes de finalización">
			<option value="">Seleccione el mes</option>
			<option value="1">Enero</option>
			<option value="2">Febrero</option>
			<option value="3">Marzo</option>
			<option value="4">Abril</option>
			<option value="5">Mayo</option>
			<option value="6">Junio</option>
			<option value="7">Julio</option>
			<option value="8">Agosto</option>
			<option value="9">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>
	</p>

	<input type="hidden" name="do" value="projectsDoCreateGraph" />
	<input type="hidden" name="id" value="|-$project->getId()-|" />
	<input type="submit" name="submit_go_create_project_graph" value="Crear matriz de datos" title="Crear matriz de datos" />
</fieldset></form>
