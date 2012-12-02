<div style="margin-left:15px; "><h2>Ayuda</h2>
<h1>Tutoriales</h1>
|-if $fileName-|
<object id="tutorial1" classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112" type="application/x-oleobject" width="856" height="480" standby="Cargando componentes de Microsoft® Windows® Media Player ..."> 
<param name="filename" value="|-$fileName-|"> 
<param name="autoStart" value="True"> 
<param name="showControls" value="true"> 
<embed src="|-$fileName-|" width="856" height="480" autoStart="false" type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" ></embed>
</object>
<p>&nbsp;</p>
<p>Si su navegador no tuviese el plugin de Windows Media Player instalado, puede instalar uno compatible con su navegador.<br>
En caso que no lo pueda instalar, puede descargarlo para ver con un reproductor multimedia haciendo click <a href="|-$fileName-|">aquí</a>. </p>
|-else-|
	<p class="error">Ha indicado un archivo inexistente</p>
|-/if-|
</div>