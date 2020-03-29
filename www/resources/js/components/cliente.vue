<template>
  <div>
    <h1 class="titulo-seccion">Gestión de clientes</h1>
    ¿Deseas filtrar la tabla?:
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: cog"></span>
                <input class="uk-input field" type="text" placeholder="Busqueda..." required>
                </div>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: tag"></span>
                <select class="uk-input field" required>
                  <option value="0">id</option>
                  <option value="1">nombres</option>
                  <option value="2">apellidos</option>
                  <option value="3">mail</option>
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
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  name: 'cliente',
  data() {
    return {
        nombre:'',
        clientes: []
    }
  },
  mounted(){
    axios
      .get('../procesarClientes/0/0')
      .then(response => (this.clientes = response.data))
  },
  methods: {
  }
};
</script>
