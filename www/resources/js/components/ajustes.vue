<template>
  <div>
    <h1 class="titulo-seccion">Tus ajustes</h1>
    Si desea hacer cambios acerca de su correo, o clave, le pedimos por favor que se comunice en la sección de reportes con un asesor.
    <center>
    <form method="POST" action="" @submit.prevent="modificar">
    <input type="hidden" name="_token" :value="csrf">
    <div class="uk-margin">
    <div class="uk-inline">
    <span class="uk-form-icon" uk-icon="icon: user"></span>
    <input class="uk-input field" type="text" name="nombres" placeholder="Nombres" required v-model="usuario['nombres']">
    </div>
    </div>
    <div class="uk-margin">
    <div class="uk-inline">
    <span class="uk-form-icon" uk-icon="icon: user"></span>
    <input class="uk-input field" type="text" name="apellidos" placeholder="Apellidos" required v-model="usuario['apellidos']">
    </div>
    </div>
    <div class="uk-margin">
    <div class="uk-inline">
    <span class="uk-form-icon" uk-icon="icon: location"></span>
    <input class="uk-input field" type="text" name="direccion" placeholder="Direccion" required v-model="usuario['direccion']">
    </div>
    </div>
    <div class="uk-margin">
    <div class="uk-inline">
    <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
    <input class="uk-input field" type="text" name="telefono" placeholder="Telefono" required v-model="usuario['telefono']">
    </div>
    </div>
    <button class="uk-button uk-button-primary">Modificar</button>
    </form>
    </center>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'

export default {
  name: 'ajustes',
  data() {
    return {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        usuario: {}
    }
  },
  props: ['idafiliado','idusuario','rango'],
  mounted(){
      axios
      .get('../procesarAjustes/0/'+this.idafiliado+'/'+this.rango+'/'+this.idusuario)
      .then(response => (this.usuario=response.data))
  },
  methods: {
      modificar(){
          axios
            .post('../procesarAjustes/1',{
                id: this.idusuario,
                idafiliado: this.idafiliado,
                rango: this.rango,
                nombres: this.usuario['nombres'],
                apellidos: this.usuario['apellidos'],
                direccion: this.usuario['direccion'],
                telefono: this.usuario['telefono']
            })
            .then(response => {this.usuario=response.data;swal("Cuenta modificada","","success")})
            .catch(e => {swal("Error", "Por favor comunicarte a través de un reporte","error")})
      }
  }
}
</script>
