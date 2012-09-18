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
}
