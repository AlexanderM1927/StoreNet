<template>
  <div>
    <center><h1 class="title">Tienda online</h1></center>
    <ul class="productos">
      <li class="producto" v-for="producto in productos">
        <a href="#" @click="agregar(producto)">
        <center>
        <div class="comprar">
          Agregar al carrito
        </div>
        <div class="producto-i">
          <img v-bind:src="producto['imgUrl']"><br>
        </div>
        <b>{{producto['name']}}</b><br>
        <span class="precio">${{producto['precio']}}</span>
        </center>
        </a>
      </li>
    </ul>
    <div class="carrito">
      <center>
        <h4>Carrito</h4>
      <ul class="productosCarrito">
          <li v-for="producto in myProductos" class="productoCarrito">
            <img v-bind:src="producto['imgUrl']" class="cuadritoImg">
            <center><a href="#" @click="eliminar(producto)"><span uk-icon="icon: trash"></span></a></center>
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

export default {
  name: 'comprar',
  data() {
    return {
      aviso: 0,
      productos: [
        { name: 'Escoba', imgUrl: 'img/bg2.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/background.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/background.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/background.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/background.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/background.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg3.jpg', precio: '1500'},
        { name: 'Escoba', imgUrl: 'img/bg2.jpg', precio: '1500'}
      ],
      myProductos: []
    }
  },
  methods: {
    agregar(item){
      this.myProductos.push(item)
      if(this.aviso==0)
      {
        alert('La cantidad es equivalente a la cantidad de veces que selecciones el producto')
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
      alert('x');
    }
  }
};
</script>
