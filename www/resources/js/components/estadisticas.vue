<template>
  <div>
    <h1 class="titulo-seccion">Estadísticas</h1>
    <div class="filtrosEstadisticas" id="filtros">
        <center>
            <h2 class="titulo-seccion">Facturas y balances</h2>
            <table>
                <tr>
                    <td>
                    <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                    <v-date-picker :mode="mode" :popover="visibility" v-model="selectedDate" color="blue" is-dark/>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                    <v-date-picker :mode="mode1" :popover="visibility1" v-model="selectedDate1" color="blue" is-dark/>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <button class="uk-button uk-button-primary" @click="cargarFacturas()">Ver facturas</button>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <button class="uk-button uk-button-primary" @click="balance()">Ver balance</button>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    <div class="circuloEstadisticas" id="circulo">
        <h2 class="titulo-seccion">Más vendidos este mes</h2>
        <circulo :data="chartData" :width="300" :height="150"></circulo>
    </div>
    <barra :data1="chartData1" :width="300" :height="100"></barra>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import barra from './components/barra.js'
import circulo from './components/circulo.js'

export default {
    name: 'estadisticas',
    components: {
        barra,
        circulo,
        'v-date-picker': DatePicker
    },
    data() {
        return {
            chartData1: {},
            chartData: {},
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
    props: ['idafiliado'],
    async mounted(){
        $("input[data-v-64ee1ddd]").removeClass()
        $("input[data-v-64ee1ddd]").addClass('uk-input gk-shadow-input')
        $("input[data-v-64ee1ddd]").css("padding-left","35px")
        let datos,cabecera
        await axios
                .get('../procesarEstadisticas/2/'+this.idafiliado)
                .then(response => (cabecera = response.data))
        await axios
                .get('../procesarEstadisticas/1/'+this.idafiliado)
                .then(response => (datos = response.data))  
                this.chartData1={labels: cabecera,datasets: [datos]}
        await axios
                .get('../procesarEstadisticas/3/'+this.idafiliado)
                .then(response => (datos = response.data))
        await axios
                .get('../procesarEstadisticas/4/'+this.idafiliado)
                .then(response => (cabecera = response.data))  
                this.chartData={labels: cabecera,datasets: [datos]}
        $("#filtros").height($("#circulo").height())
    },
    methods: {
        cargarFacturas(){
            if(this.selectedDate1 != null && this.selectedDate != null)
            {
                localStorage.setItem('desde', this.selectedDate)
                localStorage.setItem('hasta', this.selectedDate1)
                window.open('visorfacturas')
            }else{
                swal("","Asegurese de llenar el filtro de fechas.","error")
            }
            
        },
        balance(){
            if(this.selectedDate1 != null && this.selectedDate != null)
            {
            window.open('balance/'+this.idafiliado+'/'+this.selectedDate+'/'+this.selectedDate1)
            }else{
                swal("","Asegurese de llenar el filtro de fechas.","error")
            }
        }
    }
}
</script>
