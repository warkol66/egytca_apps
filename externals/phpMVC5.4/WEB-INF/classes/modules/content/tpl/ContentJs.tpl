/**
 * Para mostrar los campos correctos si es un LInk o un Contenido/Seccion.
 * @param contentType El tipo del Contenido(0-Contendio, 1-Seccion,2-LInk)
 */
function contentShowContentFields(contentType) {
    contentType=parseInt(contentType);
    if(contentType==2){
        // En caso de ser un link
        $(".not_link").hide();
        $(".link").show();
    }
    else{
        //Para Contenidos o Secciones
        $(".not_link").show();
        $(".link").hide();
    }

}

$(function(){
    $("select.type").change(function(){
        contentShowContentFields(this.value);
    });
    contentShowContentFields(|-$content->getType()-|);
})


