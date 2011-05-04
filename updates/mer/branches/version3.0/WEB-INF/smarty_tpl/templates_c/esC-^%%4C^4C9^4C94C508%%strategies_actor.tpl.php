<?php /* Smarty version 2.6.26, created on 2011-05-04 14:28:53
         compiled from strategies_actor.tpl */ ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
  	<td class='titulo'>Estrategias y Tácticas</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Estrategías y Tácticas asociadas a &quot;<?php echo $this->_tpl_vars['actor']->getName(); ?>
&quot;
			<div class="reportlinkdiv"><a href="javascript:void(null);" class="deta" onClick="window.open('#','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></td>
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
				<table class='tablaborde' width='100%' border='0' cellpadding='3' cellspacing='1'>
					<tr>
						<td class='celltitulo'><div class='titulo2'>##242,Calificación de la Relación##</div></td>
						<td class='celldato'>
									<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == -3): ?>-3|&nbsp;Antagonista<?php endif; ?>
									<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == -2): ?>-2|&nbsp;Obstaculizador<?php endif; ?>
									<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == -1): ?>-1|&nbsp;Entorpecedor<?php endif; ?>
									<?php if (( $this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 0 ) || $this->_tpl_vars['judgement'] == ""): ?>0|&nbsp;Neutral<?php endif; ?>
									<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 1): ?>1|&nbsp;Cooperador<?php endif; ?>
									<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 2): ?>2|&nbsp;Amigo<?php endif; ?>
									<?php if ($this->_tpl_vars['judgement'] != "" && $this->_tpl_vars['judgement']->getMark() == 3): ?>3|&nbsp;Aliado<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td class='celltitulo'><div class='titulo2'>&nbsp;&nbsp;##243,Juicio Síntesis##</div></td>
						<td class='celldato'><?php if ($this->_tpl_vars['judgement'] != ""): ?><?php echo $this->_tpl_vars['judgement']->getJudgement(); ?>
<?php endif; ?></td>
					</tr>
				</table>
		</td>
	</tr>
	<tr>
		<td><br />
			<form action='Main.php' method='post' style='display: inline;'>
				<table class='tablaborde' width='100%' border='0' cellpadding='3' cellspacing='1'>
					<tr>
						<td class='celltitulo'><div class='titulo2'>Estrategia</div></td>
						<td class='celldato'><textarea name='strategy' cols='85' rows='4' class='textodato' wrap='virtual'><?php echo $this->_tpl_vars['actor']->getStrategy(); ?>
</textarea></td>
					</tr>
					<tr>
						<td class='celltitulo'><div class='titulo2'>T&aacute;ctica</div></td>
						<td class='celldato'><textarea name='tactic' cols='85' rows='4' class='textodato' wrap='virtual'><?php echo $this->_tpl_vars['actor']->getTactic(); ?>
</textarea></td>
					</tr>
					<tr>
						<td class='celltitulo'><div class='titulo2'>Observaciones</div></td>
						<td class='celldato'><textarea name='observations' cols='85' rows='4' class='textodato' wrap='virtual'><?php echo $this->_tpl_vars['actor']->getObservations(); ?>
</textarea></td>
					</tr>
					<tr>
						<td colspan='2' align='center' class='cellboton'>
							<input type="hidden" name="do" value="strategiesActorDoEdit" />
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