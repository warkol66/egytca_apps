<link rel="stylesheet" href="css/autocomplete.css" type="text/css">
<script type="text/javascript" language="javascript" charset="utf-8">
	/**
	 * @param: id_of_text_field, id del input donde se ingresa el texto para autocompletar.
	 * @param: id_of_div_to_populate, id del div donde se va a renderizar la lista de opciones que matchean.
	 * @param: options, objeto javascript con las opciones para el Ajax.Autocompleter, ver documentacion del mismo. Se proveen ciertos valores por defecto.
	 * @param: on_complete, funcion javascript a ejecutarse cada vez que se recarga el listado.
	 */
	var MiniAutocompleter = Class.create(Ajax.Autocompleter, {
		initialize: function($super, id_of_text_field, id_of_div_to_populate, url, options, on_complete) {
			if (Object.isUndefined(this.autocompleterInstance)) {
				if (Object.isUndefined(options)) {
					options = {
							paramName: |-if $paramName ne ''-||-$paramName-||-else-|'value'|-/if-|,
							indicator: |-if $indicator ne ''-||-$indicator-||-else-|'indicator1'|-/if-|,
							tokens: |-if $tokens ne ''-||-$tokens-||-else-|'\n'|-/if-|,
							minChars: |-if $minChars ne ''-||-$minChars-||-else-|3|-/if-|,
							parameters: |-if $limit ne ''-|'limit=|-$limit-|'|-else-|'limit=10'|-/if-|,
							onShow: function(element, update){
								if(!update.style.position || update.style.position=='absolute') {
									update.style.position = 'absolute';
									Position.clone(element, update, {
										setHeight: false,
										setWeight: false,
										offsetTop: element.positionedOffset().top + element.getHeight()
									});
								}
								update.style.width = 'auto';
								Effect.Appear(update,{duration:0.15});
					        }
					};
				} else {
					if (Object.isUndefined(options.paramName)) {
						options.paramName = |-if $paramName ne ''-||-$paramName-||-else-|'value'|-/if-|;
					}
					if (Object.isUndefined(options.indicator)) {
						options.indicator = |-if $indicator ne ''-||-$indicator-||-else-|'indicator1'|-/if-|;
					}
					if (Object.isUndefined(options.tokens)) {
						options.tokens = |-if $tokens ne ''-||-$tokens-||-else-|'\n'|-/if-|;
					}
					if (Object.isUndefined(options.minChars)) {
						options.minChars = |-if $minChars ne ''-||-$minChars-||-else-|3|-/if-|;
					}
					if (Object.isUndefined(options.parameters)) {
						options.parameters = |-if $limit ne ''-|'limit=|-$limit-|'|-else-|'limit=10'|-/if-|;
					}
					if (Object.isUndefined(options.onShow)) {
						options.onShow = function(element, update){
							if(!update.style.position || update.style.position=='absolute') {
								update.style.position = 'absolute';
								Position.clone(element, update, {
									setHeight: false,
									setWeight: false,
									offsetTop: element.positionedOffset().top + element.getHeight()
								});
							}
							update.style.width = 'auto';
							Effect.Appear(update,{duration:0.15});
				        };
					}
				}
				$super(id_of_text_field, id_of_div_to_populate, url, options);
				this.responder = {
					onComplete: function() {
						MiniAutocompleter.highlightMatches(id_of_text_field, id_of_div_to_populate);
						if (Object.isFunction(on_complete)) {
							on_complete();
						}
					}
				};
			}
		},
		unregister: function() {
			Ajax.Responders.unregister(this.responder);
		},
		register: function() {
			Ajax.Responders.register(this.responder);
		},
		
		onHover: function(event) {
			var element = Event.findElement(event, 'LI');
			if (Object.isElement(element)) {
				if(this.index != element.autocompleteIndex) {
			        this.index = element.autocompleteIndex;
			        this.render();
			    }
			}
		    Event.stop(event);
		},

		onClick: function(event) {
			var element = Event.findElement(event, 'LI');
			if (Object.isElement(element)) {
		    	this.index = element.autocompleteIndex;
		    	this.selectEntry();
			}
		    this.hide();
		}
	});
	
	MiniAutocompleter.highlightMatches = function(id_of_text_field, id_of_div_to_populate) {
		var searchString = $(id_of_text_field).value;
		// la funcion gsub de prototype es case sensitive, por eso se usa una regular expresion para espeficar un patron que no lo sea.
		var pattern = new RegExp(searchString, 'i');
		$$('#'+id_of_div_to_populate+' li').each(function(e){
			if (!e.hasClassName("informative_only")) {
				var stringToReplace = e.innerHTML;
				e.innerHTML = stringToReplace.gsub(pattern, '<strong>#{0}</strong>');
			}
		});
	};
	MiniAutocompleter.initAutocomplete = function(instanceHolder, id_of_text_field, id_of_div_to_populate, url, options, on_complete) {
		if (Object.isUndefined(instanceHolder)) {
			instanceHolder = new MiniAutocompleter(id_of_text_field, id_of_div_to_populate, url, options, on_complete);	
		}
	};
</script>