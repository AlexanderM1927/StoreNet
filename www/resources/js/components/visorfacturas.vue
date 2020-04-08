<template>
  <div>
    <h1 class="titulo-seccion">Informe de ventas:</h1>
    <b>Desde:</b> {{desde}}<br>
    <b>Hasta:</b> {{hasta}}
    <hr>
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>ID factura</b></th>
                <th>Total venta</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody v-for="venta in ventas">
            <tr>
                <td>{{venta['id']}}</td>
                <td>{{venta['totalventa']}}</td>
                <td>{{venta['fecha']}}</td>
                <td><a href="#modal-center" uk-toggle @click="detalles(venta)">Ver detalles</a></td>
            </tr>
        </tbody>
    </table>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <div ref="factura">
        <div class="uk-modal-header">
        <h2 class="uk-modal-title">{{nombre}}</h2>
        ID FACTURA:{{idfactura}}
        </div>
        <center>
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

export default {
    name: 'visorfacturas',
    data() {
        return {
            productos: [],
            idfactura: 0,
            nombre: '',
            preciototal: 0,
            desde: '',
            hasta: '',
            ventas: []
        }
    },
    props: ['idafiliado'],
    mounted(){
        this.desde=localStorage.getItem('desde')
        this.hasta=localStorage.getItem('hasta')
    //axios
    axios
      .get('../procesarVisor/0/'+this.idafiliado+'/'+JSON.stringify({desde: this.desde, hasta: this.hasta}))
      .then(response => (this.ventas=response.data))

      localStorage.removeItem('desde')
      localStorage.removeItem('hasta')
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
