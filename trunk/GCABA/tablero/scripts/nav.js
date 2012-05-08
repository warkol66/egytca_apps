function tableroNavigationShowGantt(form){

	$('graphicHolder').innerHTML = "<span class='inProgress'>...Generando gráfico...</span>";
	$('graphicHolder').show();

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'graphicHolder'},
				url,
				{
					method: 'get',
					parameters: fields,
					evalScripts: true,
					onComplete: tableroNavigationGanttShowed

				});

	return true;

}



function tableroNavigationGanttShowed(request) {
	$('graphicHolder').show();
	$('graphicCloser').show();

	return true;

}

function tableroDestroyGraphic() {

	$('graphicHolder').innerHTML = "";
	$('graphicHolder').hide();
	$('graphicCloser').hide();

	return true;

}

function tableroNavigationShowBar(form) {

	holder = $('graphicHolder');
	closer = $('graphicCloser');
	holder.hide();
	holder.innerHTML = "";

	var fields = Form.serialize(form);
	var image = document.createElement('img');
	
	holder.appendChild(image);
	holder.appendChild(document.createElement('br'));
	
	image.src = 'Main.php?' + fields;
	closer.show();
	holder.show();

	return true;


} 
