function contentShowContentFields(contentType) {
	
	var elements = $$('div');
	
	var regExpContent = /pContent/;
	var regExpLink = /pLink/;
	
	if (contentType == "link") {
		for (var i=0; i < elements.length; i++) {
			if (elements[i].id.search(regExpContent) != -1) {
				elements[i].hide();
			} 
			if (elements[i].id.search(regExpLink) != -1) {
				elements[i].show();
			} 
		};
	}

	if (contentType == "content") {
		for (var i=0; i < elements.length; i++) {
			if (elements[i].id.search(regExpContent) != -1) {
				elements[i].show();
			} 
			if (elements[i].id.search(regExpLink) != -1) {
				elements[i].hide();
			} 
		};
	}
}