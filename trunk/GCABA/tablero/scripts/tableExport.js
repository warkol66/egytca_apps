function tableExport(tableId, filename){
    var table = $(tableId);

    var wrap = document.createElement('div');
    wrap.appendChild(table.cloneNode(true));
    var content = '<html><head><style type="text/css">.left{text-align: left; }td {border: 2px solid #E9CA00;}th{   font-weight: bold; text-align: center;}td{  text-align: center; }</style></head><body>';
    content +=   wrap.innerHTML.replace(/á/g,'&aacute;')
                               .replace(/Á/g,'&Aacute;')
                               .replace(/é/g,'&eacute;')
                               .replace(/É/g,'&Eacute;')
                               .replace(/í/g,'&iacute;')
                               .replace(/Í/g,'&Iacute;')
                               .replace(/ó/g,'&oacute;')
                               .replace(/Ó/g,'&Oacute;')
                               .replace(/ú/g,'&uacute;')
                               .replace(/Ú/g,'&Uacute;')
                               .replace(/ñ/g,'&ntilde;')
                               .replace(/Ñ/g,'&Ntilde;');

    content +=  '</tbody></table> </body></html>';

    var form = document.forms["formTableExport"];
    form["filename"].value = filename;
    form["content"].value = content;
    form.submit();
}
