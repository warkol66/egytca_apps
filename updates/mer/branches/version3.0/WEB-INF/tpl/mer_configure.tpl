<h2>Manejo Estratégico de Relaciones</h2>
<h1>Configuración del Sistema</h1>
<p>Para utilizar el sistema debe completar los siguientes pasos. Una vez completados podrá pasar a la carga de datos de los perfiles cada uno de  los Actores.</p>
<table width='100%' border='0' cellspacing="0" cellpadding='0'>
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'><h3>##42,Configurar: ACTORES##</h3></td>
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
		<td class='titulo2'><h3>##51,Configurar: CATEGORIAS DE ACTORES ##</h3> </td>
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
	|-if $login_user neq 1-|
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'><h3>##54,Configurar: USUARIOS##</h3></td>
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
	|-if $login_user neq 1-||-*if $login_user->isSupervisor() eq 1*-|
	<tr>
		<td>&nbsp;</td>
		<td class='titulo2'><h3>##57,Configurar: CUESTIONARIOS##</h3></td>
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
		<td class='titulo2'><h3>##62,Configurar: GRAFICOS##</h3></td>
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
  	<td class='titulo2'><h3>Permisos y Niveles de Usuarios</h3></td>
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
		<td class='titulo2'><h3>Configuración General</h3></td>
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
		<td class='titulo2'><h3>Configuración General</h3></td>
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
	|-/if-|
	|-/if-|
</table>
