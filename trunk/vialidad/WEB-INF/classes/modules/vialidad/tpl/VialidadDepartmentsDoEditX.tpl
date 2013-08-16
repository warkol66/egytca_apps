	|-include file="VialidadDepartmentsListInclude.tpl"-|
<script type="text/javascript">
function setStatus(status) {

	var actionMessage = $('actionMessage');
	if (actionMessage)
		actionMessage.hide();

	switch (status) {
		case 'working':
			msgs = document.getElementsByName('done_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].hide();
			msgs = document.getElementsByName('working_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].show();
			break;
		case 'done':
			msgs = document.getElementsByName('working_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].hide();
			msgs = document.getElementsByName('done_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].show();
			break;
		default:
			// unimplemented status
			break;
	}
}

Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});


function toggleInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}

function prepareAndSubmit(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
		{ success: 'departmentsList' },
		'Main.php',
		{
			method: 'post',
			postBody: fields,
			evalScripts: true
		}
	);
	form.name.value = '';
}

function chomp(raw_text) {
    return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
    element.innerHTML = chomp(element.innerHTML);
}
</script>