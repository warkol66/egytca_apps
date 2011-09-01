<tr> 
    <td id="media_type_|-$mediaType->getid()-|_name">
        <span id="media_type_|-$mediaType->getid()-|" class="in_place_editable">|-$mediaType->getName()-|</span>
    </td>
    <td nowrap>|-if "mediasTypeEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
            <input type="hidden" name="do" value="mediasTypeEdit" /> 
                |-include file="FiltersRedirectInclude.tpl" filters=$filters-|
                |-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
            <input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
            <input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" id="media_type_edit_|-$mediaType->getid()-|" class="icon iconEdit" /> 
        </form> |-/if-|
        |-if "mediasTypeDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
            <input type="hidden" name="do" value="mediasTypeDoDelete" /> 
                |-include file="FiltersRedirectInclude.tpl" filters=$filters-|
                |-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
            <input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
            <input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Tipo?')" class="icon iconDelete" /> 
    </form>
    |-if $loginUser->isSupervisor()-|
    <form action="Main.php" method="post" style="display:inline;"> 
            <input type="hidden" name="do" value="mediasTypeDoDelete" /> 
                |-include file="FiltersRedirectInclude.tpl" filters=$filters-|
                |-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
            <input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
            <input type="hidden" name="doHardDelete" value="true" /> 
            <input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el Tipo definitivamente?')" class="icon iconHardDelete" /> 
    </form>
    |-if $mediaType->getDeletedAt() != NULL-|<form action="Main.php" method="post" style="display:inline;"> 
            <input type="hidden" name="do" value="mediasTypeUndeleteX" /> 
                |-include file="FiltersRedirectInclude.tpl" filters=$filters-|
                |-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
            <input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
            <input type="submit" name="submit_go_delete_type" value="Borrar" title="Recuperar registro" onclick="return confirm('Seguro que desea recuperar Tipo?')" class="icon iconUndelete" /> 
    </form>|-/if-||-/if-|
    |-/if-|</td> 
</tr> 

<script type="text/javascript">
    new Ajax.InPlaceEditor(
        'media_type_|-$mediaType->getId()-|',
        'Main.php?do=mediasTypeEditFieldX',
        {
            rows: 1,
            okText: 'Guardar',
            cancelText: 'Cancelar',
            savingText: 'Guardando...',
            cancelControl: 'button',
            externalControl: 'media_type_edit_|-$mediaType->getid()-|',
            clickToEditText: 'Haga click para editar',
            callback: function(form, value) { 
                return 'id=|-$mediaType->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
            },
            onFormReady: function(obj,form) {
                form.insert({ top: new Element('label').update('Nombre: ') });
            }
        }
    );
    new Effect.Highlight("media_type_|-$mediaType->getid()-|_name");
</script>
