<template>
  <div>
    <center><div class="uk-margin">
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: cart"></span>
                <input class="uk-input field" type="text" v-on:keyup="buscar" v-model="buscador" placeholder="¿Buscas algo en especial?">
                </div><span class="results" ref="results">{{results}}</span>
                </div></center>
    <ul class="productos">
      <li class="producto" v-for="producto in productos" v-bind:key="producto.id">
        <a href="#" @click="agregar(producto)">
        <center>
        <div class="comprar">
          <img src="img/cart.png">
        </div>
        <div class="producto-i">
          <img v-bind:src="producto['imgurl']"><br>
        </div>
        <span class="precio">${{miles(producto['precioventa'])}}</span><br>
        {{producto['nombre'].substr(0,15)}}<br>
        </center>
        </a>
      </li>
    </ul>
    <div class="carrito">
      <center>
        <h4>Carrito</h4>
      <ul class="productosCarrito">
          <li v-for="producto in myProductos" class="productoCarrito" v-bind:key="producto.id">
              <img v-bind:src="producto['imgurl']" class="cuadritoImg">
              <center><a href="#" @click="eliminar(producto)"><span uk-icon="icon: trash"></span></a></center>
          </li>
        </ul>
      </center>
    </div><br><br>
    <a href="#modal-center" @click="generarFactura" uk-toggle>
      <div class="finalizarCompra">
      Realizar compra
      </div>
    </a>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación de tu compra</h2>
        Por favor verifica que todos tus productos estén en orden
        </div>
        <div class="carritoCompra barra">
          <table class="factura">
            <tr>
              <th>Nombre producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
            </tr>
            <tr v-for="item in factura" v-bind:key="item.id">
              <td>{{item.producto['nombre']}}</td>
              <td>{{miles(item.producto['precioventa'])}}</td>
              <td>{{item.cantidad}}</td>
            </tr>
          </table>
        </div>
        <center>
        <b>Total a pagar:   {{miles(preciototal)}}</b><br>
        <button class="uk-button uk-button-primary" @click="realizarCompra">Confirmar compra</button>
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
  name: 'comprar',
  data() {
    return {
      aviso: 0,
      productos: [],
      myProductos: [],
      buscador: '',
      datos: '',
      results: '',
      mensaje: '',
      preciototal: 0,
      factura: []
    }
  },
  props: ['idcliente'],
  mounted(){
    //axios
    axios
      .get('../procesarProductos/0/0/0')
      .then(response => (this.publicarArticulo(response.data)))
  },
  methods: {
    publicarArticulo(data){
      this.productos=[]
      for(let i=0;i<data.length;i++)
      {
        if(data[i]['cantidad']>0){
          this.productos.push(data[i])
        }
      }
    },
    buscar(){
      if(this.buscador === "")
      {
        axios
          .get('../procesarProductos/0/0/0')
          .then(response => (this.publicarArticulo(response.data)))
      }else{
        axios
          .get('../procesarProductos/0/nombre/'+this.buscador)
          .then(response => (this.publicarArticulo(response.data)))
        this.$refs.results.style.display="block"
        this.results=this.productos.length
      }
    },
    contarCantidades(item)
    {
      let encontro = false
      for(let i=0;i<this.factura.length;i++)
      {
        if(item===this.factura[i].producto)
        {
          this.factura[i].cantidad++
          encontro= true
        }
      }
      if(!encontro)
      {
        this.factura.push({producto: item, cantidad: 1})
      }
    },
    agregar(item){
      item['cantidad']--
      if(item['cantidad']>=0)
      {
        this.myProductos.push(item)
        this.preciototal+=parseInt(item['precioventa'])
        if(this.aviso==0)
        {
          swal("Cantidad", "La cantidad de elementos equivale a las veces que lo seleccionas", "info");
          this.aviso++
        }
      }else{
        swal("Inventario", "No hay suficiente cantidad en el inventario", "error");
      }
    },
    eliminar(item)
    {
      let index
      if(item['cantidad']==-1) item['cantidad']++
      item['cantidad']++
      this.preciototal-=parseInt(item['precioventa'])
      index=this.myProductos.indexOf(item)
      this.myProductos.splice(index,1)
    },
    async realizarCompra()
    {
      await axios
        .post('../procesarCompras/1',
        {productos: this.factura,
        idcliente: this.idcliente})
        .then(response => {this.mensaje = response.data; swal("Información de la compra", this.mensaje.texto, this.mensaje.type)})
        .catch(e => {swal("Información de la compra", "Por favor comunicarte a través de un reporte", "error")})
      const longitud = this.myProductos.length
      for(let i=0;i<longitud;i++)
      {
        let item=this.myProductos[i]
        const pos=this.productos.indexOf(item)
        if(this.productos[pos]['cantidad']==-1) this.productos[pos]['cantidad']++
        this.productos[pos]['cantidad']++
      }
      this.myProductos=[]
      this.factura=[]
      this.preciototal=0
      $('#modal-center').removeClass('uk-open').hide();
    },
    generarFactura()
    {
      this.factura=[]
      for(let i=0;i<this.myProductos.length;i++)
      {
        this.contarCantidades(this.myProductos[i])
      }
    },
    miles(input)
    {
    var num = input;
    if(!isNaN(num)){
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      return num;
      }
    }
  }
};
</script>
