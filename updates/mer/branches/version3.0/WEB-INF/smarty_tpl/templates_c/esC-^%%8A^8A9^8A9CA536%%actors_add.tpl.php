<?php /* Smarty version 2.6.26, created on 2011-05-04 14:30:04
         compiled from actors_add.tpl */ ?>
<script>
function moreFields(cantidad)
{
	for (var itr=0;itr<cantidad;itr++) 
	{
		var newFields = document.getElementById('tr_add_in_category').cloneNode(true);
		var newField = newFields.childNodes[1];
		newField.childNodes[1].value = '';
		var insertHere = document.getElementById('tr_botones');
		insertHere.parentNode.insertBefore(newFields,insertHere);
	}
}
</script>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##91,Ingreso de Actores## </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##92,En este formulario podrá ingresar los nombres de los actores con los que su organización mantiene algún tipo de relación. Puede optar por cargar los nombres solamente, en caso de tener a los actores categorizados, puede paras al formulario avanzado haciendo## <a href="#actoresycategorias">##93,click aquí##</a>.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<form name='form1' method='post' action='Main.php'>
	<table class='tablaborde' border='0' cellpadding='3' cellspacing='1' width='100%'>
		<tr>
			<th colspan='2'>##94,Nombre de los Actores## </th>
		</tr>
		<tr>
			<td colspan='2' class='celldato'><span class='texto'>##95,A continuación, ingrese los nombres de los Actores Clave de la Organización. Coloque un nombre en cada línea.##</span></td>
		</tr>
		<tr>
			<td class='celldato' valign='top' colspan='2'><textarea class='textodato' name='listadogrueso' cols='50' rows='15' wrap='VIRTUAL'></textarea>
			</td>
		</tr>
		<tr>
			<td class='celldato' colspan='2'> ##96,Al terminar de ingresar los nombres pulse Guardar para generar el listado inicial de Actores##</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoAddActors" />
				<input type='submit' name='guardarG' value='##97,Guardar##' class='boton' >
				&nbsp;&nbsp;
				<input type="reset" name='Borrar' value='##98,Borrar todo##' class='boton' >
			</td>
		</tr>
	</table>
</form>
<form method='post' action="Main.php">
	<table class='tablaborde' border='0' cellpadding='5' cellspacing='1' width="100%">
		<tr>
			<td class='celltitulo2' colspan='2'><a name='actoresycategorias'></a>##99,Formulario Avanzado##</td>
		</tr>
		<tr>
			<td colspan='2' class='celldato'><span class='texto'>##100,Utilice este formulario si tiene las categoras a asignar a cada uno de los Actores a ingresar. Ingrese un nombre en cada campo y asigne la categora correspondiente seleccionando de la lista, luego haga click en Guardar.##</span></td>
		</tr>
		<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
		</tr>
		<?php unset($this->_sections['sectionCountActors']);
$this->_sections['sectionCountActors']['name'] = 'sectionCountActors';
$this->_sections['sectionCountActors']['loop'] = is_array($_loop=$this->_tpl_vars['countActors']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sectionCountActors']['show'] = true;
$this->_sections['sectionCountActors']['max'] = $this->_sections['sectionCountActors']['loop'];
$this->_sections['sectionCountActors']['step'] = 1;
$this->_sections['sectionCountActors']['start'] = $this->_sections['sectionCountActors']['step'] > 0 ? 0 : $this->_sections['sectionCountActors']['loop']-1;
if ($this->_sections['sectionCountActors']['show']) {
    $this->_sections['sectionCountActors']['total'] = $this->_sections['sectionCountActors']['loop'];
    if ($this->_sections['sectionCountActors']['total'] == 0)
        $this->_sections['sectionCountActors']['show'] = false;
} else
    $this->_sections['sectionCountActors']['total'] = 0;
if ($this->_sections['sectionCountActors']['show']):

            for ($this->_sections['sectionCountActors']['index'] = $this->_sections['sectionCountActors']['start'], $this->_sections['sectionCountActors']['iteration'] = 1;
                 $this->_sections['sectionCountActors']['iteration'] <= $this->_sections['sectionCountActors']['total'];
                 $this->_sections['sectionCountActors']['index'] += $this->_sections['sectionCountActors']['step'], $this->_sections['sectionCountActors']['iteration']++):
$this->_sections['sectionCountActors']['rownum'] = $this->_sections['sectionCountActors']['iteration'];
$this->_sections['sectionCountActors']['index_prev'] = $this->_sections['sectionCountActors']['index'] - $this->_sections['sectionCountActors']['step'];
$this->_sections['sectionCountActors']['index_next'] = $this->_sections['sectionCountActors']['index'] + $this->_sections['sectionCountActors']['step'];
$this->_sections['sectionCountActors']['first']      = ($this->_sections['sectionCountActors']['iteration'] == 1);
$this->_sections['sectionCountActors']['last']       = ($this->_sections['sectionCountActors']['iteration'] == $this->_sections['sectionCountActors']['total']);
?>
		<tr>
			<td class='celldato'><input type='text' name='actors[]' value='' size='65' class='textodato'>
			</td>
			<td class='celldato'><select name="categories[]">
					<option value="0">##103,Seleccione una categoría##</option>
				<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['for_categories']['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['category']->getId(); ?>
"><?php echo $this->_tpl_vars['category']->getName(); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<?php endfor; endif; ?>
		<tr id="tr_add_in_category">
			<td class='celldato'><input type='text' name='actors[]' value='' size='65' class='textodato'>
			</td>
			<td class='celldato'><select name="categories[]">
					<option value="0">##103,Seleccione una categoría##</option>
				<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['for_categories']['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['category']->getId(); ?>
"><?php echo $this->_tpl_vars['category']->getName(); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr id="tr_botones">
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoAddActorsWithCategory" />
				<input type='submit' value='##97,Guardar##' name='guardar'  class='boton' />
				<input type='button' value='##104,Regresar##' onClick='javascript:history.go(-1)'  class='boton' />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'> ##105,Ingresar##
				<select id="select_count">
					<?php unset($this->_sections['addactors']);
$this->_sections['addactors']['name'] = 'addactors';
$this->_sections['addactors']['loop'] = is_array($_loop=29) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['addactors']['start'] = (int)1;
$this->_sections['addactors']['show'] = true;
$this->_sections['addactors']['max'] = $this->_sections['addactors']['loop'];
$this->_sections['addactors']['step'] = 1;
if ($this->_sections['addactors']['start'] < 0)
    $this->_sections['addactors']['start'] = max($this->_sections['addactors']['step'] > 0 ? 0 : -1, $this->_sections['addactors']['loop'] + $this->_sections['addactors']['start']);
else
    $this->_sections['addactors']['start'] = min($this->_sections['addactors']['start'], $this->_sections['addactors']['step'] > 0 ? $this->_sections['addactors']['loop'] : $this->_sections['addactors']['loop']-1);
if ($this->_sections['addactors']['show']) {
    $this->_sections['addactors']['total'] = min(ceil(($this->_sections['addactors']['step'] > 0 ? $this->_sections['addactors']['loop'] - $this->_sections['addactors']['start'] : $this->_sections['addactors']['start']+1)/abs($this->_sections['addactors']['step'])), $this->_sections['addactors']['max']);
    if ($this->_sections['addactors']['total'] == 0)
        $this->_sections['addactors']['show'] = false;
} else
    $this->_sections['addactors']['total'] = 0;
if ($this->_sections['addactors']['show']):

            for ($this->_sections['addactors']['index'] = $this->_sections['addactors']['start'], $this->_sections['addactors']['iteration'] = 1;
                 $this->_sections['addactors']['iteration'] <= $this->_sections['addactors']['total'];
                 $this->_sections['addactors']['index'] += $this->_sections['addactors']['step'], $this->_sections['addactors']['iteration']++):
$this->_sections['addactors']['rownum'] = $this->_sections['addactors']['iteration'];
$this->_sections['addactors']['index_prev'] = $this->_sections['addactors']['index'] - $this->_sections['addactors']['step'];
$this->_sections['addactors']['index_next'] = $this->_sections['addactors']['index'] + $this->_sections['addactors']['step'];
$this->_sections['addactors']['first']      = ($this->_sections['addactors']['iteration'] == 1);
$this->_sections['addactors']['last']       = ($this->_sections['addactors']['iteration'] == $this->_sections['addactors']['total']);
?>
					<option value="<?php echo $this->_sections['addactors']['index']; ?>
"> <?php echo $this->_sections['addactors']['index']; ?>
 </option>
					<?php endfor; endif; ?>
				</select>
				##106,actores más##&nbsp;&nbsp;
				<input type='button' value='##107,Agregar campos adicionales##' class='boton1' onClick="javascript:moreFields(document.getElementById('select_count').value)" />
			</td>
		</tr>
	</table>
</form>