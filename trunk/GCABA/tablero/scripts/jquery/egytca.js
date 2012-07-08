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
		
		autocomplete: function(url, options) {
			
			var settings = $.extend(true, { url: url }, {
				method: 'GET',
				dataType: 'json',
				data: { type: 'json' },
				jsonTermKey: 'searchString'
			}, options);
			
			return this.each(function() {
				$(this).ajaxChosen(settings, function(data) { return data; });
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
