<template>
  <div>
    <h1 class="titulo-seccion">Tus compras</h1>
    Haz seguimiento a tus compras dentro de la aplicación, o en los almacenes afiliados.
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
                <td><a href="#modal-center" uk-toggle @click="detalles(compra,compra['id'],compra['idafiliado'])">Ver detalles</a></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
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
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'

export default {
    name: 'compras',
    data() {
        return {
            compras: [],
            productos: [],
            idfactura: 0,
            nombre: '',
            preciototal: 0
        }
    },
    props: ['idcliente'],
    mounted(){
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
        async detalles(factura,idfactura,idafiliado)
        {
            await axios
                .get('../procesarCompras/0/0/'+idfactura+'/'+idafiliado)
                .then(response => (this.productos=response.data))
            
            this.idfactura = idfactura
            this.nombre = factura['afiliado']
            this.calcularPT(this.productos)
        }
    }
}
</script>
