<template>
  <div>
    <h1 class="titulo-seccion">Devoluciones</h1>
    Efectua devoluciones en facturas de tu empresa.
    <br><br><br><br>
    <center>
    <div class="contenidoD">
        <div class="uk-margin">
        <div class="uk-inline">
        <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
        <input class="uk-input field" type="text" v-model="id" placeholder="ID factura" required>
        </div>
        </div><br>
        <button class="uk-button uk-button-primary" @click="devolucion">Generar devolución</button>
    </div>
    </center>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'

export default {
    name: 'devoluciones',
    data() {
        return {
            metodo: '',
            id: 0,
            mensaje: ''
        }
    },
    props: ['idafiliado'],
    mounted(){
    },
    methods:{
        async devolucion()
        {
            await axios
                    .post('../procesarDevoluciones', {
                    idafiliado: this.idafiliado,
                    idfactura: this.id})
                    .then(response => (this.mensaje = response.data))

                swal("Informacion", this.mensaje.texto, this.mensaje.tipo)
        }
    }
}
</script>
