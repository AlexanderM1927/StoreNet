<template>
  <div>
    <h1 class="titulo-seccion">Gestión de empleados</h1>
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
                  <option value="rango">rango (numero)</option>
                </select>
                </div>
    <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>id</b></th>
                <th>Rango</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Mail</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody v-for="empleado in empleados">
            <tr>
                <td>{{empleado['id']}}</td>
                <td>{{empleado['rango']}}</td>
                <td>{{empleado['nombres']}}</td>
                <td>{{empleado['apellidos']}}</td>
                <td>{{empleado['mail']}}</td>
                <td>{{empleado['direccion']}}</td>
                <td>{{empleado['telefono']}}</td>
                <td><a href="#" uk-toggle="target: #modal-center" @click="modificar(empleado)">Editar</a> / <a href="#" @click="eliminar(empleado)">Deshabilitar</a></td>
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
      <div class="content" id="agregarEmpleado">
        <center>
        <form method="POST" action="" @submit.prevent="insertar">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <select class="uk-input field" v-model="rango" name="rango">
                  <option value="1">Vendedor</option>
                  <option value="2">Supervisor</option>
                  <option value="3">Administrador</option>
                  <option value="4">Super administrador</option>
                </select>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: plus"></span>
            <input class="uk-input field" type="text" name="sueldo" placeholder="Sueldo" required v-model="sueldo">
          </div>
        </div>
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
      <div class="content" id="modificarEmpleado">
        <center>
        <form method="POST" action="" @submit.prevent="actualizar">
        <input type="hidden" name="id" v-model="id">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <select v-on:change="buscar" class="uk-input field" v-model="rango" name="rango">
                  <option value="1">Vendedor</option>
                  <option value="2">Supervisor</option>
                  <option value="3">Administrador</option>
                  <option value="4">Super administrador</option>
                </select>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: plus"></span>
            <input class="uk-input field" type="text" name="sueldo" placeholder="Sueldo" required v-model="sueldo">
          </div>
        </div>
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
  name: 'empleado',
  data() {
    return {
        nombre:'',
        empleados: [],
        datos: '',
        tipo: 'nombres',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        metodo: 'Agregar empleado',
        id: '',
        rango: '',
        sueldo: '',
        nombres: '',
        apellidos: '',
        mail: '',
        password: '',
        direccion: '',
        telefono: ''
    }
  },
  props: ['idafiliado'],
  mounted(){
    axios
      .get('../procesarEmpleados/0/'+this.idafiliado)
      .then(response => (this.empleados = response.data))
  },
  methods: {
    limpiar()
    {
      $('#modal-center').removeClass('uk-open').hide();
      this.id = ""
      this.rango= ""
      this.sueldo= ""
      this.nombres = ""
      this.apellidos = ""
      this.mail = ""
      this.password = ""
      this.direccion = ""
      this.telefono = ""
      this.metodo = 'Agregar empleado'
    },
    buscar()
    {
      if(this.datos=='')
      {
        axios
          .get('../procesarEmpleados/0/'+this.idafiliado)
          .then(response => (this.empleados = response.data))
      }else{
        axios
          .get('../procesarEmpleados/0/'+this.idafiliado+'/'+this.tipo+'/'+this.datos) //Filtros
          .then(response => (this.empleados = response.data))
      }
    },
    modificar(empleado)
    {
      this.id = empleado['id']
      this.rango= empleado['rango']
      this.sueldo= empleado['sueldo']
      this.nombres = empleado['nombres']
      this.apellidos = empleado['apellidos']
      this.mail = empleado['mail']
      this.password = empleado['password']
      this.direccion = empleado['direccion']
      this.telefono = empleado['telefono']
      $('#agregarEmpleado').hide()
      $('#modificarEmpleado').show()
      this.metodo = 'Modificar empleado'
    },
    agregar()
    {
      this.limpiar()
      $('#agregarEmpleado').show()
      $('#modificarEmpleado').hide()
      this.metodo = 'Agregar empleado'
    },
    insertar()
    {
      axios
      .post('../procesarEmpleados/1/',{
                                    idafiliado: this.idafiliado,
                                    rango: this.rango,
                                    sueldo: this.sueldo,
                                    nombres: this.nombres,
                                    apellidos: this.apellidos,
                                    mail: this.mail,
                                    password: this.password,
                                    direccion: this.direccion,
                                    telefono: this.telefono
                                    })
      .then(response => {this.empleados = response.data;swal("El empleado ha sido agregado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", e.response.data.message, "error")))
      this.limpiar();
    },
    actualizar()
    {
      axios
      .post('../procesarEmpleados/2/',{
                                    idafiliado: this.idafiliado,
                                    id: this.id,
                                    rango: this.rango,
                                    sueldo: this.sueldo,
                                    nombres: this.nombres,
                                    apellidos: this.apellidos,
                                    mail: this.mail,
                                    password: this.password,
                                    direccion: this.direccion,
                                    telefono: this.telefono
                                    })
      .then(response => {this.empleados = response.data;swal("El empleado ha sido actualizado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", e.response.data.message, "error")))
      this.limpiar();
    },
    eliminar(empleado)
    {
      axios
      .get('../procesarEmpleados/3/'+empleado['idafiliado']+'/'+empleado['id']) //Filtros
      .then(response => {this.empleados = response.data;swal("El empleado ha sido eliminado", "", "success")})
      .catch(e => (swal("Ha surgido un problema", e.response.data.message, "error")))
    },
  }
};
</script>