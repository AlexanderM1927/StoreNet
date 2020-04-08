<template>
  <div>
    <h1 class="titulo-seccion">Gestión de productos</h1>
    ¿Deseas filtrar la tabla?:
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: cog"></span>
                <input class="uk-input field" v-model="datos" v-on:keyup="buscar" type="text" placeholder="Busqueda..." required>
                </div>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: tag"></span>
                <select v-on:change="buscar" class="uk-input field" v-model="tipo">
                  <option value="id">id</option>
                  <option value="nombre">nombre</option>
                  <option value="cantidad">cantidad</option>
                </select>
                </div>
    <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>id</b></th>
                <th>Nombre</th>
                <th>Precio proveedor</th>
                <th>Precio de venta</th>
                <th>Unidades disponibles</th>
                <th>Imgurl</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody v-for="producto in productos">
            <tr>
                <td>{{producto['id']}}</td>
                <td>{{producto['nombre']}}</td>
                <td>{{producto['precioproveedor']}}</td>
                <td>{{producto['precioventa']}}</td>
                <td>{{producto['cantidad']}}</td>
                <td>{{producto['imgurl'].substr(0,20)}}</td>
                <td>
                  <center><a href="#" uk-toggle="target: #modal-center" @click="codigo(producto)">Cod barra</a> <br> <a href="#" uk-toggle="target: #modal-center" @click="modificar(producto)">Editar</a> / <a href="#" @click="eliminar(producto)">Eliminar</a></center>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <center>
      <br><br>
      <button @click="agregar" class="uk-button uk-button-primary uk-margin-small-right" type="button" uk-toggle="target: #modal-center">{{metodo}}</button>
    </center>
        <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="creadorForm">
      <h3 class="title">{{metodo}}</h3>
      <div class="content" id="agregarProducto">
        <center>
        <form method="POST" action="" @submit.prevent="insertar">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombre" placeholder="Nombre del articulo" required v-model="nombre">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="cantidad" placeholder="Cantidad en inventario" required v-model="cantidad">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="precioproveedor" placeholder="Precio proveedor" required v-model="precioproveedor">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="precioventa" placeholder="Precio venta" required v-model="precioventa">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: image"></span>
            <input class="uk-input field" type="text" name="imgurl" placeholder="URL imagen" required v-model="imgurl">
          </div>
        </div>
        <button class="uk-button uk-button-default">Agregar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </center>
      </div>
      <div class="content" id="modificarProducto">
        <center>
        <form method="POST" action="" @submit.prevent="actualizar">
        <input type="hidden" name="id" v-model="id">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="nombre" placeholder="Nombre del articulo" required v-model="nombre">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="cantidad" placeholder="Cantidad en inventario" required v-model="cantidad">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="precioproveedor" placeholder="Precio proveedor" required v-model="precioproveedor">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="precioventa" placeholder="Precio venta" required v-model="precioventa">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: image"></span>
            <input class="uk-input field" type="text" name="imgurl" placeholder="URL imagen" required v-model="imgurl">
          </div>
        </div>
        <button class="uk-button uk-button-default">Modificar</button>
        </form>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        </center>
      </div>
      <div class="content" id="codigoProducto">
        <center>
          <div ref="codigo">
          {{nombre}}:
          <barcode v-bind:value="id" format="CODE39" width="3" height="50">
          Error generando codigo de barras
          </barcode>
          </div>
          <br>
          <button class="uk-button uk-button-danger" @click="imprimir">Imprimir</button>
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
import VueBarcode from 'vue-barcode';

export default {
  name: 'producto',
  data() {
    return {
        nombre:'',
        productos: [],
        datos: '',
        tipo: 'nombre',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        metodo: 'Agregar producto',
        id: '',
        cantidad: 0,
        precioventa: 0,
        precioproveedor: 0,
        imgurl: ''
    }
  },
  props: ['idafiliado'],
  mounted(){
    axios
      .get('../procesarProductos/0/0/0/'+this.idafiliado)
      .then(response => (this.productos = response.data))
  },
  components: {
    'barcode': VueBarcode
  },
  methods: {
    limpiar()
    {
      $('#modal-center').removeClass('uk-open').hide();
      this.id = ""
      this.nombre= ""
      this.cantidad= 0
      this.precioventa= 0
      this.precioproveedor = 0
      this.imgurl = ""
      this.metodo = 'Agregar producto'
    },
    buscar()
    {
      if(this.datos==''){
        axios
          .get('../procesarProductos/0/0/0/'+this.idafiliado)
          .then(response => (this.productos = response.data))
      }else{
        axios
          .get('../procesarProductos/0/'+this.tipo+'/'+this.datos+'/'+this.idafiliado) //Filtros
          .then(response => (this.productos = response.data))
      }
      
    },
    modificar(producto)
    {
      this.id = producto['id']
      this.nombre= producto['nombre']
      this.cantidad= producto['cantidad']
      this.precioventa= producto['precioventa']
      this.precioproveedor = producto['precioproveedor']
      this.imgurl = producto['imgurl']
      $('#agregarProducto').hide()
      $('#modificarProducto').show()
      $('#codigoProducto').hide()
      this.metodo = 'Modificar producto'
    },
    agregar()
    {
      this.limpiar()
      $('#agregarProducto').show()
      $('#modificarProducto').hide()
      $('#codigoProducto').hide()
      this.metodo = 'Agregar producto'
    },
    codigo(producto)
    {
      this.id = producto['id']
      this.nombre= producto['nombre']
      this.cantidad= producto['cantidad']
      this.precioventa= producto['precioventa']
      this.precioproveedor = producto['precioproveedor']
      this.imgurl = producto['imgurl']
      $('#modificarProducto').hide()
      $('#agregarProducto').hide()
      $('#codigoProducto').show()
      this.metodo = 'Imprimir producto'
    },
    insertar()
    {
      axios
      .post('../procesarProductos/1/',
      { idafiliado: this.idafiliado,
        id: this.id, 
        cantidad: this.cantidad,
        nombre: this.nombre,
        precioventa: this.precioventa,
        precioproveedor: this.precioproveedor,
        imgurl: this.imgurl})
      .then(response => (this.productos = response.data))
      this.limpiar()
      swal("El producto ha sido agregado", "", "success");
    },
    actualizar()
    {
      axios
      .post('../procesarProductos/2/',
      { idafiliado: this.idafiliado,
        id: this.id, 
        cantidad: this.cantidad,
        nombre: this.nombre,
        precioventa: this.precioventa,
        precioproveedor: this.precioproveedor,
        imgurl: this.imgurl})
      .then(response => (this.productos = response.data))
      this.limpiar()
      swal("El producto ha sido actualizado", "", "success");
    },
    eliminar(producto)
    {
      axios
      .get('../procesarProductos/3/'+producto['id']+'/0/'+producto['idafiliado']) //Filtros
      .then(response => (this.productos = response.data))
      swal("El producto ha sido eliminado", "", "success");
    },
    imprimir()
    {
      let ficha = this.$refs.codigo;
	    let ventimp = window.open(' ', 'popimpr');
	    ventimp.document.write( ficha.innerHTML );
	    ventimp.document.close();
	    ventimp.print( );
	    ventimp.close();
    }
  }
};
</script>