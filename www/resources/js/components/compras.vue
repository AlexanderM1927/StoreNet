<template>
  <div>
    <h1 class="titulo-seccion">Tus compras</h1>
    Haz seguimiento a tus compras dentro de la aplicación, o en los almacenes afiliados.
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
            </tr>
            <tr>
                <td colspan="2"><center><button class="uk-button uk-button-primary" @click="filtrar">Filtrar</button></center></td>
            </tr>
        </table>
    </center>
    <hr>
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>idfactura</b></th>
                <th>Almacen</th>
                <th>Fecha</th>
                <th>Valor total</th>
                <th>Cantidad de compras</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody v-for="compra in compras">
            <tr>
                <td>{{compra['id']}}</td>
                <td>{{compra['afiliado']}}</td>
                <td>{{compra['fecha']}}</td>
                <td>{{compra['valortotal']}}</td>
                <td>{{compra['stock']}}</td>
                <td><a href="#modal-center" uk-toggle @click="detalles(compra)">Ver detalles</a></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <div ref="factura">
        <div class="uk-modal-header">
        <h2 class="uk-modal-title">{{nombre}}</h2>
        ID FACTURA:{{idfactura}}
        </div>
        <center>
            <barcode v-bind:value="idfactura" format="CODE39" width="2" height="30">
          Error generando codigo de barras
        </barcode>
        <div class="carritoCompra barra">
          <table>
            <tr>
              <th>ID producto</th>
              <th>Nombre producto</th>
              <th>Valor unitario</th>
              <th>Cantidad</th>
              <th>Precio total</th>
            </tr>
            <tr v-for="item in productos">
              <td>{{item['id']}}</td>
              <td>{{item['nombre']}}</td>
              <td>{{item['valorUnitario']}}</td>
              <td>{{item['cantidad']}}</td>
              <td>{{item['valorUnitario']*item['cantidad']}}</td>
            </tr>
          </table>
        </div>
        <b>Total:   {{preciototal}}</b><br>
        </center>
        </div>
        <center>
        <button class="uk-button uk-button-primary" @click="imprimir()">Imprimir</button>
        </center>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import VueBarcode from 'vue-barcode';

export default {
    name: 'compras',
    data() {
        return {
            compras: [],
            productos: [],
            idfactura: 0,
            nombre: '',
            preciototal: 0,
            mode: 'single',
            selectedDate: null,
            visibility: {
            visibility: 'click'
            },
            mode1: 'single',
            selectedDate1: null,
            visibility1: {
            visibility: 'click'
            } 
        }
    },
    components: {
    'v-date-picker': DatePicker,
    'barcode': VueBarcode
    },
    props: ['idcliente'],
    mounted(){
      $("input[data-v-64ee1ddd]").removeClass()
      $("input[data-v-64ee1ddd]").addClass('uk-input gk-shadow-input')
      $("input[data-v-64ee1ddd]").css("padding-left","35px")
    //axios
    axios
      .get('../procesarCompras/0/'+this.idcliente)
      .then(response => (this.compras=response.data))
    },
    methods: {
        calcularPT(arreglo)
        {
            let precio=0
            for(let i=0;i<arreglo.length;i++)
            {
                precio+=parseInt(arreglo[i]['cantidad']*arreglo[i]['valorUnitario'])
            }
            this.preciototal=precio
        },
        async detalles(factura)
        {
            await axios
                .get('../procesarCompras/2/0/'+factura['id']+'/'+factura['idafiliado'])
                .then(response => (this.productos=response.data))
            
            this.idfactura = factura['id']
            this.nombre = factura['afiliado']
            this.calcularPT(this.productos)
        },
        async filtrar()
        {
          await axios
                .get('../procesarCompras/0/'+this.idcliente+'/'+JSON.stringify({
                    desde: this.selectedDate,
                    hasta: this.selectedDate1}))
                .then(response => (this.compras=response.data))
        },
        imprimir()
        {
            let ficha = this.$refs.factura;
	        let ventimp = window.open(' ', 'popimpr');
	        ventimp.document.write( ficha.innerHTML );
	        ventimp.document.close();
	        ventimp.print( );
	        ventimp.close();
        }
    }
}
</script>
