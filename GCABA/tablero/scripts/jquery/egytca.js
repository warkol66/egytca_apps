/**
 * Configuraciones y funciones de uso comun.
 */
Egytca = {
	/**
	 * Ambiente: prod | dev | test
	 */
	environment: 'prod',
	/**
	 * Inicializador.
	 * 
	 * @example
	 *  Egytca.initialize('dev');
	 */
	initialize: function(env) {
		this.environment = env;
	},
	ajax: {
		/**
		 * Opciones por defecto.
		 */
		defaults: {
			url        : '',
			type       : 'POST',
			dataType   : 'html',
			/**
			 * Parametros
			 */
			data       : {},
			/**
			 * Antes de enviar el pedido (se ejecuta siempre).
			 */
			beforeSend : function(XMLHttpRequest) { return true },
			/**
			 * Handler para una respuesta exitosa
			 */
			success    : function(data, textStatus) {},
			/**
			 * Handler de una respuesta de error
			 */
			error      : function(XMLHttpRequest, textStatus, errorThrown) {},
			/**
			 * Despues de recibir la respuesta (se ejecuta siempre).
			 */
			complete   : function(XMLHttpRequest, textStatus) {},
			statusCode : {
				/**
				 * Handler de una respuesta con statusCode 404
				 */
				404: function() {},
				/**
				 * Handler de una respuesta con statusCode 500
				 */
				500: function() {}
			}
		},
		/**
		 * Merge entre las opciones por defecto y las nuevas.
		 */
		extend: function(options) {
			return $.extend({}, this.defaults, options);
		}
	}
};

(function( $ ){

	var methods = {
		
		init: function() { },
		
		/**
		 * @example
		 * 
		 *	$('.myEditables').egytca('inplaceEdit, 'test.php', {
		 *		submitdata: {
		 *			id: 2,
		 *			paramName: 'title',
		 *			// paramValue: passed automatically
		 *			someParam: "and it's value"
		 *		},
		 *		callback: function(value, settings) {
		 *			// value: response
		 *			// settings: inplace editor settings
		 *		}
		 *	})
		 *	.css('color', 'red');
		 *	
		 *	$('.myEditables').each(function() {
		 *		$(this).egytca('inplaceEdit, 'test.php', {
		 *			submitdata: {
		 *				id: $(this).attr('id'),
		 *				paramName: 'institution'
		 *			}
		 *		});
		 *	});
		 */
		inplaceEdit: function(url, options) {
			
			var settings = $.extend(true, {
				type: 'text',
				// cssclass: 'someClass',
				id: 'elementId', // no se puede eliminar?
				name: 'paramValue',
				submit: 'OK',
				cancel: 'Cancelar',
				indicator: '<img src="images/loading.gif" /> Guardando...',
				tooltip: 'Click para editar...'
			}, options);
			
			return this.each(function() {
				//$(this).hover(applyStyle, removeStyle);
				$(this).editable(url, settings);
			});
		},
		
		/**
		 * @example
		 * 
		 *	<select id="mySelect1" class="chzn-select markets-chz-select" data-placeholder="Elija una opcion..."></select>
		 *	<select id="mySelect2" class="chzn-select markets-chz-select" data-placeholder="Elija una opcion..."></select>
		 *	<input id="mySubmit" type="button" value="submit!!" onclick="console.log('submitted')" />
		 *	
		 *	$('#mySelect1').egytca('autocomplete', 'Main.php?do=actorsAutocompleteListX', {
		 *		disable: '#mySubmit', // any jQuery selector
		 *		method: POST, // defaults to GET
		 *		jsonTermKey: 'myPersonalizedParamName', // defaults to 'searchString'
		 *		data: { /+ additional parmas sent to request +/ }
		 *	}).change(function() { console.log($(this).val()) });
		 *	
		 *	$('#mySelect2').egytca('autocomplete', 'Main.php?do=actorsAutocompleteListX');
		 */
		autocomplete: function(url, options) {
			
			var haveResults = function(data) {
				for (var key in data) { return true; };
				return false;
			}
			
			var _this = $(this);
			
			var settings = $.extend(true, {url: url}, {
				method: 'GET',
				dataType: 'json',
				data: { type: 'json' },
				jsonTermKey: 'searchString',
				success: function(data) { // no parece necesario, pero si se sobreescribiera esta option tendríamos un bug menor
					if (settings.disable != undefined)
						$(settings.disable).attr('disabled', 'disabled');
					
					// TODO: revisar comportamiento extrano del boton al ocultar y volver a mostrar resultados
					$('.autocompNoResultButton').click(function(e){
						var data = _this.data('noResultsCallback')();
						_this.data('setElem')(data);
					});
				},
				noResultsText: 'No hay resultados',
				noResultsCallback: undefined
			}, options);
			
			
			
			return this.each(function() {
				
				var _this = $(this);
				
				_this.data('noResultsCallback', settings.noResultsCallback);
				_this.data('setElem', function(data) {
					var value;
					var text;
					for (var key in data) {
						value = key;
						text = data[key]
						break;
					}
					_this.find('option').remove();
					if (value != undefined && text != undefined) {
						var option = $('<option></option>').val(value).html(text);
						_this.append(option);
					}
					_this.trigger("liszt:updated");
					$(settings.disable).removeAttr('disabled');
				});
			
				_this.ajaxChosen(settings, function(data) {
					return haveResults(data) ? data : {
						'Egytca.autocomplete.NOVALUE': settings.noResultsText
						+ (settings.noResultsCallback == undefined ? '' :
						' <button class="autocompNoResultButton icon iconAdd"></button>')
					};
				}).change(function() {
					if ($(this).val() == 'Egytca.autocomplete.NOVALUE' && settings.disable != undefined)
						$(settings.disable).attr('disabled', 'disabled');
					else
						$(settings.disable).removeAttr('disabled');
				});
			});
		}
	};
	
	$.fn.egytca = function(method) {
		
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.egytca' );
		}
	};

})( jQuery );
