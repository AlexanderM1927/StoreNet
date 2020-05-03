<template>
  <div>
    <h1 class="titulo-seccion">Tus pedidos</h1>
    Haz seguimiento a tus pedidos en línea.
    <center>
        <table>
            <tr>
                <td>Desde:</td>
                <td>Hasta:</td>
            </tr>
            <tr>
                <td>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                <v-date-picker :mode="mode" :popover="visibility" v-model="selectedDate" color="blue" is-dark/>
                </div>
                </td>
                <td>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                <v-date-picker :mode="mode1" :popover="visibility1" v-model="selectedDate1" color="blue" is-dark/>
                </div>
                </td>
                <td>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: tag"></span>
                <select v-on:change="filtrar()" class="uk-input field" v-model="estado">
                  <option value="0">Pendiente</option>
                  <option value="1">En camino</option>
                  <option value="2">Cancelado</option>
                  <option value="3">Recibido</option>
                  <option value="4">Cualquiera</option>
                </select>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><center><button class="uk-button uk-button-primary" @click="filtrar()">Filtrar</button></center></td>
            </tr>
        </table>
    </center>
    <hr>
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>ID Pedido</b></th>
                <th>Almacen</th>
                <th>ID Factura</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody v-for="pedido in pedidos">
            <tr>
                <td>{{pedido['id']}}</td>
                <td>{{pedido['afiliado']}}</td>
                <td>{{pedido['idfactura']}}</td>
                <td>{{pedido['estado']}}</td>
                <td>{{pedido['fecha']}}</td>
            </tr>
        </tbody>
    </table>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

export default {
    name: 'pedidos',
    data() {
        return {
            pedidos: [],
            mode: 'single',
            selectedDate: null,
            visibility: {
            visibility: 'click'
            },
            mode1: 'single',
            selectedDate1: null,
            visibility1: {
            visibility: 'click'
            },
            estado: 4
        }
    },
    components: {
    'v-date-picker': DatePicker
    },
    props: ['idcliente'],
    mounted(){
        $("input[data-v-64ee1ddd]").removeClass()
        $("input[data-v-64ee1ddd]").addClass('uk-input gk-shadow-input')
        $("input[data-v-64ee1ddd]").css("padding-left","35px")
    //axios
    axios
      .get('../procesarPedidos/0/'+this.idcliente)
      .then(response => (this.pedidos=response.data))
    },
    methods: {
        async filtrar()
        {
            if(this.selectedDate != null && this.selectedDate1 != null)
            {
                axios
                .get('../procesarPedidos/1/'+this.idcliente+'/'+JSON.stringify({
                    desde: this.selectedDate,
                    hasta: this.selectedDate1
                })+'/'+this.estado)
                .then(response => (this.pedidos=response.data))
            }else{
                axios
                .get('../procesarPedidos/2/'+this.idcliente+'/0/'+this.estado)
                .then(response => (this.pedidos=response.data))
            }
        }
    }
}
</script>
