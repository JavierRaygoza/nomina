<template>
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">
                                <h1 v-text="titulo" class="font-weight-bold"></h1>
                            </div>
                            <div class="col-md-12 col-lg-3 text-lg-right" >
                                <button class="btn btn-outline-success btn-block"><span v-text="titulo"></span><i class="fa fa-plus-circle"></i></button>
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
                                    <td colspan="4">
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
                                            <button v-if="empleado.estado === 'Inactivo'" class="btn btn-success btn-sm">
                                                <i class="fa fa-user-check"></i>
                                            </button>
                                            <button v-if="empleado.estado === 'Activo'" class="btn btn-danger btn-sm">
                                                <i class="fa fa-user-slash"></i>
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm">
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm">
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
    </div>
</template>

<script>
    export default {
        data(){
            return{
                titulo               : 'Lista de empleados',
                agregar              : 'Agregar empleado',
                lbl_codigo           : 'Código',
                lbl_nombre           : 'Nombre',
                lbl_apellido_paterno : 'Apellido paterno',
                lbl_estado           : 'Estado',
                lbl_acciones         : 'Acciones',
                lbl_sin_registros    : 'No hay registros disponibles',
                empleados            : [],
                pagination : {
                    'total'        : 0,
                    'current_page' : 0,
                    'per_page'     : 0,
                    'last_page'    : 0,
                    'from'         : 0,
                    'to'           : 0,
                },
                offset: 3,
                search : ''
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
        },
        mounted() {
            this.getEmpleados();
        }
    }
</script>
