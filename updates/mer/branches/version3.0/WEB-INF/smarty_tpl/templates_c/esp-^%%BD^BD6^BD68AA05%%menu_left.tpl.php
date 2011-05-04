<?php /* Smarty version 2.6.16, created on 2010-04-23 16:35:57
         compiled from menu_left.tpl */ ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td height="10"class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<?php if ($this->_tpl_vars['section'] != 'Profiles'): ?>
	<tr>
		<td class="menu2back_off"><a href="Main.php?do=profilesFormViewSelectCategory" class='linkmenu2backoff'>##27,PROFILES##</a></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class="menu2back_on"><a href="Main.php?do=profilesFormViewSelectCategory" class='linkmenu2backon'>##27,PROFILES##</a></td>
	</tr>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td height="2" class="bordesup"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_perfiles' style='display: block;'> <span class="menulevel2">##80,Ver perfiles de Actores## </span>
				<div class="divmenu2sec"><a href="Main.php?do=profilesFormViewSelectCategory" class="menu2sec">##81,Seleccione una Categoría##</a></div>
			</div></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_perfiles' style='display: block;'> <span class="menulevel2">##82,Completar perfiles de Actores##</span> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class="divmenu2sec"><a href="Main.php?do=profilesFormFillSelectCategory" class="menu2sec">##81,Seleccione una Categoría##</a></div>
				<?php else: ?>
				<div class='divmenu2sec'><a href="Main.php?do=profilesFormFillSelectCategory" class='menu2sec'>##83,Ver otra Categoría##</a></div>
				<?php if ($this->_tpl_vars['actor'] != ""): ?>
				<div class='divmenu2sec'><a href="Main.php?do=actorSelect&successAction=profilesFormFill&modulo=contacto&catID=<?php echo $this->_tpl_vars['actor']->getCategoryId(); ?>
" class='menu2sec'>##84,Ver otro Actor##</a></div>
				<?php endif; ?>
				<?php endif; ?> </div></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='compare_actors' style='display: block;'> <span class="menulevel2">Comparar Ciudades</span>
				<div class="divmenu2sec"><a href="Main.php?do=profilesFormViewMultipleSelect" class="menu2sec">Comparar perfiles</a></div>
			</div></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<?php if ($this->_tpl_vars['section'] != 'Relations'): ?>
	<tr>
		<td class="menu2back_off"><a href="Main.php?do=profilesFormRelSelectCategory" class='linkmenu2backoff'>##29,RELACIONES##</a></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class="menu2back_on"><a href="Main.php?do=profilesFormRelSelectCategory" class='linkmenu2backon'>##29,RELACIONES##</a></td>
	</tr>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td height="2" class="bordesup"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_perfiles' style='display: block;'> <span class="menulevel2">##85,Ver relaciones entre actores##</span>
				<div class="divmenu2sec"><a href="Main.php?do=profilesFormRelViewSelectCategory" class="menu2sec">Seleccione una Categoría</a></div>
			</div></td>
	</tr>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_perfiles' style='display: block;'> <span class="menulevel2">##86,Completar cuestionario de Relaciones##</span> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class="divmenu2sec"><a href="Main.php?do=profilesFormRelSelectCategory" class="menu2sec">##81,Seleccione una Categoría##</a></div>
				<?php else: ?>
				<div class='divmenu2sec'><a href="Main.php?do=profilesFormRelSelectCategory" class='menu2sec'>##83,Ver otra Categoría##</a></div>
				<?php if ($this->_tpl_vars['actor'] != ""): ?>
				<div class='divmenu2sec'><a href="Main.php?do=actorSelect&successAction=profilesFormFill&modulo=contacto&catID=<?php echo $this->_tpl_vars['actor']->getCategoryId(); ?>
" class='menu2sec'>##84,Ver otro Actor##</a></div>
				<?php endif; ?>
				<?php endif; ?> </div></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<?php if ($this->_tpl_vars['section'] != 'Analysis' && $this->_tpl_vars['section'] != 'AnalysisRelations'): ?>
	<tr>
		<td height="15" class="menu2back_off"><a href="Main.php?do=analysisSelectCategory" class='linkmenu2backoff'>##31,ANALISIS##</a></td>
	</tr>
	<?php else: ?>
	<tr>
		<td height="15" class="menu2back_on"><a href="Main.php?do=analysisSelectCategory" class='linkmenu2backon'>##31,ANALISIS##</a></td>
	</tr>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td height="15" class="menu2back_on">Analisis de Perfiles</td>
	</tr>
	<tr>
		<td height="2" class="bordesup"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_analisis' style='display: block;'> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class="divmenu2sec"><a href="Main.php?do=analysisSelectCategory" class="menu2sec">##81,Seleccione una Categoría##</a></div>
				<?php else: ?>
				<div class='divmenu2sec'><a href="Main.php?do=analysisSelectCategory" class='menu2sec'>##83,Ver otra Categoría##</a></div>
				<?php if ($this->_tpl_vars['actor'] != "" && $this->_tpl_vars['category'] != ""): ?>
				<div class='divmenu2sec'><a href="Main.php?do=analysisCategory&category=<?php echo $this->_tpl_vars['category']->getId(); ?>
" class='menu2sec'>##84,Ver otro Actor##</a></div>
				<?php endif; ?>
				<?php endif; ?> </div></td>
	</tr>
	<tr>
		<td height="15" class="menu2back_on">Analisis de Relaciones</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_red' style='display: block;'> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class='divmenu2sec'><a href="Main.php?do=analysisRelationSelectCategory" class='menu2sec'>##81,Seleccione una Categoría##</a></div>
				<?php endif; ?> </div></td>
	</tr>
	<tr>
		<td height="15" class="menu2back_on">Gráficos de Relaciones</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_red' style='display: block;'> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class='divmenu2sec'><a href="Main.php?do=analysisCompareRelSelectCategory" class='menu2sec'>##81,Seleccione una Categoría##</a></div>
				<?php endif; ?> </div></td>
	</tr>
	<tr>
		<td height="15" class="menu2back_on">Gráfico de Red</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_red' style='display: block;'> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class="divmenu2sec"><a href="Main.php?do=analysisGraphNetworkSelectActors" class="menu2sec">##81,Seleccione una Categoría##</a></div>
				<?php else: ?>
				<div class='divmenu2sec'><a href="Main.php?do=analysisGraphNetworkSelectActors" class='menu2sec'>##83,Ver otra Categoría##</a></div>
				<?php endif; ?> </div></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<?php if ($this->_tpl_vars['section'] != 'Strategies'): ?>
	<tr>
		<td class="menu2back_off"><a href="Main.php?do=strategiesSelectCategory" class='linkmenu2backoff'>##33,ESTRATEGIAS##</a></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class="menu2back_on"><a href="Main.php?do=strategiesSelectCategory" class='linkmenu2backon'>##33,ESTRATEGIAS##</a></td>
	</tr>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td height="2" class="bordesup"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_analisis' style='display: block;'> <?php if ($this->_tpl_vars['category'] == "" && $this->_tpl_vars['actor'] == ""): ?>
				<div class="divmenu2sec"><a href="Main.php?do=strategiesSelectCategory" class="menu2sec">##81,Seleccione una Categoría##</a></div>
				<?php else: ?>
				<div class='divmenu2sec'><a href="Main.php?do=strategiesSelectCategory" class='menu2sec'>##83,Ver otra Categoría##</a></div>
				<?php if ($this->_tpl_vars['actor'] != "" && $this->_tpl_vars['category'] != ""): ?>
				<div class='divmenu2sec'><a href="Main.php?do=strategiesCategory&category=<?php echo $this->_tpl_vars['category']->getId(); ?>
" class='menu2sec'>##84,Ver otro Actor##</a></div>
				<?php endif; ?>
				<?php endif; ?> </div></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<?php if ($this->_tpl_vars['section'] != 'Configure'): ?>
	<tr>
		<td class="menu2back_off"><a href="Main.php?do=merConfigure" class="linkmenu2backoff">##25,CONFIGURACION##</a></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class="menu2back_on"><a href="Main.php?do=merConfigure" class="linkmenu2backon">##25,CONFIGURACION##</a></td>
	</tr>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td height="15" class="menu2back_on">##67,ACTORES##</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_actores' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=actorsAddActors" class='menu2sec'>##68,Ingresar Actores##</a></div>
				<div class='divmenu2sec'><a href="Main.php?do=actorsAddActorInCategory" class='menu2sec'>##69,Compretar##</a></div>
				<div class='divmenu2sec'><a href="Main.php?do=actorsAssignCategoryToActors" class='menu2sec'>##70,Categorizar##</a></div>
				<div class='divmenu2sec'><a href="Main.php?do=actorsSetActorsHierarchy" class='menu2sec'>##71,Jerarquizar##</a></div>
				<div class='divmenu2sec'><a href="Main.php?do=actorsList" class='menu2sec'>##72,Administrar##</a></div>
			</div></td>
	</tr>
	<tr>
		<td height="15" class="menu2back_on">##73,CATEGORIAS##</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_categorias' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=categoriesList" class='menu2sec'>##74,Editar categorías##</a></div>
			</div></td>
	</tr>
	<?php if ($this->_tpl_vars['login_user']->isAdmin() == 1 || $this->_tpl_vars['login_user']->isSupervisor() == 1): ?>
	<tr>
		<td class="menu2back_on">##75,USUARIOS##</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_usuarios' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=usersList" class='menu2sec'>##76,Administrar Usuarios##</a></div>
			</div></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_usuarios' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=groupsList" class='menu2sec'>##77,Administrar Grupos##</a></div>
			</div></td>
	</tr>
	<?php if ($this->_tpl_vars['login_user']->isSupervisor() == 1): ?>
	<tr>
		<td class="menu2back_on">##78,CUESTIONARIOS##</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_usuarios' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=profilesFormEdit" class='menu2sec'>##28,Perfiles##</a></div>
			</div></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_usuarios' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=profilesFormRelEdit" class='menu2sec'>##30,Relaciones##</a></div>
			</div></td>
	</tr>
	<tr>
		<td class="menu2back_on">##79,GRAFICOS##</td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_usuarios' style='display: block;'>
				<div class='divmenu2sec'><a href="Main.php?do=analysisGraphList" class='menu2sec'>##28,Perfiles##</a></div>
			</div></td>
	</tr>
	<tr>
		<td class="fondoffffff"><div id='opc_usuarios' style='display: block;'>
				<div class='divmenu2sec'><a href="" class='menu2sec'>##30,Relaciones##</a></div>
			</div></td>
	</tr>
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
	<tr>
		<td height="2" class="menu2back2"><img src="images/clear.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td class='bordesup' height='7'><img src="images/clear.gif" width="1" height="7"></td>
	</tr>
	<tr>
		<td class='menu2back_salir'><a href='Main.php?do=usersDoLogout' onClick='return window.confirm("##87,¿Esta seguro que quiere salir del sistema?##")'>##39,Salir del sistema##</a></td>
	</tr>
</table>