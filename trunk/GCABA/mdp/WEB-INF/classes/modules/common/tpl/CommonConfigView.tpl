<h2>##common,18,Configuración del Sistema##</h2>
<h1>Variables de Configuración del Sistema</h1>
<p>A continuación podrá ver las variables de configuración del sistema.</p>
|-if $message eq "ok"-|
	<div class='successMessage'>Configuración Guardada</div>
|-/if-|
<!-- BOX VARIABLES ------------------------------->
<div id="boxVariables">
	<ul>
		|-foreach from=$config item=block name=for_blocks key=name-|
			<li><span class='titulo2'>|-$name-|</span></li>
		<ul>
			|-include file="CommonConfigViewInclude.tpl" elements=$block-|
		</ul>
		|-/foreach-|
	</ul>
</div>