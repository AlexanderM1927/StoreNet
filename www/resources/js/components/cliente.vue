<template>
  <div>
    <h1 class="titulo-seccion">Gestión de clientes</h1>
    ¿Deseas filtrar la tabla?:
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: cog"></span>
                <input class="uk-input field" v-model="datos" v-on:keyup="buscar" type="text" placeholder="Busqueda..." required>
                </div>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: tag"></span>
                <select v-on:change="buscar" class="uk-input field" v-model="tipo">
                  <option value="id">id</option>
                  <option value="nombres">nombres</option>
                  <option value="mail">mail</option>
                </select>
                </div>
    <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>id</b></th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Mail</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody v-for="cliente in clientes">
            <tr>
                <td>{{cliente['id']}}</td>
                <td>{{cliente['nombres']}}</td>
                <td>{{cliente['apellidos']}}</td>
                <td>{{cliente['mail']}}</td>
                <td>{{cliente['direccion']}}</td>
                <td>{{cliente['telefono']}}</td>
                <td><a href="#" uk-toggle="target: #modal-center" @click="modificar(cliente)">Editar</a> / <a href="#" @click="eliminar(cliente)">Deshabilitar</a></td>
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
      <div class="content" id="agregarCliente">
        <center>
        <form method="POST" action="" @submit.prevent="insertar">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombres" placeholder="Nombres" required v-model="nombres">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="apellidos" placeholder="Apellidos" required v-model="apellidos">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input field" type="mail" name="mail" placeholder="Correo eléctronico" required v-model="mail">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input field" type="password" name="password" placeholder="Clave" required v-model="password">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: location"></span>
            <input class="uk-input field" type="text" name="direccion" placeholder="Direccion" required v-model="direccion">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: phone"></span>
            <input class="uk-input field" type="text" name="telefono" placeholder="Telefono" required v-model="telefono">
          </div>
        </div>
        <button class="uk-button uk-button-default">Agregar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </center>
      </div>
      <div class="content" id="modificarCliente">
        <center>
        <form method="POST" action="" @submit.prevent="actualizar">
        <input type="hidden" name="id" v-model="id">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombres" placeholder="Nombres" required v-model="nombres">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="apellidos" placeholder="Apellidos" required v-model="apellidos">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input field" type="mail" name="mail" placeholder="Correo eléctronico" required v-model="mail">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input field" type="password" name="password" placeholder="Clave" required v-model="password">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: location"></span>
            <input class="uk-input field" type="text" name="direccion" placeholder="Direccion" required v-model="direccion">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: phone"></span>
            <input class="uk-input field" type="text" name="telefono" placeholder="Telefono" required v-model="telefono">
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
  name: 'cliente',
  data() {
    return {
        nombre:'',
        clientes: [],
        datos: '',
        tipo: 'nombres',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        metodo: 'Agregar cliente',
        id: '',
        nombres: '',
        apellidos: '',
        mail: '',
        password: '',
        direccion: '',
        telefono: ''
    }
  },
  mounted(){
    axios
      .get('../procesarClientes/0')
      .then(response => (this.clientes = response.data))
  },
  methods: {
    limpiar()
    {
      $('#modal-center').removeClass('uk-open').hide();
      this.id = ""
      this.nombres = ""
      this.apellidos = ""
      this.mail = ""
      this.password = ""
      this.direccion = ""
      this.telefono = ""
      this.metodo = 'Agregar cliente'
    },
    buscar()
    {
      if(this.datos=='')
      {
        axios
          .get('../procesarClientes/0')
          .then(response => (this.clientes = response.data))
      }else{
        axios
          .get('../procesarClientes/0/'+this.tipo+'/'+this.datos) //Filtros
          .then(response => (this.clientes = response.data))
      }
    },
    modificar(cliente)
    {
      this.id = cliente['id']
      this.nombres = cliente['nombres']
      this.apellidos = cliente['apellidos']
      this.mail = cliente['mail']
      this.password = cliente['password']
      this.direccion = cliente['direccion']
      this.telefono = cliente['telefono']
      $('#agregarCliente').hide()
      $('#modificarCliente').show()
      this.metodo = 'Modificar cliente'
    },
    agregar()
    {
      this.limpiar()
      $('#agregarCliente').show()
      $('#modificarCliente').hide()
      this.metodo = 'Agregar cliente'
    },
    insertar()
    {
      axios
      .post('../procesarClientes/1/',{nombres: this.nombres,
                                    apellidos: this.apellidos,
                                    mail: this.mail,
                                    password: this.password,
                                    direccion: this.direccion,
                                    telefono: this.telefono,
                                    }) //Filtros
      .then(response => {this.clientes = response.data;swal("El cliente ha sido agregado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", "Por favor comunicarte a través de un reporte", "error")))
      this.limpiar();
    },
    actualizar()
    {
      axios
      .post('../procesarClientes/2/',{id: this.id,
                                    nombres: this.nombres,
                                    apellidos: this.apellidos,
                                    mail: this.mail,
                                    password: this.password,
                                    direccion: this.direccion,
                                    telefono: this.telefono,
                                    })
      .then(response => {this.clientes = response.data;swal("El cliente ha sido actualizado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", "Por favor comunicarte a través de un reporte", "error")))
      this.limpiar();
    },
    eliminar(cliente)
    {
      axios
      .get('../procesarClientes/3/'+cliente['id']) //Filtros
      .then(response => {this.clientes = response.data;swal("El cliente ha sido eliminado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", "Por favor comunicarte a través de un reporte", "error")))
    },
  }
};
</script>
