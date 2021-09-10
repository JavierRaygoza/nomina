<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">
                                <h1 v-text="titulo" class="font-weight-bold"></h1>
                            </div>
                            <div class="col-md-12 col-lg-3 text-lg-right" >
                                <button class="btn btn-outline-success btn-block" @click="accionEmpleado('agregar')" data-toggle="modal" data-target="#empleadoModal"><span v-text="agregar"></span><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th v-text="lbl_codigo"></th>
                                        <th v-text="lbl_nombre"></th>
                                        <th v-text="lbl_apellido_paterno"></th>
                                        <th v-text="lbl_estado"></th>
                                        <th v-text="lbl_acciones"></th>
                                    </tr>
                                </thead>
                                <tbody v-if="empleados.length === 0">
                                    <td colspan="5">
                                        <h4 class="text-danger text-center" v-text="lbl_sin_registros"></h4>
                                    </td>
                                </tbody>
                                <tbody v-else>
                                    <tr v-for="empleado in empleados" :key="empleado.id">
                                        <td v-text="empleado.codigo"></td>
                                        <td v-text="empleado.nombre"></td>
                                        <td v-text="empleado.apellido_paterno"></td>
                                        <td v-text="empleado.estado" v-if="empleado.estado === 'Inactivo'" class="text-danger font-weight-bold"></td>
                                        <td v-text="empleado.estado" v-if="empleado.estado === 'Activo'" class="text-success font-weight-bold"></td>
                                        <td>
                                            <button @click="activarDesactivar(empleado)" v-if="empleado.estado === 'Inactivo'" class="btn btn-success btn-sm">
                                                <i class="fa fa-user-check"></i>
                                            </button>
                                            <button @click="activarDesactivar(empleado)" v-if="empleado.estado === 'Activo'" class="btn btn-danger btn-sm">
                                                <i class="fa fa-user-slash"></i>
                                            </button>
                                            <button @click="accionEmpleado('editar', empleado)" data-toggle="modal" data-target="#infoModal" class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button @click="accionEmpleado('editar', empleado)" data-toggle="modal" data-target="#empleadoModal" class="btn btn-outline-warning btn-sm">
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                            <button @click="eliminarEmpleado(empleado)" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                                <nav aria-label="...">
                                  <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                      <a @click="cambiarPagina(pagination.current_page - 1, search)" class="page-link" href="#">Anterior</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a @click.prevent="cambiarPagina(page, search)" class="page-link" href="#" v-text="page"></a></li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                      <a @click="cambiarPagina(pagination.current_page + 1, search)" class="page-link" href="#">Siguiente</a>
                                    </li>
                                  </ul>
                                </nav>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="empleadoModal" tabindex="-1" aria-labelledby="empleadoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="empleadoModalLabel" v-text="modal_titulo"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="codigo" v-text="lbl_codigo" id="codigo"></label>
                                <input type="text" name="codigo" v-model="codigo" class="form-control">
                                <div class="row">
                                    <ul v-if="errors.codigo !== []">
                                        <li v-for="error in errors.codigo" :key="error.codigo" v-text="error" class="text-danger"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="nombre" v-text="lbl_nombre" id="nombre"></label>
                                <input type="text" name="nombre" v-model="nombre" class="form-control">
                                <div class="row">
                                    <ul v-if="errors.nombre !== []">
                                        <li v-for="error in errors.nombre" :key="error.nombre" v-text="error" class="text-danger"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="apellido_paterno" v-text="lbl_apellido_paterno" id="apellido_paterno"></label>
                                <input type="text" name="apellido_paterno" v-model="apellido_paterno" class="form-control">
                                <div class="row">
                                    <ul v-if="errors.apellido_paterno !== []">
                                        <li v-for="error in errors.apellido_paterno" :key="error.apellido_paterno" v-text="error" class="text-danger"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="apellido_materno" v-text="lbl_apellido_materno" id="apellido_materno"></label>
                                <input type="text" name="apellido_materno" v-model="apellido_materno" class="form-control">
                                <div class="row">
                                    <ul v-if="errors.apellido_materno !== []">
                                        <li v-for="error in errors.apellido_materno" :key="error.apellido_materno" v-text="error" class="text-danger"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="correo_electronico" v-text="lbl_correo_electronico" id="correo_electronico"></label>
                                <input type="email" name="correo_electronico" v-model="correo_electronico" class="form-control">
                                <div class="row">
                                    <ul v-if="errors.correo_electronico !== []">
                                        <li v-for="error in errors.correo_electronico" :key="error.correo_electronico" v-text="error" class="text-danger"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="tipo_contrato" v-text="lbl_tipo_contrato"></label>
                                <select name="tipo_contrato" id="tipo_contrato" v-model="tipo_contrato" class="form-control custom-select">
                                    <option value="Prueba" selected>Prueba</option>
                                    <option value="Temporal" selected>Temporal</option>
                                    <option value="Indefinido" selected>Indefinido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="limpiarModal()" type="button" class="btn btn-danger" data-dismiss="modal" v-text="btn_cerrar"></button>
                    <button v-if="accion === 'agregar'" @click="agregarEmpleado()" type="button" class="btn btn-primary" v-text="btn_guardar"></button>
                    <button v-if="accion === 'editar'" @click="actualizarEmpleado()" type="button" class="btn btn-primary" v-text="btn_guardar"></button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="infoModalLabel" v-text="nombre + ' ' + apellido_paterno"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr><p class="font-weight-bold text-muted" v-text="lbl_nombre"></p></tr>
                            <tr><p class="font-weight-bold text-dark" v-text="nombre + ' ' + apellido_paterno + ' ' + apellido_materno"></p></tr>
                            <tr><p class="font-weight-bold text-muted" v-text="lbl_correo_electronico"></p></tr>
                            <tr>
                                <p class="font-weight-bold text-dark">
                                    <a v-bind:href="'mailto:' + correo_electronico"> {{ correo_electronico }} </a>
                                </p>
                            </tr>
                            <tr><p class="font-weight-bold text-muted" v-text="lbl_tipo_contrato"></p></tr>
                            <tr><p class="font-weight-bold text-dark" v-text="tipo_contrato"></p></tr>
                            <tr><p class="font-weight-bold text-muted" v-text="lbl_estado"></p></tr>
                            <tr><p v-if="estado == 'Activo'" class="font-weight-bold text-success" v-text="estado"></p></tr>
                            <tr><p v-if="estado == 'Inactivo'" class="font-weight-bold text-danger" v-text="estado"></p></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button @click="limpiarModal()" type="button" class="btn btn-danger" data-dismiss="modal" v-text="btn_cerrar"></button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                titulo                       : 'Lista de empleados',
                agregar                      : 'Agregar empleado',
                lbl_codigo                   : 'Código',
                lbl_nombre                   : 'Nombre',
                lbl_apellido_paterno         : 'Apellido paterno',
                lbl_apellido_materno         : 'Apellido materno',
                lbl_correo_electronico       : 'Correo electrónico',
                lbl_tipo_contrato            : 'Tipo de contraro',
                lbl_estado                   : 'Estado',
                lbl_acciones                 : 'Acciones',
                lbl_sin_registros            : 'No hay registros disponibles',
                empleados                    : [],
                errors                       : {
                    'nombre'                 : [],
                    'codigo'                 : [],
                    'apellido_paterno'       : [],
                    'apellido_materno'       : [],
                    'correo_electronico'     : [],
                },
                id                           : null,
                codigo                       : null,
                nombre                       : null,
                apellido_paterno             : null,
                apellido_materno             : null,
                correo_electronico           : null,
                estado                       : null,
                accion                       : 'agregar',
                tipo_contrato                : 'Prueba',
                btn_cerrar                   : 'Cerrar',
                btn_guardar                  : 'Guardar',
                modal_titulo                 : 'Agregar empleado',
                titulo_exito_eliminacion     : 'Empleado eliminado exitosamente.',
                desripcion_exito_eliminacion : 'El empleado se ha eliminado.',
                titulo_error_eliminacion     : 'Error al eliminar al empleado.',
                desripcion_error_eliminacion : 'El empleado no ha sido habilitado.',
                titulo_exito_activar         : 'Empleado activo exitosamente.',
                desripcion_exito_activar     : 'El empleado se ha habilitado.',
                titulo_error_activar         : 'Error al habilitar al empleado.',
                desripcion_error_activar     : 'El empleado no ha sido habilitado.',
                titulo_exito_inactivar       : 'Empleado inactivo exitosamente.',
                desripcion_exito_inactivar   : 'El empleado se ha inhabilitado.',
                titulo_error_inactivar       : 'Error al inhabilitar al empleado.',
                desripcion_error_inactivar   : 'El empleado no ha sido inhabilitado.',
                search                       : '',
                offset                       : 3,
                pagination                   : {
                    'total'                  : 0,
                    'current_page'           : 0,
                    'per_page'               : 0,
                    'last_page'              : 0,
                    'from'                   : 0,
                    'to'                     : 0,
                },
            }
        },
        computed : {
            isActived : function(){
                return this.pagination.current_page;
            },
            pagesNumber : function(){
                if (!this.pagination.to) {return[];}
                let from = this.pagination.current_page -this.offset;
                if (from < 1) {from =1;}
                let to = from + (this.offset *2);
                if (to >= this.pagination.last_page) {to = this.pagination.last_page;}
                let pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            cambiarPagina(page){
                this.pagination.current_page = page;
                this.getEmpleados(page);
            },
            getEmpleados(page = 1, search = ''){
                let url = '/empleados?search='+search+'&page='+page;
                axios.get(url).then((response) => {
                    let { data } = response;
                    let { empleados, pagination } = data;
                    this.empleados  = empleados.data;
                    this.pagination = pagination;
                }).catch((error) => {
                    console.log(error);
                });
            },
            agregarEmpleado(){
                axios.post('/empleados',{
                'codigo'            : this.codigo,
                'nombre'            : this.nombre,
                'apellido_paterno'  : this.apellido_paterno,
                'apellido_materno'  : this.apellido_materno,
                'correo_electronico': this.correo_electronico,
                'tipo_contrato'     : this.tipo_contrato,
                }).then((response) => {
                    console.log(response);
                    let { status } = response;
                    if( status === 200 ){
                        this.limpiarModal();
                        this.getEmpleados();
                        Swal.fire({
                            type  : 'success',
                            title : 'Empleado agregado exitosamente.',
                            text  : 'El empleado se ha registrado.',
                        });
                    } else {
                        this.limpiarModal();
                        this.getEmpleados();
                        Swal.fire({
                            type  : 'error',
                            title : 'Error al registrar al empleado.',
                            text  : 'El empleado no ha sido registrado.',
                        });
                    }
                }).catch((error) => {
                    this.errors = errors = {
                        'nombre'             : [],
                        'codigo'             : [],
                        'apellido_paterno'   : [],
                        'apellido_materno'   : [],
                        'correo_electronico' : [],
                    };
                    let { response, response: { data, data: { errors } } } = error;
                    this.errors = errors;
                    console.log(error);
                });
            },
            actualizarEmpleado(){
                axios.put('/empleados/'+ this.id,{
                'id'                 : this.id,
                'codigo'             : this.codigo,
                'nombre'             : this.nombre,
                'apellido_paterno'   : this.apellido_paterno,
                'apellido_materno'   : this.apellido_materno,
                'correo_electronico' : this.correo_electronico,
                'tipo_contrato'      : this.tipo_contrato
                }).then((response) => {
                    let { status } = response;
                    if( status === 200 ){
                        this.limpiarModal();
                        this.getEmpleados();
                        Swal.fire({
                            type  : 'success',
                            title : 'Empleado actualizado exitosamente.',
                            text  : 'El empleado se ha actualizado.',
                        });
                    } else {
                        this.limpiarModal();
                        this.getEmpleados();
                        Swal.fire({
                            type  : 'error',
                            title : 'Error al actualizar al empleado.',
                            text  : 'El empleado no ha sido actualizado.',
                        });
                    }
                }).catch((error) => {
                    let { response, response: { data, data: { errors } } } = error;
                    this.errors = errors;
                    console.log(error);
                });
            },
            accionEmpleado(accion, modelo = []){

                this.accion = accion;

                if( accion === 'editar' ){
                    this.modal_titulo       = 'Actualizar empleado',
                    this.id                 = modelo.id;
                    this.codigo             = modelo.codigo;
                    this.nombre             = modelo.nombre;
                    this.apellido_paterno   = modelo.apellido_paterno;
                    this.apellido_materno   = modelo.apellido_materno;
                    this.correo_electronico = modelo.correo_electronico;
                    this.tipo_contrato      = modelo.tipo_contrato;
                    this.estado             = modelo.estado;
                } 
            },
            limpiarModal(){
                this.modal_titulo       = 'Agregar empleado',
                this.codigo             = null;
                this.nombre             = null;
                this.apellido_paterno   = null;
                this.apellido_materno   = null;
                this.correo_electronico = null;
                this.tipo_contrato      = 'Prueba';
                this.errors             = {
                    'nombre'             : [],
                    'codigo'             : [],
                    'apellido_paterno'   : [],
                    'apellido_materno'   : [],
                    'correo_electronico' : [],
                };
                $('#empleadoModal').modal('hide');
            },
            cambiarEstados(campo, valor, modelo, titulo_exito, descripcion_exito, titulo_error, descripcion_error){
                axios.put('/empleados/estado/'+ modelo.id,{
                    [`${campo}`] : valor
                }).then((response) => {
                    let { status } = response;
                    if( status === 200 ){
                        this.getEmpleados();
                        Swal.fire({
                            type  : 'success',
                            title : titulo_exito,
                            text  : descripcion_exito,
                        });
                    } else {
                        this.getEmpleados();
                        Swal.fire({
                            type  : 'error',
                            title : titulo_error,
                            text  : descripcion_error,
                        });
                    }
                }).catch((error) => {
                    console.log(error);
                });
            },
            activarDesactivar(empleado){
                switch (empleado.estado) {
                    case 'Activo':
                        this.cambiarEstados('estado', 'Inactivo', empleado, this.titulo_exito_inactivar, this.desripcion_exito_inactivar, this.titulo_error_inactivar, this.desripcion_error_inactivar);
                        break;

                    case 'Inactivo':
                        this.cambiarEstados('estado', 'Activo', empleado, this.titulo_exito_activar, this.desripcion_exito_inactivar, this.titulo_error_activar, this.desripcion_error_activar);
                        break;
                }
            },
            eliminarEmpleado(empleado){
                Swal.fire({
                  title: '¿Esta seguro de eliminar al empleado?',
                  text: "El registo de empleado no se podrá reestablecer.",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Eliminar'
                }).then((result) => {
                  if (result.value) {
                    this.cambiarEstados('estatus', 0, empleado, this.titulo_exito_eliminacion, this.desripcion_exito_eliminacion, this.titulo_error_eliminacion, this.desripcion_error_eliminacion);
                  }
                });
            }
        },
        mounted() {
            this.getEmpleados();
        }
    }
</script>
