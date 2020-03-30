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
    <div class="uk-overflow-auto tabla-clientes barra">
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
                <td><a href="#">Editar</a> / <a href="#">Eliminar</a></td>
            </tr>
        </tbody>
    </table>
    </div>
    <center>
      <br><br>
      <button class="uk-button uk-button-primary uk-margin-small-right" type="button" uk-toggle="target: #modal-center">{{metodo}}</button>
    </center>
        <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="creadorForm">
      <h3 class="title">{{metodo}}</h3>
      <div class="content">
        <center>
        <form action="procesarClientes/1" method="POST">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombres" placeholder="Nombres" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="apellidos" placeholder="Apellidos" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input field" type="mail" name="mail" placeholder="Correo eléctronico" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input field" type="password" name="password" placeholder="Clave" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: location"></span>
            <input class="uk-input field" type="text" name="direccion" placeholder="Direccion" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: phone"></span>
            <input class="uk-input field" type="text" name="telefono" placeholder="Telefono" required>
          </div>
        </div>
        <button class="uk-button uk-button-default">Agregar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close>Cerrar</button>
        </center>
      </div>
    </div>
        </div>
        </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  name: 'cliente',
  data() {
    return {
        nombre:'',
        clientes: [],
        datos: '',
        tipo: 'nombres',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        metodo: 'Agregar cliente'
    }
  },
  mounted(){
    axios
      .get('../procesarClientes/0')
      .then(response => (this.clientes = response.data))
  },
  methods: {
    buscar()
    {
      axios
      .get('../procesarClientes/0/'+this.tipo+'/'+this.datos) //Filtros
      .then(response => (this.clientes = response.data))
    }
  }
};
</script>
