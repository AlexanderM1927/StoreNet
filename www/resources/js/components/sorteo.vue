<template>
  <div>
    <div class="sorteo barra">
            <center>
                <h3>Ganador de la semana</h3>
                <h1>{{nick}}</h1>
                Tu puedes ser el ganador de la semana, para esto necesitas obtener puntos.<br>
            </center>
            <b>¿Cómo obtener puntos?</b><br>
            -Por cada compra realizada a través de StoreNet recibirás 1 punto.<br>
            -Por cada compra realizada en un almacen de cadena afiliado a StoreNet obtendrás 10 puntos.<br>
            <b>Criterio de selección</b><br>
            En la semana se elige a la persona con más puntos, esta persona es seleccionada automáticamente por el sistema. Tienes que estar atento para reclamar tus premios, se hace mediante reportes.<br>
            <span class="uk-alert-warning">Cada semana los puntos son reiniciados, es decir, vuelven a 0.</span><br>
    </div>
    <div class="progreso">
                Esta barra te hará saber tu progreso:
                <span style="color:red;" v-if="puntos===0">No tienes puntos esta semana</span>
                <progress class="uk-progress" ref="barra"></progress>
    </div>
  </div>
</template>

<script>
import swal from 'sweetalert'

export default {
    name: 'sorteo',
    data() {
        return{
            tarjetas: [],
            tarjeta: [],
            max: 0,
            nick: 'Aún no hay ganador',
            puntos: 0
        }
    },
    props: ['idcliente'],
    async mounted(){
    await axios
      .get('../procesarTarjetas/0')
      .then(response => {this.tarjetas=response.data})
      .catch(response => (swal("Error en el sistema","","error")))
    await axios
      .get('../procesarTarjetas/0/'+this.idcliente)
      .then(response => {this.tarjeta=response.data})
      .catch(response => (swal("Error en el sistema","","error")))

    this.realizarSorteo();
    },
    methods: {
        async getNick(id) {
        await axios
                .get('../procesarClientes/0/id/'+id)
                .then(response => (this.clientes = response.data))
        this.nick = this.clientes[0].nombres+' '+this.clientes[0].apellidos
        },
        realizarSorteo() {
            this.max = this.tarjetas[0].puntos
            this.puntos = this.tarjeta[0].puntos
            this.$refs.barra.value = this.puntos
            this.$refs.barra.max = this.max;
            this.getNick(this.tarjetas[0].idcliente)
        }
    }
}
</script>
