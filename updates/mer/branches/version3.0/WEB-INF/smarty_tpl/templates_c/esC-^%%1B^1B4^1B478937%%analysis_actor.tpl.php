<?php /* Smarty version 2.6.26, created on 2011-05-04 14:28:14
         compiled from analysis_actor.tpl */ ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'><span class="titulo">##233,Análisis y Evaluación##</span></td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##237,Análisis de Relación con## &quot;<?php echo $this->_tpl_vars['actor']->getName(); ?>
&quot;<div align="right"><a href="javascript:void(null);" class="deta" onclick="window.open('Main.php?do=analysisActor&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
&report=1','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##251,A continuación encontrará los elementos necesarios para evaluar el perfil de la relación con el Actor:##&nbsp;<b><?php echo $this->_tpl_vars['actor']->getName(); ?>
</b>.<br />
			##252,En cada gráfico podrá emitir un juicio que luego podrá ver en el cuadro resumen al final de este formulario, para hacer la evaluación global del perfil.##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table width='100%' border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td> 
		<?php $_from = $this->_tpl_vars['graphs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_graphs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_graphs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['graph']):
        $this->_foreach['for_graphs']['iteration']++;
?>
			<form action='Main.php' method='post'>
				<a name='id-<?php echo $this->_tpl_vars['graph']->getId(); ?>
'></a><div id='hide<?php echo $this->_tpl_vars['graph']->getId(); ?>
' class='noPrint' align="right"><input type='button' id='button<?php echo $this->_tpl_vars['graph']->getId(); ?>
' value='Ocultar Sección' class='FormButton' onClick='switch_vis("<?php echo $this->_tpl_vars['graph']->getId(); ?>
");switch_value("button<?php echo $this->_tpl_vars['graph']->getId(); ?>
");' />Gráfico &quot;<?php echo $this->_tpl_vars['graph']->getName(); ?>
&quot;</div><div id='<?php echo $this->_tpl_vars['graph']->getId(); ?>
' style='display:block;'>  
				<table width='100%' class='tablaborde' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> <?php echo $this->_tpl_vars['graph']->getName(); ?>
</th>
					</tr>
					<tr>
						<td class='celldato' width='90%'><img src='Main.php?do=analysisGraphShow&graph=<?php echo $this->_tpl_vars['graph']->getId(); ?>
&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
&category=<?php echo $this->_tpl_vars['category']->getId(); ?>
' /> </td>
						<td class='cellbotonbtm' width='100'><table width='90' class='tablaborde' border='0' cellspacing='1' cellpadding='3'>
								<tr>
									<td nowrap class='cellasistjuicio'><a href='javascript:void(null);' onClick="window.open('Main.php?do=analysisGraphJudgementAssistant&graph=<?php echo $this->_tpl_vars['graph']->getId(); ?>
','asistente','toolbars=no,width=450,height=350,scrollbars=yes')"><b>##238,Asistente de Juicios##</b></a></td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan="2" valign='top' nowrap class='fondoffffff'><table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" class="titulodato1"><div class="titulo">&nbsp;&nbsp;##239,Juicio##:</div>
										<span class="textoerror"><?php if ($this->_tpl_vars['graph']->oldJudgement == 1): ?>Desactualizado<?php endif; ?></span>
									</td>
									<td class="filled1" width="1"><img src="images/clear.gif" width="1" height="1" /> </td>
									<td class="celldato"><textarea cols='100' name='judgement' rows='5' class='textodato' wrap='VIRTUAL'><?php echo $this->_tpl_vars['graph']->judgement; ?>
</textarea>
									</td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan='2' class='cellboton'><input type="hidden" name="do" value="analysisActorJudgementDoEdit" />
							<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor']->getId(); ?>
" />
							<input type="hidden" name="category" value="<?php echo $this->_tpl_vars['category']->getId(); ?>
" />
							<input type="hidden" name="graph" value="<?php echo $this->_tpl_vars['graph']->getId(); ?>
" />
							<input type='submit' name='gnota' value='##240,Guardar Juicio##' class='boton' />
							<input type='button' onClick='location.href="Main.php?do=analysisCategory&category=<?php echo $this->_tpl_vars['category']->getId(); ?>
"' value='##104,Regresar##'  class='boton' />
						</td>
					</tr>
				</table></div>
			</form>
			<?php endforeach; endif; unset($_from); ?> 

<!-- ingreso nuevo -->
				<table width='100%' class='tablaborde' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'>Cuadro Síntesis de Perfil de "<?php echo $this->_tpl_vars['actor']->getName(); ?>
"</th>
					</tr>
			<?php $_from = $this->_tpl_vars['analysisQuestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_analysis_questions'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_analysis_questions']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['question']):
        $this->_foreach['for_analysis_questions']['iteration']++;
?>
			<?php $this->assign('answer', $this->_tpl_vars['question']->getAnswer($this->_tpl_vars['actor'])); ?>
					<tr>
						<td valign="top" width='35%' class="titulodato1"><div class="titulo"><?php echo $this->_tpl_vars['question']->getQuestion(); ?>
</div></td>
					<td class='celldato' width='65%'><?php echo $this->_tpl_vars['answer']; ?>
</td>
					</tr>
				<?php endforeach; endif; unset($_from); ?>
				</table>
<!-- ingreso nuevo -->

<!-- anterior 

			<?php $_from = $this->_tpl_vars['analysisQuestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_analysis_questions'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_analysis_questions']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['question']):
        $this->_foreach['for_analysis_questions']['iteration']++;
?>
			<?php $this->assign('answer', $this->_tpl_vars['question']->getAnswer($this->_tpl_vars['actor'])); ?>
			<form action='Main.php' method='post'>
				<a name='id-894'></a>
				<table width='100%' class='tablaborde' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> <?php echo $this->_tpl_vars['question']->getQuestion(); ?>
 </th>
					</tr>
					<tr>
						<td class='celldato' width='90%'><?php echo $this->_tpl_vars['answer']; ?>
</td>
					</tr>
					<tr>
						<td colspan="2" valign='top' nowrap class='fondoffffff'><table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" class="titulodato1"><div class="titulo">&nbsp;&nbsp;##239,Juicio##:</div>
										<span class="textoerror"><?php if ($this->_tpl_vars['answer'] && $this->_tpl_vars['answer']->getOld() == 1): ?>Desactualizado<?php endif; ?></span>
									</td>
									<td class="filled1" width="1"><img src="images/clear.gif" width="1" height="1" /> </td>
									<td class="celldato"><textarea cols='100' name='judgement' rows='5' class='textodato' wrap='VIRTUAL'><?php if ($this->_tpl_vars['answer']): ?><?php echo $this->_tpl_vars['answer']->getJudgement(); ?>
<?php endif; ?></textarea>
									</td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan='2' class='cellboton'><input type="hidden" name="do" value="analysisActorJudgementDoEdit" />
							<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor']->getId(); ?>
" />
							<input type="hidden" name="category" value="<?php echo $this->_tpl_vars['category']->getId(); ?>
" />
							<input type="hidden" name="question" value="<?php echo $this->_tpl_vars['question']->getId(); ?>
" />
							<input type='submit' name='gnota' value='##240,Guardar Juicio##' class='boton' />
							<input type='button' onClick='location.href="Main.php?do=analysisCategory&category=<?php echo $this->_tpl_vars['category']->getId(); ?>
"' value='##104,Regresar##'  class='boton' />
						</td>
					</tr>
				</table>
			</form>
			<?php endforeach; endif; unset($_from); ?>
fin anterior -->
		</td>
	</tr>
</table>
<br />
<table width='100%' border='0' align='center' cellpadding="0" cellspacing="0">
	<tr>
		<td><table class='tablaborde' width='100%' border='0' cellpadding='0' cellspacing='1'>
				<tr>
					<th colspan='2'><a name='sintesis'>##241,Cuadro Síntesis de Evaluación de ## "
						<?php echo $this->_tpl_vars['actor']->getName(); ?>
"</a></th>
				</tr>
				<tr>
					<th>##250,Gráfico##</th>
					<th>##239,Juicio##:</th>
				</tr>
				<?php $_from = $this->_tpl_vars['graphs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_graph_judgements'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_graph_judgements']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['graph']):
        $this->_foreach['for_graph_judgements']['iteration']++;
?>
				<tr>
					<td class='celltitulo'><div class='titulo2'> <a href='#id-894'><?php echo $this->_tpl_vars['graph']->getName(); ?>
</a> </div></td>
					<td class='celldato'><?php echo $this->_tpl_vars['graph']->judgement; ?>
</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
<!-- inicio anterior				<?php $_from = $this->_tpl_vars['analysisQuestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_analysis_questions'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_analysis_questions']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['question']):
        $this->_foreach['for_analysis_questions']['iteration']++;
?>
				<?php $this->assign('answer', $this->_tpl_vars['question']->getAnswer($this->_tpl_vars['actor'])); ?>
				<tr>
					<td class='celltitulo'><div class='titulo2'> <a href='#id-894'><?php echo $this->_tpl_vars['question']->getQuestion(); ?>
</a> </div></td>
					<td class='celldato'><?php if ($this->_tpl_vars['answer']): ?><?php echo $this->_tpl_vars['answer']->getJudgement(); ?>
<?php endif; ?></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
fin anterior -->
			</table></td>
	</tr>
	<tr>
		<td><br />
			<form action='Main.php' method='post' style='display: inline;'>
				<table class='tablaborde' width='100%' border='0' cellpadding='3' cellspacing='1'>
					<tr>
						<th colspan='2'> ##242,Calificación de la Relación##
							<select name='mark' >
								<option value='-3'<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == -3): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;-3|&nbsp;Antagonista</option>
								<option value='-2'<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == -2): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;-2|&nbsp;Obstaculizador</option>
								<option value='-1'<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == -1): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;-1|&nbsp;Entorpecedor</option>
								<option value='0'<?php if (( $this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 0 ) || $this->_tpl_vars['judgement'] == ""): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;&nbsp;0|&nbsp;Neutral</option>
								<option value='1'<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 1): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;&nbsp;1|&nbsp;Cooperador</option>
								<option value='2'<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 2): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;&nbsp;2|&nbsp;Amigo</option>
								<option value='3'<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 3): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;&nbsp;3|&nbsp;Aliado</option>
							</select>
						</th>
					</tr>
					<tr>
						<td width="20%" nowrap class='celltitulo'><div class='titulo'>&nbsp;&nbsp;##243,Juicio Síntesis##</div></td>
						<td class='celldato'><textarea name='judgement' cols='85' rows='4' class='textodato' wrap='virtual'><?php if ($this->_tpl_vars['judgement'] != ""): ?><?php echo $this->_tpl_vars['judgement']->getJudgement(); ?>
<?php endif; ?></textarea></td>
					</tr>
					<tr>
						<td colspan='2' align='center' class='cellboton'><input type="hidden" name="do" value="analysisActorJudgementDoEdit" />
							<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor']->getId(); ?>
" />
							<input type="hidden" name="category" value="<?php echo $this->_tpl_vars['category']->getId(); ?>
" />
							<input type='submit' name='guardarc' value='##97,Guardar##'  class='boton' />
							&nbsp;&nbsp;
							<input type='button' onClick='history.go(-1)' value='##104,Regresar##'  class='boton' />
						</td>
					</tr>
				</table>
			</form></td>
	</tr>
	<tr>
		<td><br />
			<table width="100%" border="0" cellspacing="1" cellpadding="3" class='tablaborde'>
      	<tr>
      		<td class="celltitulo2" colspan="3">&nbsp;##244,Asistentes Virtuales##</td>
     		</tr>
      	<tr>
      		<td height="15" class="cellasistvirt" align="center"><a href='javascript:void(null)' onClick='javascript:window.open("Main.php?do=analysisGetQuestionByLabel&label=JuicioIntercambios&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
","perfil","toolbar=no,scrollbars=yes,width=425,height=320")' class="menu2">Juicio Intercambios</a></td>
      		<td height="15" class="cellasistvirt" align="center"><a href='javascript:void(null)' onClick='javascript:window.open("Main.php?do=analysisGetQuestionByLabel&label=JuicioPerfilCentroUrbano&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
","perfilpsico","toolbar=no,scrollbars=yes,width=425,height=320")' class="menu2">Juicio Perfil Centro Urbano</a></td>
      		<td height="15" class="cellasistvirt" align="center"><a href='javascript:void(null)' onClick='javascript:window.open("Main.php?do=analysisGetQuestionByLabel&label=JuicioConectividad&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
","actuacion","toolbar=no,scrollbars=yes,width=425,height=320")' class="menu2">Juicio Conectividad</a></td>
     		</tr>
      	</table></td>
	</tr>
</table>