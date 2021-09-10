## Prueba Técnica - Dropstudio

Prueba de desarrollo backend Laravel

Importante:
Crear repositorio público en gitlab/github y versionar el ejercicio cada uno de los puntos deberán
de ser un commit y agregar comentarios sobre cada punto.

Objetivo: Crear un CRUD de empleados con el Framework (Laravel) el diseño de la interfaz, la
arquitectura y diseño de la aplicación es abierta y propuesta por el postulante.

1. Crear un nuevo proyecto en Laravel con el nombre de Nomina.
2. Generar la migración para la tabla de empleados utilizando los siguientes campos: id,
código, nombre, apellido paterno, apellido materno, correo electrónico, tipo de contrato, estado
(Activo o inactivo)
3. Crear un listado de todos los empleados registrados en la tabla creada anteriormente,
pero omitiendo empleados eliminados, agregar botón para agregar un nuevo empleado, además,
el listado debe contener una columna con acciones de ver detalle, editar, activar/desactivar y
eliminar.
4. Las acciones de creación y edición deberán de validar durante el envió del formulario el
campo de correo electrónico (tipo email), nombre y apellidos (no debe permitir números, pero si
guiones) desde Laravel si las validaciones son correctas se deberá guardar o actualizar la
información en la base de datos
5. Funcionalidad para activar o desactivar un empleado
6. Realizar eliminación lógica
7. Vista para ver información por empleado. Puntos extra: Realizar pruebas unitarias del
CRUD, Arquitectura escalable y mantenible, comentarios en código.