<div class="successMessage">Etiqueta guardada correctamente</div>
<script type="text/javascript">
	$('#form_edit_tag')[0].reset();
</script>

<script type="text/javascript" language="javascript" charset="utf-8">
	$('#tagId').append($('<option></option>').val(|-$blogTag->getId()-|).attr('id','tagOption|-$blogTag->getId()-|').html('|-$blogTag->getName()-|'));
</script>
