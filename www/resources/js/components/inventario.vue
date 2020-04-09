<template>
  <div>
    <h1 class="titulo-seccion">Inventario</h1>
    Filtrar tabla por: 
    <div class="uk-inline">
        <span class="uk-form-icon" uk-icon="icon: tag"></span>
        <select v-on:change="filtrar" class="uk-input field" v-model="filtro">
            <option value="1">unidades menor cantidad</option>
            <option value="2">unidades mayor cantidad</option>
            <option value="3">utilidad menor</option>
            <option value="4">utilidad mayor</option>
            <option value="5">precio venta menor</option>
            <option value="6">precio venta mayor</option>
            <option value="7">producto menos vendido</option>
            <option value="8">producto mas vendido</option>
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
                <th>Utilidad neta</th>
                <th>% de utilidad</th>
                <th># de ventas</th>
            </tr>
        </thead>
        <tbody v-for="producto in productos">
            <tr>
                <td>{{producto['id']}}</td>
                <td>{{producto['nombre']}}</td>
                <td>{{producto['precioproveedor']}}</td>
                <td>{{producto['precioventa']}}</td>
                <td>{{producto['cantidad']}}</td>
                <td>{{producto['utilidad']}}</td>
                <td>{{calcularUtilidad(producto['precioventa'],producto['precioproveedor'])}}%</td>
                <td>{{producto['ventas']}}</td>
            </tr>
        </tbody>
    </table>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'

export default {
    name: 'inventario',
    data() {
        return {
            filtro: 0,
            productos: []
        }
    },
    props: ['idafiliado'],
    mounted(){
    //axios
    axios
      .get('../procesarProductos/4/0/0/'+this.idafiliado)
      .then(response => (this.productos = response.data))
    },
    methods: {
        async filtrar(){
            axios
                .get('../procesarProductos/4/'+this.filtro+'/0/'+this.idafiliado)
                .then(response => (this.productos = response.data))
        },
        calcularUtilidad(pv,pp)
        {
            let porcentaje
            porcentaje = parseFloat((pv-pp)*100/pp)
            return porcentaje
        }
    }
}
</script>
