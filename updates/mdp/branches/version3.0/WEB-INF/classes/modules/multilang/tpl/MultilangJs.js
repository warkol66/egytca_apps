//Multilang Module

function addTranslation(a) {
	var div = $$("#textsBulkEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});

	return false;
}
