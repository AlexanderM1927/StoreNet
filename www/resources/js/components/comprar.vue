<template>
  <div>
    <center><div class="uk-margin">
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: cart"></span>
                <input class="uk-input field" type="text" v-on:keyup="buscar" v-model="buscador" placeholder="¿Buscas algo en especial?">
                </div>
                </div></center>
    <ul class="productos">
      <li class="producto" v-for="producto in productos">
        <a href="#" @click="agregar(producto)">
        <center>
        <div class="comprar">
          Agregar al carrito
        </div>
        <div class="producto-i">
          <img v-bind:src="producto['imgurl']"><br>
        </div>
        <b>{{producto['nombre']}}</b><br>
        <span class="precio">${{producto['precioventa']}}</span>
        </center>
        </a>
      </li>
    </ul>
    <div class="carrito">
      <center>
        <h4>Carrito</h4>
      <ul class="productosCarrito">
          <li v-for="producto in myProductos" class="productoCarrito">
            <div v-if="producto['cantidad']===0">
              <img v-bind:src="producto['imgurl']" class="cuadritoImg">
              <center><a href="#" @click="eliminar(producto)"><span uk-icon="icon: trash"></span></a></center>
            </div>
          </li>
        </ul>
      </center>
    </div><br><br>
    <a @click="realizarCompra" href="#modal-center" uk-toggle>
      <div class="finalizarCompra">
      Finalizar compra
      </div>
    </a>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación de tu compra</h2>
        </div>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <p>Tu compra ha sido realizada exitosamente. Podrás encontrar la factura en <a href="myshop"><b>Tienda>Mis compras</b></a></p>
        <br>
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
      datos: 'adasd'
    }
  },
  mounted(){
    //axios
    axios
      .get('../procesarProductos/0/0/0')
      .then(response => (this.productos = response.data))
  },
  methods: {
    buscar(){
      axios
      .get('../procesarProductos/0/nombres/'+this.buscador)
      .then(response => (this.productos = response.data))
    },
    agregar(item){
      this.myProductos.push(item)
      if(this.aviso==0)
      {
        swal("Cantidad", "La cantidad de elementos equivale a las veces que lo seleccionas", "info");
        this.aviso++
      }
    },
    eliminar(item)
    {
      let index
      index= this.myProductos.indexOf(item)
      this.myProductos.splice(index,1)
    },
    realizarCompra()
    {
      swal('x');
    }
  }
};
</script>
