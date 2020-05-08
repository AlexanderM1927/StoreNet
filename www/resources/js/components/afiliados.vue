<template>
  <div>
    <h1 class="titulo-seccion">Gestión de afiliados</h1>
    Nombre del afiliado:
    <div class="uk-inline">
    <span class="uk-form-icon" uk-icon="icon: cog"></span>
    <input class="uk-input field" v-model="datos" v-on:keyup="buscar" type="text" placeholder="Busqueda..." required>
    </div>
    <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>id</b></th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody v-for="afiliado in afiliados">
            <tr>
                <td>{{afiliado['id']}}</td>
                <td>{{afiliado['nombre']}}</td>
                <td>{{getEstado(afiliado['estado'])}}</td>
                <td><a href="#" uk-toggle="target: #modal-center" @click="modificar(afiliado)">Editar</a> / <a href="#" @click="eliminar(afiliado)">Deshabilitar</a></td>
            </tr>
        </tbody>
    </table>
    </div>
    <center>
      <br><br>
      <button @click="agregar" class="uk-button uk-button-primary uk-margin-small-right" type="button" uk-toggle="target: #modal-center">Agregar</button>
    </center>
        <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="creadorForm">
      <h3 class="title">{{metodo}}</h3>
      <div class="content" id="agregarAfiliado">
        <center>
        <form method="POST" action="" @submit.prevent="insertar">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombre" placeholder="Nombre" required v-model="nombre">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <select class="uk-input field" required v-model="estado" name="estado">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
          </div>
        </div>
        <button class="uk-button uk-button-default">Agregar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </center>
      </div>
      <div class="content" id="modificarAfiliado">
        <center>
        <form method="POST" action="" @submit.prevent="actualizar">
        <input type="hidden" name="id" v-model="id">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombre" placeholder="Nombre" required v-model="nombre">
          </div>
        </div>
        <button class="uk-button uk-button-default">Modificar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </center>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert';

export default {
  name: 'afiliado',
  data() {
    return {
        afiliados: [],
        datos: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        metodo: 'Agregar',
        id: '',
        nombre: '',
        estado: ''
    }
  },
  mounted(){
    axios
      .get('../procesarAfiliados/0')
      .then(response => (this.afiliados = response.data))
  },
  methods: {
    limpiar()
    {
      $('#modal-center').removeClass('uk-open').hide();
      this.id = ""
      this.nombre = ""
      this.estado = ""
      this.metodo = 'Agregar afiliado'
    },
    buscar()
    {
      if(this.datos=='')
      {
        axios
          .get('../procesarAfiliados/0')
          .then(response => (this.afiliados = response.data))
      }else{
        axios
          .get('../procesarAfiliados/0/'+this.datos) //Filtros
          .then(response => (this.afiliados = response.data))
      }
    },
    modificar(afiliado)
    {
      this.id = afiliado['id']
      this.nombre = afiliado['nombre']
      this.estado = afiliado['estado']
      $('#agregarAfiliado').hide()
      $('#modificarAfiliado').show()
      this.metodo = 'Modificar afiliado'
    },
    agregar()
    {
      this.limpiar()
      $('#agregarAfiliado').show()
      $('#modificarAfiliado').hide()
      this.metodo = 'Agregar afiliado'
    },
    insertar()
    {
      axios
      .post('../procesarAfiliados/1/',{nombre: this.nombre,
                                    estado: this.estado
                                    })
      .then(response => {this.afiliados = response.data;swal("El afiliado ha sido agregado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", e.response.data.message, "error")))
      this.limpiar();
    },
    actualizar()
    {
      axios
      .post('../procesarAfiliados/2/',{id: this.id,
                                    nombre: this.nombre,
                                    estado: this.estado
                                    })
      .then(response => {this.afiliados = response.data;swal("El afiliado ha sido actualizado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", e.response.data.message, "error")))
      this.limpiar();
    },
    eliminar(afiliado)
    {
      axios
      .get('../procesarAfiliados/3/'+afiliado['id']) 
      .then(response => {this.afiliados = response.data;swal("El afiliado ha sido eliminado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", e.response.data.message, "error")))
    },
    getEstado(valor)
    {
      if(valor == 0)
      return 'Inactivo'
      else
      return 'Activo'
    }
  }
};
</script>
