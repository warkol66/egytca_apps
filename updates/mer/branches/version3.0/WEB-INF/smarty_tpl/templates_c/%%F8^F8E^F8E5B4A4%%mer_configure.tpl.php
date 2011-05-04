<?php /* Smarty version 2.6.26, created on 2011-05-04 12:18:17
         compiled from mer_configure.tpl */ ?>
<table width='100%' border='0' cellspacing="0" cellpadding='0'>
	<tr>
		<td>&nbsp;</td>
		<td><span class="tit1">##40,Configuración del Sistema##</span></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
		<td></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><p>##41,Para utilizar el sistema debe completar los siguientes pasos. Una vez  completados podrá pasar a la carga de datos de los perfiles cada uno de  los Actores.##</p></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>##42,Configurar: ACTORES##</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width="100%" border='0' cellpadding='0' cellspacing="0">
				<tr>
					<td width="20"><a href="Main.php?do=actorsAddActors"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=actorsAddActors" class='seccion'>##43,Ingresar Actores##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##44,En esta sección podrá hacer una lista lo más completa posible con los  Actores con los cuales su Institución tiene algún tipo de relación.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=actorsAssignCategoryToActors"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=actorsAssignCategoryToActors" class='seccion'>##45,Categorizar##</a></td>
				</tr>
				<tr>
					<td width="20" align='center'>&nbsp;</td>
					<td class="texto">##46,En esta sección podrá asignar una categoría a cada uno de los actores ingresado en la sección anterior.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=actorsAddActorInCategory"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=actorsAddActorInCategory" class='seccion'>##47,Completar##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##48,Aquí podrá ingresar al listado ordenado y filtrado por categorías, que podrá completar con más Actores.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=actorsSetActorsHierarchy"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=actorsSetActorsHierarchy" class='seccion'>##49,Jerarquizar##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##50, En esta sección podrá jerarquizar los Actores de cada categoría para seleccionar los  más relevantes.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>##51,Configurar: CATEGORIAS DE ACTORES ## </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=categoriesList"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=categoriesList" class='seccion'>##52,Editar categorías##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##53,En esta sección podrá editar la lista de categorías de actores disponible para el sistema.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php if ($this->_tpl_vars['login_user']->isAdmin() == 1 || $this->_tpl_vars['login_user']->isSupervisor() == 1): ?>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>##54,Configurar: USUARIOS##</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=usersList"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=usersList" class='seccion'>##55,Administrar Usuarios##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##56,En esta sección podrá editar la lista de usuarios autorizados a ingresar en el sistema.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php if ($this->_tpl_vars['login_user']->isSupervisor() == 1): ?>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>##57,Configurar: CUESTIONARIOS##</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=profilesFormEdit"><img src="images/cubo_tit.gif" width="14" height="18" border='0'></a></td>
					<td><a href="Main.php?do=profilesFormEdit" class='seccion'>##58,Administrar Formularios de Perfil##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##59,Configurar formularios de perfil de Actores.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=profilesFormEdit"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
					<td><a href="Main.php?do=profilesFormRelEdit" class='seccion'>##60,Administrar Formularios de Relaciones## </a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##61,Configurar formularios de relaciones e intercambio entre Actores.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>##62,Configurar: GRAFICOS##</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=analysisGraphList"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
					<td><a href="Main.php?do=analysisGraphList" class='seccion'>##63,Configurar Gráficos de Perfil##</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##64,Con esta herramienta puede definir los gráficos que utilizará el sistema para el análisis.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td width="20"><a href="Main.php?do=analysisGraphList"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
					<td><a href="Main.php?do=analysisGraphList" class='seccion'>##65,Configurar Gráficos de Relaciones## </a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="texto">##66,Con esta herramienta puede administrar los gráficos que el sistema maneja para las relaciones.##</td>
				</tr>
			</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
  	<td>&nbsp;</td>
  	<td class='titulo2'>Permisos y Niveles de Usuarios </td>
  	<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
    	<tr>
    		<td width="20"><a href="Main.php?do=levelsList"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
    		<td><a href="Main.php?do=levelsList" class='seccion'>Administrar niveles de usuarios</a></td>
    		</tr>
    	<tr>
    		<td width="20">&nbsp;</td>
    		<td class="texto">Administra niveles de usuarios </td>
    		</tr>
    	</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
    	<tr>
    		<td width="20"><a href="Main.php?do=securityList"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
    		<td><a href="Main.php?do=securityList" class='seccion'>Administrar permisos</a></td>
    		</tr>
    	<tr>
    		<td width="20">&nbsp;</td>
    		<td class="texto">Administrar permisoso</td>
    		</tr>
    	</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>Configuración General </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
    	<tr>
    		<td width="20"><a href="Main.php?do=configView"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
    		<td><a href="Main.php?do=configView" class='seccion'>Configurar el sistema</a></td>
    		</tr>
    	<tr>
    		<td width="20">&nbsp;</td>
    		<td class="texto">Configurar el sistema</td>
    		</tr>
    	</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'>Configuración General </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
    	<tr>
    		<td width="20"><a href="Main.php?do=analysisQuestionList"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
    		<td><a href="Main.php?do=analysisQuestionList" class='seccion'>Preguntas de Cuestionarios de Perfil a Análisis</a></td>
    		</tr>
    	<tr>
    		<td width="20">&nbsp;</td>
    		<td class="texto">Preguntas de Cuestionarios de Perfil a Análisis</td>
    		</tr>
    	</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width='100%' border='0' cellspacing="0" cellpadding='0'>
    	<tr>
    		<td width="20"><a href="Main.php?do=analysisQuestionLabelList"><img src="images/cubo_tit.gif" width="14" height="18" border='0' /></a></td>
    		<td><a href="Main.php?do=analysisQuestionLabelList" class='seccion'>Lista de preguntas de perfil disponibles para ser consultadas con popup</a></td>
    		</tr>
    	<tr>
    		<td width="20">&nbsp;</td>
    		<td class="texto">Lista de preguntas de perfil disponibles para ser consultadas con popup</td>
    		</tr>
    	</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php endif; ?>
	<?php endif; ?>
</table>