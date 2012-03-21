|-if $message eq "ok"-|
<script type="text/javascript">
	$('question|-$surveyQuestion->getId()-|').remove();
</script>
Pregunta eliminada con exito.
|-else-|
Se ha producido un error al eliminar la Pregunta.