/************* Actualizar unidades de medida *************/

**Correr propel-gen antes que nada, para que cree la nueva columna unitId en las tablas correspondientes
**Completar la linea 6 de update_units con los sus datos de conexión
**Dar permisos de ejecución a update_units
**Ejecutar update_units
**Reemplazar el archivo vialidad.schema.xml de la carpeta WEB-INF/propel por el que está en esta carpeta (doc)
**Volver a correr propel-gen (este archivo nuevo le indica que borre la columna unit, que ya no se usará)
