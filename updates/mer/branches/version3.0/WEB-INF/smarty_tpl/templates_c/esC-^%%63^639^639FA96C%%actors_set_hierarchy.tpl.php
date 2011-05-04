<?php /* Smarty version 2.6.26, created on 2011-05-04 14:32:42
         compiled from actors_set_hierarchy.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'actors_set_hierarchy.tpl', 161, false),)), $this); ?>
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
		<td class='fondotitulo'>##128,Jerarquización de Actores por Categoría##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##129,Seleccione cada una de las categorías de Actores y defina con la ayuda del sistema los más importantes mediante la metodología de jerarquización propuesta. Una vez completado el cálculo debe guardar el resultado para utilizar los Actores resultantes en los gráficos y análisis.##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<form name='cats'>
	<table class='tablaborde' cellspacing='1' cellpadding='3' border='0' width='100%'>
		<tr>
			<td class='titulodato1' width='35%' nowrap>##130,Seleccione una categoría a jerarquizar##</td>
			<td class='celldato'><select name="cat" onChange="document.cats.submit();">
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
				<input type="hidden" name="do" value="actorsSetActorsHierarchy" />
				&nbsp;<a href="javascript:void(null)" onClick="alert('##137,Recorra las filas de la siguiente tabla y seleccionando sobre las filas qué Actor es más importante que el expresado en la columna. Al finalizar, pulse el botón &quot;Calcular jerarquía&quot; y en la columna total aparecerá el órden de importancia.##')">##38,Ayuda##</a></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##120,Continuar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##'  class='boton' /></td>
		</tr>
	</table>
</form>
<?php if (( $this->_tpl_vars['currentCategory'] != "" )): ?>
	<?php if (( $this->_tpl_vars['manual'] == '1' )): ?> 
	<form name='j' method='post' action="Main.php">
	<input type='hidden' name='category' value='<?php echo $this->_tpl_vars['currentCategory']->getId(); ?>
' />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class='tablaborde'>
		<tr>
			<td class='titulodato1' colspan='2'>##131,Jerarquización Manual##</td>
		</tr>
		<tr>
			<td colspan='1' class='titulodato'>&nbsp;</td>
			<td class='titulodato' align='center'>##138,Orden##</td>
		</tr>
			<?php $_from = $this->_tpl_vars['actors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_actors']['iteration']++;
?>
		<tr>
			<td class='tcol1b' width='30%' nowrap><?php echo $this->_tpl_vars['actor']->getName(); ?>
</td>
			<td class='titulodato' align='center'><input class='textodato' type='text' name='r[<?php echo $this->_foreach['for_actors']['iteration']; ?>
]' size='3' value="0" />
				<input type='hidden' name='rel[<?php echo $this->_foreach['for_actors']['iteration']; ?>
]' value='<?php echo $this->_tpl_vars['actor']->getId(); ?>
' />
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="do" value="actorsDoSetManualActorsHierarchy" />
				<input type='submit' name='guardar' value='##132,Guardar Resultado##' class='boton' />&nbsp;&nbsp;
				<input type='button' onClick='limpiar(<?php echo $this->_tpl_vars['actorsCountPlus1']; ?>
)' name='Button' value='##98,Borrar todo##' class='boton' />
			</td>
		</tr>
	</table>
	<script>
	 	function limpiar(an)
		{
			var k=new String();
			for (var i=1; i<an; i++)
			{
				var total=0;
				document.forms[1].elements["r\["+i+"\]"].value=total;
//			return 1;
			}
		}
	</script>
</form>
			<a href="Main.php?do=actorsSetActorsHierarchy&amp;cat=<?php echo $this->_tpl_vars['currentCategory']->getId(); ?>
">##133,Jerarquización Asistida##</a> <?php else: ?>
			<form name='j' method='post' onSubmit='calcular(<?php echo $this->_tpl_vars['actorsCountPlus1']; ?>
)' action="Main.php">
	<input type='hidden' name='category' value='<?php echo $this->_tpl_vars['currentCategory']->getId(); ?>
' />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class='tablaborde'>
					<tr>
			<td class='titulodato1' colspan='<?php echo $this->_tpl_vars['actorsCountPlus3']; ?>
'>##134,Jerarquización x Categoría##</td>
		</tr>
					<tr>
			<td colspan='2' class='titulodato'>&nbsp;</td>
			<?php $_from = $this->_tpl_vars['actors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_actors']['iteration']++;
?>
			<td class='titulodato' align='center'><?php echo $this->_foreach['for_actors']['iteration']; ?>
</td>
			<?php endforeach; endif; unset($_from); ?>
			<td class='titulodato' align='center'>##135,Total##</td>
		</tr>
					<?php $_from = $this->_tpl_vars['actors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_actors']['iteration']++;
?>
					<tr>
			<td class='tcol1b' width='5%'><?php echo $this->_foreach['for_actors']['iteration']; ?>
</td>
			<td class='tcol1b' width='30%' nowrap><?php echo $this->_tpl_vars['actor']->getName(); ?>
</td>
			<?php $_from = $this->_tpl_vars['actors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actorsb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actorsb']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actorb']):
        $this->_foreach['for_actorsb']['iteration']++;
?>
			<?php if ($this->_foreach['for_actors']['iteration'] != $this->_foreach['for_actorsb']['iteration']): ?>
			<td class='tcol1cen'><input type='checkbox' name='c[<?php echo $this->_foreach['for_actors']['iteration']; ?>
][<?php echo $this->_foreach['for_actorsb']['iteration']; ?>
]' value='1' onClick='document.forms[1].elements["c[<?php echo $this->_foreach['for_actorsb']['iteration']; ?>
][<?php echo $this->_foreach['for_actors']['iteration']; ?>
]"].checked=0;' /></td>
			<?php else: ?>
			<td class='menu2back2'>&nbsp;</td>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<td class='titulodato' align='center'><input class='textodato' type='text' name='r[<?php echo $this->_foreach['for_actors']['iteration']; ?>
]' size='3' />
							<input type='hidden' name='rel[<?php echo $this->_foreach['for_actors']['iteration']; ?>
]' value='<?php echo $this->_tpl_vars['actor']->getId(); ?>
' />
						</td>
		</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
			<td class='cellboton' colspan='<?php echo $this->_tpl_vars['actorsCountPlus3']; ?>
'><input type='button' name='Button3' onClick='calcular(<?php echo $this->_tpl_vars['actorsCountPlus1']; ?>
)' value='##136,Calcular jerarquía##' class='boton' />
							&nbsp;&nbsp;
							<input type='button' onClick='limpiar(<?php echo $this->_tpl_vars['actorsCountPlus1']; ?>
)' name='Button' value='##98,Borrar todo##' class='boton' />
							&nbsp;&nbsp;
							<input type="hidden" name="do" value="actorsDoSetActorsHierarchy" />
							<input type='submit' name='guardar' value='##132,Guardar Resultado##' class='boton' />
						</td>
		</tr>
				</table>
	<script>
			  	function limpiar(an){
					var k=new String();
					for (var i=1; i<an; i++){
						var total=0;
						for (var b=1; b<an; b++){
							if (b != i){
								k="c\["+i+"\]\["+b+"\]";
								document.forms[1].elements[k].checked=0;
							}
						}
						document.forms[1].elements["r\["+i+"\]"].value=total;
//					return 1;
					}
				}
			  	function calcular(an){
					var k=new String();
					for (var i=1; i<an; i++){
						var total=0;
						for (var b=1; b<an; b++){
							if (b != i){
								k="c\["+i+"\]\["+b+"\]";
								if (document.forms[1].elements[k].checked){total++}
//								else{total++;}
//							alert(k+": "+document.forms[1].elements[k].checked+" total:"+total);
							}
						}
						document.forms[1].elements["r\["+i+"\]"].value=total;
//					return 1;
					}
				return 1;
				}

			  </script>
</form>
			<a href="Main.php?do=actorsSetActorsHierarchy&amp;cat=<?php echo $this->_tpl_vars['currentCategory']->getId(); ?>
&amp;manual=1">##131,Jerarquización Manual##</a> <?php endif; ?>
			<?php endif; ?>
			<?php if (((is_array($_tmp=$this->_tpl_vars['principalActors'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp)) != 0): ?> <br />
			<br />
			<h2>##121,Actores de la categoría## &quot;<?php echo $this->_tpl_vars['currentCategory']->getName(); ?>
&quot;</h2>
			<table class='tablaborde' border='0' width='70%' cellspacing='1' cellpadding='4'>
	<tr>
					<th colspan='2'>##101,Nombre del Actor##</th>
				</tr>
	<?php $_from = $this->_tpl_vars['principalActors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_principal'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_principal']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['principal']):
        $this->_foreach['for_principal']['iteration']++;
?>
	<tr>
					<td class='titulodato1' width='10%'><?php echo $this->_foreach['for_principal']['iteration']; ?>
</td>
					<td class='celldato'><span class='titulo2'><?php echo $this->_tpl_vars['principal']->getName(); ?>
</span></td>
				</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
			<?php endif; ?> <br />
			<br />
<?php if (( $this->_tpl_vars['manual'] != '1' )): ?>
<Script>
				calcular(<?php echo '<?='; ?>
count($acts)+1<?php echo '?>'; ?>
)
	  </script>
<?php endif; ?> 