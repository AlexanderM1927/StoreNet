<template>
  <div>
    <h1 class="titulo-seccion">Gestión de tarjetas</h1>
    ¿Deseas filtrar la tabla?:
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: cog"></span>
                <input class="uk-input field" v-model="datos" v-on:keyup="buscar" type="text" placeholder="Busqueda..." required>
                </div>
    <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>id</b></th>
                <th>idcliente</th>
                <th>saldo</th>
                <th>puntos</th>
                <th>opciones</th>
            </tr>
        </thead>
        <tbody v-for="tarjeta in tarjetas">
            <tr>
                <td>{{tarjeta['id']}}</td>
                <td>{{tarjeta['idcliente']}}</td>
                <td>{{miles(tarjeta['saldo'])}}</td>
                <td>{{tarjeta['puntos']}}</td>
                <td><a href="#" uk-toggle="target: #modal-center" @click="modificar(tarjeta)">Recargar</a> / <a href="#" @click="eliminar(tarjeta)">Eliminar</a></td>
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
      <div class="content" id="agregarTarjeta">
        <center>
        <form method="POST" action="" @submit.prevent="insertar">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="idcliente" placeholder="Id cliente" required v-model="idcliente">
          </div>
        </div>
        <button class="uk-button uk-button-default">Agregar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </center>
      </div>
      <div class="content" id="modificarTarjeta">
        <center>
        <form method="POST" action="" @submit.prevent="actualizar">
        <input type="hidden" name="id" v-model="id">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="saldo" @keyup="milesInput()" placeholder="Saldo" required v-model="saldo">
          </div>
        </div>
        <button class="uk-button uk-button-default">Recargar</button>
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
  name: 'tarjeta',
  data() {
    return {
        tarjetas: [],
        datos: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        metodo: 'Agregar tarjeta',
        id: '',
        idcliente: '',
        saldo: '',
        puntos: ''
    }
  },
  mounted(){
    //axios
    axios
      .get('../procesarTarjetas/0')
      .then(response => (this.tarjetas=response.data))
  },
  methods: {
    limpiar()
    {
      $('#modal-center').removeClass('uk-open').hide();
      this.id = ''
      this.idcliente= ''
      this.saldo= ''
      this.puntos= ''
    },
    buscar()
    {
      axios
      .get('../procesarTarjetas/0/'+this.datos)
      .then(response => (this.tarjetas=response.data))
    },
    modificar(tarjeta)
    {
      this.saldo = ''
      this.id = tarjeta['id']
      this.idcliente= tarjeta['idcliente']
      this.puntos= tarjeta['puntos']
      $('#agregarTarjeta').hide()
      $('#modificarTarjeta').show()
      this.metodo = 'Recargar tarjeta'
    },
    agregar()
    {
      this.limpiar()
      $('#agregarTarjeta').show()
      $('#modificarTarjeta').hide()
      this.metodo = 'Agregar tarjeta'
    },
    insertar()
    {
      axios
      .post('../procesarTarjetas/1',
      { idcliente: this.idcliente})
      .then(response => (this.tarjetas = response.data))
      this.limpiar();
      swal("La tarjeta ha sido agregado", "", "success");
    },
    actualizar()
    {
      this.saldo = this.saldo.replace(/\./g,'')
      axios
      .post('../procesarTarjetas/2',
      { id: this.id, 
        saldo: this.saldo})
      .then(response => (this.tarjetas = response.data))
      this.limpiar();
      swal("La tarjeta ha sido actualizado", "", "success");
    },
    eliminar(tarjeta)
    {
      axios
      .get('../procesarTarjetas/3/'+tarjeta['id']) //Filtros
      .then(response => (this.tarjetas = response.data))
      swal("La tarjeta ha sido eliminado", "", "success");
    },
    miles(input)
    {
    var num = input;
    if(!isNaN(num)){
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      return num;
      }
    },
    milesInput()
    {
      var num = this.saldo.replace(/\./g,'');
      if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        this.saldo = num;
      }
    }
  }
};
</script>